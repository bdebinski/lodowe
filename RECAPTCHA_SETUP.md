# 🔒 Instrukcja Konfiguracji Google reCAPTCHA v3

## ✅ Co zostało dodane?

Google reCAPTCHA v3 została zintegrowana z:
- ✉️ **Formularz kontaktowy** (index.html)
- 🛒 **Formularz zamówień** (uslugi/produkty-z-lodu.html)

## 📝 Krok 1: Rejestracja w Google reCAPTCHA

1. Przejdź do: https://www.google.com/recaptcha/admin/create

2. Zaloguj się na konto Google

3. Wypełnij formularz:
   - **Label**: `lodowe.com.pl`
   - **reCAPTCHA type**: Wybierz `reCAPTCHA v3`
   - **Domains**: Dodaj:
     - `lodowe.com.pl`
     - `www.lodowe.com.pl`
     - `localhost` (dla testów lokalnych - opcjonalnie)
   - **Accept the reCAPTCHA Terms of Service**: ✅ Zaznacz

4. Kliknij **Submit**

5. **ZAPISZ** otrzymane klucze:
   - 🔑 **Site Key** (klucz publiczny)
   - 🔐 **Secret Key** (klucz prywatny - **NIE UDOSTĘPNIAJ PUBLICZNIE!**)

---

## 🛠️ Krok 2: Konfiguracja kluczy na stronie

### A) Frontend (pliki HTML)

Otwórz i zaktualizuj **3 miejsca** gdzie jest `YOUR_RECAPTCHA_SITE_KEY`:

#### 1️⃣ **index.html** (linia 33)
```html
<!-- Google reCAPTCHA v3 -->
<script src="https://www.google.com/recaptcha/api.js?render=YOUR_RECAPTCHA_SITE_KEY"></script>
```

Zamień `YOUR_RECAPTCHA_SITE_KEY` na **Site Key**:
```html
<script src="https://www.google.com/recaptcha/api.js?render=6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"></script>
```

#### 2️⃣ **index.html** (linia 670)
```javascript
grecaptcha.execute('YOUR_RECAPTCHA_SITE_KEY', {action: 'contact_form'})
```

Zamień na:
```javascript
grecaptcha.execute('6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', {action: 'contact_form'})
```

#### 3️⃣ **uslugi/produkty-z-lodu.html** (linia 24)
```html
<!-- Google reCAPTCHA v3 -->
<script src="https://www.google.com/recaptcha/api.js?render=YOUR_RECAPTCHA_SITE_KEY"></script>
```

Zamień na:
```html
<script src="https://www.google.com/recaptcha/api.js?render=6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX"></script>
```

#### 4️⃣ **uslugi/produkty-z-lodu.html** (linia 770)
```javascript
grecaptcha.execute('YOUR_RECAPTCHA_SITE_KEY', {action: 'order_form'})
```

Zamień na:
```javascript
grecaptcha.execute('6LcXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX', {action: 'order_form'})
```

---

### B) Backend (pliki PHP)

Zaktualizuj **2 pliki PHP** gdzie jest `YOUR_RECAPTCHA_SECRET_KEY`:

#### 5️⃣ **send-message.php** (linia 79)
```php
$recaptcha_secret = 'YOUR_RECAPTCHA_SECRET_KEY';
```

Zamień `YOUR_RECAPTCHA_SECRET_KEY` na **Secret Key**:
```php
$recaptcha_secret = '6LcYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY';
```

#### 6️⃣ **order-products.php** (linia 92)
```php
$recaptcha_secret = 'YOUR_RECAPTCHA_SECRET_KEY';
```

Zamień na:
```php
$recaptcha_secret = '6LcYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY';
```

---

## 🧪 Krok 3: Testowanie

### Test lokalny:
1. Otwórz stronę w przeglądarce
2. Wypełnij formularz kontaktowy lub zamówień
3. Kliknij "Wyślij"
4. **Sprawdź**:
   - ✅ Formularz wysłany pomyślnie
   - ❌ Jeśli błąd "Weryfikacja reCAPTCHA nie powiodła się" - sprawdź klucze

### Test na produkcji:
Po wdrożeniu na serwer:
1. Wypełnij formularz na stronie produkcyjnej
2. Sprawdź czy email został dostarczony
3. Przejdź do **Google reCAPTCHA Admin**: https://www.google.com/recaptcha/admin
4. Kliknij na swoją domenę i sprawdź statystyki

---

## 📊 Krok 4: Monitoring (opcjonalny)

### Panel administracyjny Google reCAPTCHA:
- URL: https://www.google.com/recaptcha/admin
- Możesz monitorować:
  - Liczbę weryfikacji
  - Score użytkowników (0.0 - bot, 1.0 - człowiek)
  - Zablokowane próby

### ✅ Pełna weryfikacja wyników (Assessment API)

**Od wersji 2025-01** implementacja zawiera pełną weryfikację zgodnie z wymogami Google:

1. **Weryfikacja success** - czy token jest ważny
2. **Weryfikacja score** - ocena od 0.0 (bot) do 1.0 (człowiek)
3. **Weryfikacja action** - czy akcja zgadza się z oczekiwaną (`submit` lub `order_form`)
4. **Weryfikacja hostname** - czy żądanie pochodzi z dozwolonej domeny
5. **Raportowanie IP** - adres IP użytkownika jest wysyłany do Google dla lepszego wykrywania botów
6. **Szczegółowe logowanie** - wszystkie weryfikacje są logowane dla audytu

Ta rozszerzona weryfikacja spełnia wymagania Google reCAPTCHA v3 dotyczące zgłaszania wyników oceny.

### Dostosowanie threshold (opcjonalnie):

Aktualnie score threshold ustawiony jest na **0.5** (linie 90 w send-message.php i order-products.php):
```php
if ($response->score < 0.5) {
    error_log("reCAPTCHA score too low: " . $response->score);
    return false;
}
```

Możesz zmienić na:
- **0.3** - bardziej tolerancyjne (mniej false positives)
- **0.7** - bardziej restrykcyjne (więcej bezpieczeństwa)

---

## 🔐 Bezpieczeństwo

### ⚠️ WAŻNE:
1. **NIE UDOSTĘPNIAJ** Secret Key publicznie
2. **NIE COMMITUJ** Secret Key do repozytorium Git
3. Rozważ przeniesienie Secret Key do zmiennej środowiskowej:
   ```php
   $recaptcha_secret = getenv('RECAPTCHA_SECRET_KEY');
   ```

### Polityka prywatności:
Dodaj informację o używaniu reCAPTCHA do polityki prywatności:
```
Ta strona jest chroniona przez Google reCAPTCHA.
Obowiązują Polityka prywatności i Warunki użytkowania Google.
```

Link do dodania w stopce:
- https://policies.google.com/privacy
- https://policies.google.com/terms

---

## ❓ Rozwiązywanie problemów

### Problem 1: "Weryfikacja reCAPTCHA nie powiodła się"
**Rozwiązanie:**
- Sprawdź czy Site Key i Secret Key są poprawne
- Sprawdź czy domena jest dodana w panelu Google

### Problem 2: Formularz nie wysyła się
**Rozwiązanie:**
- Otwórz konsolę przeglądarki (F12)
- Sprawdź czy są błędy JavaScript
- Sprawdź czy reCAPTCHA jest załadowana (`grecaptcha is not defined`)

### Problem 3: Score za niski (użytkownicy są blokowani)
**Rozwiązanie:**
- Obniż threshold z 0.5 na 0.3 w plikach PHP
- Sprawdź w Google Admin czy faktycznie są to boty

---

## 📞 Kontakt

W razie problemów skontaktuj się z administratorem strony:
- Email: bartekd1998@gmail.com

---

## ✅ Checklist

- [ ] Zarejestrowano domenę w Google reCAPTCHA Admin
- [ ] Skopiowano Site Key i Secret Key
- [ ] Zaktualizowano 4 miejsca z Site Key (2x index.html, 2x produkty-z-lodu.html)
- [ ] Zaktualizowano 2 miejsca z Secret Key (send-message.php, order-products.php)
- [ ] Przetestowano formularz kontaktowy
- [ ] Przetestowano formularz zamówień
- [ ] Sprawdzono statystyki w Google Admin
- [ ] Dodano wzmiankę o reCAPTCHA w polityce prywatności

---

**Data utworzenia:** 2025-01-07
**Wersja reCAPTCHA:** v3
**Status:** ✅ Gotowe do konfiguracji
