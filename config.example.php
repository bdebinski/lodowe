<?php
/**
 * Przykładowy plik konfiguracji
 *
 * Skopiuj ten plik do config.php i uzupełnij prawdziwymi wartościami.
 * Plik config.php jest ignorowany przez Git i nie będzie commitowany.
 */

// Klucze reCAPTCHA v3
// Uzyskaj je na: https://www.google.com/recaptcha/admin
define('RECAPTCHA_SECRET_KEY', 'YOUR_RECAPTCHA_SECRET_KEY');
define('RECAPTCHA_SITE_KEY', 'YOUR_RECAPTCHA_SITE_KEY');

// Adresy email do wysyłki formularzy
define('CONTACT_EMAIL', 'your-email@example.com');
define('ORDER_EMAIL', 'orders@example.com');

// Rate limiting - czas w sekundach między wysyłkami formularzy
define('RATE_LIMIT_CONTACT', 60);  // 60 sekund dla formularza kontaktowego
define('RATE_LIMIT_ORDER', 60);    // 60 sekund dla formularza zamówień

// Środowisko (development/production)
define('ENVIRONMENT', 'production');

// Wyświetlanie błędów (dla development ustaw true)
define('DISPLAY_ERRORS', ENVIRONMENT === 'development');

return [
    'recaptcha' => [
        'secret_key' => RECAPTCHA_SECRET_KEY,
        'site_key' => RECAPTCHA_SITE_KEY,
    ],
    'email' => [
        'contact' => CONTACT_EMAIL,
        'order' => ORDER_EMAIL,
    ],
    'rate_limit' => [
        'contact' => RATE_LIMIT_CONTACT,
        'order' => RATE_LIMIT_ORDER,
    ],
    'environment' => ENVIRONMENT,
    'display_errors' => DISPLAY_ERRORS,
];
