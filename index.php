<?php
// Włącz raportowanie błędów (na czas testów)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Odbiór danych z formularza
$name    = $_POST['name']    ?? '';
$email   = $_POST['email']   ?? '';
$phone   = $_POST['phone']   ?? '';
$service = $_POST['service'] ?? '';
$message = $_POST['message'] ?? '';

// Prosta walidacja po stronie serwera
if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
    http_response_code(400);
    echo "Błąd: Brak wymaganych pól.";
    exit;
}

// Adres docelowy (zmień na swój lub zostaw do testów)
$to = "test@example.com";  // tutaj wpisz swój mail lub zostaw (MailHog przechwyci)
$subject = "Nowe zapytanie z formularza Lodowe.com.pl";

// Treść wiadomości
$body = "
Imię i nazwisko: $name
Email: $email
Telefon: $phone
Rodzaj usługi: $service

Wiadomość:
$message
";

// Nagłówki
$headers  = "From: Formularz <no-reply@lodowe.local>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Wyślij maila
if (mail($to, $subject, $body, $headers)) {
    echo "Wiadomość wysłana pomyślnie!";
} else {
    http_response_code(500);
    echo "Błąd: nie udało się wysłać wiadomości.";
}
?>
