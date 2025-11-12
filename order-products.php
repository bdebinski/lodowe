<?php
// Załaduj konfigurację
if (!file_exists(__DIR__ . '/config.php')) {
    http_response_code(500);
    die(json_encode([
        'success' => false,
        'message' => 'Błąd konfiguracji serwera. Skontaktuj się z administratorem.'
    ], JSON_UNESCAPED_UNICODE));
}
require_once __DIR__ . '/config.php';

// Wyłącz wyświetlanie błędów w produkcji (logi w error_log)
error_reporting(E_ALL);
ini_set('display_errors', DISPLAY_ERRORS ? 1 : 0);
ini_set('log_errors', 1);

// Ustaw nagłówek JSON
header('Content-Type: application/json; charset=UTF-8');

// Funkcja do zwracania odpowiedzi JSON
function sendJsonResponse($success, $message, $httpCode = 200) {
    http_response_code($httpCode);
    echo json_encode([
        'success' => $success,
        'message' => $message
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// Sprawdź czy to żądanie POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendJsonResponse(false, 'Method Not Allowed', 405);
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

function verify_recaptcha($token, $secret_key) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $secret_key,
        'response' => $token
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        return false;
    }

    $response = json_decode($result);

    // Sprawdź czy weryfikacja powiodła się i score jest wystarczająco wysoki (>= 0.5)
    return $response->success && $response->score >= 0.5;
}

// Prosta ochrona przed spamem - rate limiting
session_start();
$current_time = time();
if (isset($_SESSION['last_order_submit_time'])) {
    $time_diff = $current_time - $_SESSION['last_order_submit_time'];
    if ($time_diff < RATE_LIMIT_ORDER) {
        $wait_time = RATE_LIMIT_ORDER - $time_diff;
        sendJsonResponse(false, "Proszę poczekać jeszcze {$wait_time} sekund przed wysłaniem kolejnego zamówienia.", 429);
    }
}

// Odbiór i sanityzacja danych podstawowych
$name    = sanitize_input($_POST['name']    ?? '');
$email   = sanitize_input($_POST['email']   ?? '');
$phone   = sanitize_input($_POST['phone']   ?? '');
$date    = sanitize_input($_POST['date']    ?? '');
$address = sanitize_input($_POST['address'] ?? '');
$notes   = sanitize_input($_POST['notes']   ?? '');
$recaptcha_token = $_POST['recaptcha_token'] ?? '';

// Weryfikacja reCAPTCHA v3
if (empty($recaptcha_token)) {
    sendJsonResponse(false, 'Weryfikacja reCAPTCHA nie powiodła się.', 400);
}

if (!verify_recaptcha($recaptcha_token, RECAPTCHA_SECRET_KEY)) {
    error_log("reCAPTCHA verification failed for order from: $email");
    sendJsonResponse(false, 'Wykryto podejrzaną aktywność. Spróbuj ponownie lub skontaktuj się telefonicznie.', 403);
}

// Walidacja wymaganych pól
if (empty($name) || empty($email) || empty($phone) || empty($date) || empty($address)) {
    sendJsonResponse(false, 'Wszystkie wymagane pola muszą być wypełnione.', 400);
}

// Walidacja formatu email
if (!validate_email($email)) {
    sendJsonResponse(false, 'Nieprawidłowy adres email.', 400);
}

// Walidacja telefonu
if (!validate_phone($phone)) {
    sendJsonResponse(false, 'Nieprawidłowy numer telefonu.', 400);
}

// Sprawdź długość pól (ochrona przed atakami)
if (strlen($name) > 100 || strlen($email) > 100 || strlen($phone) > 20 ||
    strlen($address) > 500 || strlen($notes) > 5000) {
    sendJsonResponse(false, 'Dane przekraczają dozwoloną długość.', 400);
}

// Ochrona przed email injection
if (preg_match("/[\r\n]/", $email)) {
    sendJsonResponse(false, 'Nieprawidłowy format email.', 400);
}

// Walidacja daty (sprawdź czy nie jest w przeszłości)
$selected_date = strtotime($date);
$today = strtotime(date('Y-m-d'));
if ($selected_date < $today) {
    sendJsonResponse(false, 'Data dostawy nie może być w przeszłości.', 400);
}

// Odbiór i walidacja produktów
$products = $_POST['products'] ?? [];

if (empty($products) || !is_array($products)) {
    sendJsonResponse(false, 'Proszę dodać przynajmniej jeden produkt.', 400);
}

// Walidacja produktów
$valid_products = [];
$max_products = 20; // Maksymalnie 20 produktów w jednym zamówieniu

if (count($products) > $max_products) {
    sendJsonResponse(false, 'Zbyt wiele produktów w zamówieniu (max ' . $max_products . ').', 400);
}

foreach ($products as $product) {
    if (!isset($product['name']) || !isset($product['quantity'])) {
        sendJsonResponse(false, 'Nieprawidłowe dane produktu.', 400);
    }

    $product_name = sanitize_input($product['name']);
    $product_quantity = sanitize_input($product['quantity']);

    if (empty($product_name) || empty($product_quantity)) {
        sendJsonResponse(false, 'Wszystkie produkty muszą mieć nazwę i ilość.', 400);
    }

    // Sprawdź długość
    if (strlen($product_name) > 200 || strlen($product_quantity) > 50) {
        sendJsonResponse(false, 'Dane produktu przekraczają dozwoloną długość.', 400);
    }

    $valid_products[] = [
        'name' => $product_name,
        'quantity' => $product_quantity
    ];
}

// Przygotowanie treści wiadomości
$to = ORDER_EMAIL;
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
    sendJsonResponse(true, 'Dziękujemy! Twoje zamówienie zostało wysłane. Skontaktujemy się wkrótce!', 200);
} else {
    error_log("Błąd wysyłki email z formularza zamówień produktów");
    sendJsonResponse(false, 'Nie udało się wysłać zamówienia. Spróbuj ponownie później lub skontaktuj się telefonicznie: 511 110 265, 501 494 787, 608 401 730', 500);
}
?>
