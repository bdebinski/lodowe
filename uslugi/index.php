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

// Prosta ochrona przed spamem - rate limiting (opcjonalne)
session_start();
$current_time = time();
if (isset($_SESSION['last_submit_time'])) {
    $time_diff = $current_time - $_SESSION['last_submit_time'];
    if ($time_diff < 60) { // Minimum 60 sekund między wysyłkami
        http_response_code(429);
        die('Proszę poczekać przed wysłaniem kolejnego formularza.');
    }
}

// Odbiór i sanityzacja danych z formularza
$name    = sanitize_input($_POST['name']    ?? '');
$email   = sanitize_input($_POST['email']   ?? '');
$phone   = sanitize_input($_POST['phone']   ?? '');
$service = sanitize_input($_POST['service'] ?? '');
$message = sanitize_input($_POST['message'] ?? '');

// Walidacja wymaganych pól
if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
    http_response_code(400);
    die('Błąd: Wszystkie pola są wymagane.');
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
if (strlen($name) > 100 || strlen($email) > 100 || strlen($phone) > 20 || strlen($message) > 5000) {
    http_response_code(400);
    die('Błąd: Dane przekraczają dozwoloną długość.');
}

// Ochrona przed email injection - sprawdź czy email nie zawiera niebezpiecznych znaków
if (preg_match("/[\r\n]/", $email)) {
    http_response_code(400);
    die('Błąd: Nieprawidłowy format email.');
}

// Adres docelowy (ZMIEŃ NA SWÓJ!)
$to = "kontakt@lodowe.com.pl";  // ZMIEŃ NA WŁAŚCIWY ADRES EMAIL!
$subject = "Nowe zapytanie z formularza Lodowe.com.pl";

// Treść wiadomości - używamy własnych etykiet zamiast zmiennych użytkownika
$body = "Nowe zapytanie z formularza kontaktowego:\n\n";
$body .= "Imię i nazwisko: " . $name . "\n";
$body .= "Email: " . $email . "\n";
$body .= "Telefon: " . $phone . "\n";
$body .= "Rodzaj usługi: " . $service . "\n\n";
$body .= "Wiadomość:\n" . $message . "\n";

// Bezpieczne nagłówki - używamy stałego adresu Reply-To z walidacją
$headers  = "From: Formularz Kontaktowy <noreply@lodowe.com.pl>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";  // Bezpieczne po walidacji
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Wyślij maila
if (mail($to, $subject, $body, $headers)) {
    $_SESSION['last_submit_time'] = $current_time;
    http_response_code(200);
    echo "Wiadomość wysłana pomyślnie!";
} else {
    http_response_code(500);
    error_log("Błąd wysyłki email z formularza kontaktowego");
    die('Błąd: Nie udało się wysłać wiadomości. Spróbuj ponownie później.');
}
?>
