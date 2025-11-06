<?php
// Wyłącz wyświetlanie błędów w produkcji (logi w error_log)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Sprawdź czy to żądanie POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die('Method Not Allowed');
}

// Funkcje pomocnicze
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_phone($phone) {
    // Usuń znaki specjalne i sprawdź czy zostało 9-15 cyfr
    $digits = preg_replace('/\D/', '', $phone);
    return strlen($digits) >= 9 && strlen($digits) <= 15;
}

// Prosta ochrona przed spamem - rate limiting
session_start();
$current_time = time();
if (isset($_SESSION['last_order_submit_time'])) {
    $time_diff = $current_time - $_SESSION['last_order_submit_time'];
    if ($time_diff < 60) { // Minimum 60 sekund między wysyłkami
        http_response_code(429);
        die('Proszę poczekać przed wysłaniem kolejnego zamówienia.');
    }
}

// Odbiór i sanityzacja danych podstawowych
$name    = sanitize_input($_POST['name']    ?? '');
$email   = sanitize_input($_POST['email']   ?? '');
$phone   = sanitize_input($_POST['phone']   ?? '');
$date    = sanitize_input($_POST['date']    ?? '');
$address = sanitize_input($_POST['address'] ?? '');
$notes   = sanitize_input($_POST['notes']   ?? '');

// Walidacja wymaganych pól
if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($address)) {
    http_response_code(400);
    die('Błąd: Wszystkie wymagane pola muszą być wypełnione.');
}

// Walidacja formatu email
if (!validate_email($email)) {
    http_response_code(400);
    die('Błąd: Nieprawidłowy adres email.');
}

// Walidacja telefonu
if (!validate_phone($phone)) {
    http_response_code(400);
    die('Błąd: Nieprawidłowy numer telefonu.');
}

// Sprawdź długość pól (ochrona przed atakami)
if (strlen($name) > 100 || strlen($email) > 100 || strlen($phone) > 20 ||
    strlen($address) > 500 || strlen($notes) > 5000) {
    http_response_code(400);
    die('Błąd: Dane przekraczają dozwoloną długość.');
}

// Ochrona przed email injection
if (preg_match("/[\r\n]/", $email)) {
    http_response_code(400);
    die('Błąd: Nieprawidłowy format email.');
}

// Walidacja daty (sprawdź czy nie jest w przeszłości)
$selected_date = strtotime($date);
$today = strtotime(date('Y-m-d'));
if ($selected_date < $today) {
    http_response_code(400);
    die('Błąd: Data dostawy nie może być w przeszłości.');
}

// Odbiór i walidacja produktów
$products = $_POST['products'] ?? [];

if (empty($products) || !is_array($products)) {
    http_response_code(400);
    die('Błąd: Proszę dodać przynajmniej jeden produkt.');
}

// Walidacja produktów
$valid_products = [];
$max_products = 20; // Maksymalnie 20 produktów w jednym zamówieniu

if (count($products) > $max_products) {
    http_response_code(400);
    die('Błąd: Zbyt wiele produktów w zamówieniu (max ' . $max_products . ').');
}

foreach ($products as $product) {
    if (!isset($product['name']) || !isset($product['quantity'])) {
        http_response_code(400);
        die('Błąd: Nieprawidłowe dane produktu.');
    }

    $product_name = sanitize_input($product['name']);
    $product_quantity = sanitize_input($product['quantity']);

    if (empty($product_name) || empty($product_quantity)) {
        http_response_code(400);
        die('Błąd: Wszystkie produkty muszą mieć nazwę i ilość.');
    }

    // Sprawdź długość
    if (strlen($product_name) > 200 || strlen($product_quantity) > 50) {
        http_response_code(400);
        die('Błąd: Dane produktu przekraczają dozwoloną długość.');
    }

    $valid_products[] = [
        'name' => $product_name,
        'quantity' => $product_quantity
    ];
}

// Przygotowanie treści wiadomości
$to = "zamowienia@lodowe.com.pl";  // ZMIEŃ NA WŁAŚCIWY ADRES EMAIL!
$subject = "Nowe zamówienie produktów z Lodowe.com.pl";

$body = "Nowe zamówienie produktów:\n\n";
$body .= "=== DANE KLIENTA ===\n";
$body .= "Imię i nazwisko / Firma: " . $name . "\n";
$body .= "Email: " . $email . "\n";
$body .= "Telefon: " . $phone . "\n\n";

$body .= "=== ZAMÓWIONE PRODUKTY ===\n";
foreach ($valid_products as $index => $product) {
    $body .= ($index + 1) . ". " . $product['name'] . " - " . $product['quantity'] . "\n";
}
$body .= "\n";

$body .= "=== SZCZEGÓŁY DOSTAWY ===\n";
$body .= "Data dostawy: " . $date . "\n";
$body .= "Adres dostawy:\n" . $address . "\n\n";

if (!empty($notes)) {
    $body .= "=== DODATKOWE UWAGI ===\n";
    $body .= $notes . "\n\n";
}

$body .= "---\n";
$body .= "Zamówienie wysłane z formularza produktów na stronie Lodowe.com.pl\n";
$body .= "Data wysłania: " . date('Y-m-d H:i:s') . "\n";

// Bezpieczne nagłówki
$headers  = "From: Formularz Zamówień <noreply@lodowe.com.pl>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Wyślij maila
if (mail($to, $subject, $body, $headers)) {
    $_SESSION['last_order_submit_time'] = $current_time;

    // Przekieruj z komunikatem sukcesu
    header('Location: uslugi/produkty-z-lodu.html?success=1');
    exit;
} else {
    http_response_code(500);
    error_log("Błąd wysyłki email z formularza zamówień produktów");
    die('Błąd: Nie udało się wysłać zamówienia. Spróbuj ponownie później lub skontaktuj się telefonicznie: 511 110 265');
}
?>
