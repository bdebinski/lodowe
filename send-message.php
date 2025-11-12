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

// Prosta ochrona przed spamem
session_start();
$current_time = time();
if (isset($_SESSION['last_submit_time'])) {
    $time_diff = $current_time - $_SESSION['last_submit_time'];
    if ($time_diff < RATE_LIMIT_CONTACT) {
        $wait_time = RATE_LIMIT_CONTACT - $time_diff;
        sendJsonResponse(false, "Proszę poczekać jeszcze {$wait_time} sekund przed wysłaniem kolejnego formularza.", 429);
    }
}

// Odbiór i sanityzacja danych z formularza
$name    = sanitize_input($_POST['name']    ?? '');
$email   = sanitize_input($_POST['email']   ?? '');
$phone   = sanitize_input($_POST['phone']   ?? '');
$service = sanitize_input($_POST['service'] ?? '');
$message = sanitize_input($_POST['message'] ?? '');
$recaptcha_token = $_POST['recaptcha_token'] ?? '';

// Weryfikacja reCAPTCHA v3
if (empty($recaptcha_token)) {
    sendJsonResponse(false, 'Weryfikacja reCAPTCHA nie powiodła się.', 400);
}

if (!verify_recaptcha($recaptcha_token, RECAPTCHA_SECRET_KEY)) {
    error_log("reCAPTCHA verification failed for: $email");
    sendJsonResponse(false, 'Wykryto podejrzaną aktywność. Spróbuj ponownie.', 403);
}

// Walidacja pól
if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
    sendJsonResponse(false, 'Wszystkie pola są wymagane.', 400);
}
if (!validate_email($email)) {
    sendJsonResponse(false, 'Nieprawidłowy adres email.', 400);
}
if (!validate_phone($phone)) {
    sendJsonResponse(false, 'Nieprawidłowy numer telefonu.', 400);
}
if (strlen($name) > 100 || strlen($email) > 100 || strlen($phone) > 20 || strlen($message) > 5000) {
    sendJsonResponse(false, 'Dane przekraczają dozwoloną długość.', 400);
}
if (preg_match("/[\r\n]/", $email)) {
    sendJsonResponse(false, 'Nieprawidłowy format email.', 400);
}

// Adres docelowy z konfiguracji
$to = CONTACT_EMAIL;
$subject = "Nowe zapytanie z formularza na stronie Lodowe.com.pl";

// Treść wiadomości
$body = "Nowe zapytanie z formularza kontaktowego:\n\n";
$body .= "Imię i nazwisko: $name\n";
$body .= "Email: $email\n";
$body .= "Telefon: $phone\n";
$body .= "Rodzaj usługi: $service\n\n";
$body .= "Wiadomość:\n$message\n";

// ✅ Poprawione nagłówki zgodne z CyberFolks
$headers  = "From: Formularz lodowe.com.pl <noreply@lodowe.com.pl>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Wysyłka
if (mail($to, $subject, $body, $headers)) {
    $_SESSION['last_submit_time'] = $current_time;
    sendJsonResponse(true, 'Dziękujemy! Twoja wiadomość została wysłana. Skontaktujemy się wkrótce!', 200);
} else {
    error_log("Błąd wysyłki email z formularza kontaktowego");
    sendJsonResponse(false, 'Nie udało się wysłać wiadomości. Spróbuj ponownie później lub skontaktuj się telefonicznie: 511 110 265, 501 494 787, 608 401 730', 500);
}
?>
