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
    if ($time_diff < 60) {
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
$recaptcha_token = $_POST['recaptcha_token'] ?? '';

// Weryfikacja reCAPTCHA v3
// UWAGA: Zastąp 'YOUR_RECAPTCHA_SECRET_KEY' swoim prawdziwym kluczem secret
$recaptcha_secret = 'YOUR_RECAPTCHA_SECRET_KEY';

if (empty($recaptcha_token)) {
    http_response_code(400);
    die('Błąd: Weryfikacja reCAPTCHA nie powiodła się.');
}

if (!verify_recaptcha($recaptcha_token, $recaptcha_secret)) {
    http_response_code(403);
    error_log("reCAPTCHA verification failed for: $email");
    die('Błąd: Wykryto podejrzaną aktywność. Spróbuj ponownie.');
}

// Walidacja pól
if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
    http_response_code(400);
    die('Błąd: Wszystkie pola są wymagane.');
}
if (!validate_email($email)) {
    http_response_code(400);
    die('Błąd: Nieprawidłowy adres email.');
}
if (!validate_phone($phone)) {
    http_response_code(400);
    die('Błąd: Nieprawidłowy numer telefonu.');
}
if (strlen($name) > 100 || strlen($email) > 100 || strlen($phone) > 20 || strlen($message) > 5000) {
    http_response_code(400);
    die('Błąd: Dane przekraczają dozwoloną długość.');
}
if (preg_match("/[\r\n]/", $email)) {
    http_response_code(400);
    die('Błąd: Nieprawidłowy format email.');
}

// ✅ Twój prawidłowy adres docelowy
$to = "bartekd1998@gmail.com";
$subject = "Nowe zapytanie z formularza na stronie Long-Table.com.pl";

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
    http_response_code(200);
    echo "Wiadomość wysłana pomyślnie!";
} else {
    http_response_code(500);
    error_log("Błąd wysyłki email z formularza kontaktowego");
    die('Błąd: Nie udało się wysłać wiadomości. Spróbuj ponownie później.');
}
?>
