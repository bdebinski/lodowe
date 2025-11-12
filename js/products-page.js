// Products Page JavaScript

(function() {
    'use strict';

    let productCounter = 0;

    // Lista produktów
    const productsList = [
        'Lód w kostkach',
        'Lód kruszony',
        'Spiry lodowe z wzorami',
        'Kostki XXL z wzorami',
        'Naczynia lodowe (szklanki/kieliszki)',
        'Diamenty lodowe',
        'Japońskie kule lodowe',
        'Suchy lód',
        'Wielki blok lodowy',
        'Zamrażarki na lód',
        'Boxy termiczne',
        'Pokazy i warsztaty'
    ];

    // Dodaj nowy wiersz produktu
    function addProductRow(preselectedProduct = '') {
        const container = document.getElementById('products-container');
        const rowId = `product-row-${productCounter}`;
        const isFirstProduct = container.children.length === 0;

        const row = document.createElement('div');
        row.className = 'product-row';
        row.id = rowId;
        row.style.cssText = 'display: flex; gap: 10px; margin-bottom: 10px; align-items: flex-start;';

        const selectWrapper = document.createElement('div');
        selectWrapper.style.cssText = 'flex: 2;';

        const select = document.createElement('select');
        select.name = `products[${productCounter}][name]`;
        select.className = 'product-select';
        select.required = true;
        select.style.cssText = 'width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;';

        // Dodaj opcje
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = '-- Wybierz produkt --';
        select.appendChild(defaultOption);

        productsList.forEach(product => {
            const option = document.createElement('option');
            option.value = product;
            option.textContent = product;
            if (product === preselectedProduct) {
                option.selected = true;
            }
            select.appendChild(option);
        });

        selectWrapper.appendChild(select);

        // Pole ilości
        const quantityWrapper = document.createElement('div');
        quantityWrapper.style.cssText = 'flex: 1;';

        const quantityInput = document.createElement('input');
        quantityInput.type = 'text';
        quantityInput.name = `products[${productCounter}][quantity]`;
        quantityInput.placeholder = 'np. 20 kg';
        quantityInput.required = true;
        quantityInput.style.cssText = 'width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px;';

        quantityWrapper.appendChild(quantityInput);

        row.appendChild(selectWrapper);
        row.appendChild(quantityWrapper);

        // Dodaj przycisk usuwania tylko jeśli to nie pierwszy produkt
        if (!isFirstProduct) {
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn-remove-product';
            removeBtn.innerHTML = '<i class="fas fa-trash"></i>';
            removeBtn.style.cssText = 'padding: 12px 16px; background: #ef4444; color: white; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s;';

            removeBtn.addEventListener('mouseenter', function() {
                this.style.background = '#dc2626';
            });

            removeBtn.addEventListener('mouseleave', function() {
                this.style.background = '#ef4444';
            });

            removeBtn.addEventListener('click', function() {
                row.remove();
            });

            row.appendChild(removeBtn);
        } else {
            // Dodaj spacer dla pierwszego produktu, żeby układ się zgadzał
            const spacer = document.createElement('div');
            spacer.style.cssText = 'width: 48px;'; // szerokość przycisku usuwania
            row.appendChild(spacer);
        }

        container.appendChild(row);
        productCounter++;

        return row;
    }

    // Handle "Zamów Teraz" buttons
    function initOrderButtons() {
        const orderButtons = document.querySelectorAll('.btn-order');
        const orderForm = document.getElementById('orderForm');

        orderButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productName = this.getAttribute('data-product');

                // Wyczyść istniejące produkty i dodaj wybrany
                const container = document.getElementById('products-container');
                container.innerHTML = '';
                productCounter = 0;
                addProductRow(productName);

                // Scroll to order form
                if (orderForm) {
                    orderForm.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    // Highlight form briefly
                    orderForm.parentElement.style.animation = 'highlight 1s ease';
                    setTimeout(() => {
                        orderForm.parentElement.style.animation = '';
                    }, 1000);
                }
            });
        });
    }

    // Obsługa przycisku "Dodaj Produkt"
    function initAddProductButton() {
        const addBtn = document.getElementById('add-product-btn');
        if (addBtn) {
            addBtn.addEventListener('click', function() {
                addProductRow();
            });
        }
    }

    // Add highlight animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes highlight {
            0%, 100% {
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
            }
            50% {
                box-shadow: 0 10px 60px rgba(8, 145, 178, 0.3);
            }
        }
    `;
    document.head.appendChild(style);

    // Handle order form submission
    function initOrderForm() {
        const form = document.getElementById('orderForm');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                // Walidacja
                let isValid = true;
                let errors = [];

                const name = document.getElementById('order-name').value.trim();
                const email = document.getElementById('order-email').value.trim();
                const phone = document.getElementById('order-phone').value.trim();
                const date = document.getElementById('order-date').value;
                const address = document.getElementById('order-address').value.trim();

                if (!name) {
                    errors.push('Proszę podać imię i nazwisko lub nazwę firmy');
                    isValid = false;
                }

                if (!email || !isValidEmail(email)) {
                    errors.push('Proszę podać poprawny adres email');
                    isValid = false;
                }

                if (!phone || !isValidPhone(phone)) {
                    errors.push('Proszę podać poprawny numer telefonu');
                    isValid = false;
                }

                // Sprawdź czy jest co najmniej jeden produkt
                const productSelects = document.querySelectorAll('.product-select');
                if (productSelects.length === 0) {
                    errors.push('Proszę dodać przynajmniej jeden produkt');
                    isValid = false;
                } else {
                    // Sprawdź czy wszystkie produkty są wybrane
                    let hasEmptyProduct = false;
                    productSelects.forEach(select => {
                        if (!select.value) {
                            hasEmptyProduct = true;
                        }
                    });
                    if (hasEmptyProduct) {
                        errors.push('Proszę wybrać wszystkie produkty lub usunąć puste wiersze');
                        isValid = false;
                    }
                }

                if (!date) {
                    errors.push('Proszę wybrać datę dostawy');
                    isValid = false;
                }

                if (!address) {
                    errors.push('Proszę podać adres dostawy');
                    isValid = false;
                }

                // Show errors if validation failed
                if (!isValid) {
                    showNotification('Błąd walidacji', errors.join('<br>'), 'error');
                    return;
                }

                // Check if date is not in the past
                const selectedDate = new Date(date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    showNotification('Błąd', 'Data dostawy nie może być w przeszłości', 'error');
                    return;
                }

                const submitButton = form.querySelector('button[type="submit"]');

                // Zablokuj przycisk podczas wysyłania
                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Wysyłanie...';
                }

                // Sprawdź konfigurację reCAPTCHA
                if (!window.recaptchaSiteKey || window.recaptchaSiteKey === 'YOUR_SITE_KEY_HERE') {
                    console.error('reCAPTCHA site key is not configured properly:', window.recaptchaSiteKey);
                    showNotification('Błąd konfiguracji', 'Klucz reCAPTCHA nie został skonfigurowany. Skontaktuj się z administratorem.', 'error');
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="fas fa-paper-plane"></i> Wyślij Zamówienie';
                    }
                    return;
                }

                // Sprawdź czy grecaptcha jest dostępne
                if (typeof grecaptcha === 'undefined') {
                    console.error('grecaptcha is not loaded. Check if the reCAPTCHA script is blocked or failed to load.');
                    showNotification('Błąd ładowania', 'Nie można załadować reCAPTCHA. Sprawdź połączenie internetowe lub wyłącz adblocker.', 'error');
                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.innerHTML = '<i class="fas fa-paper-plane"></i> Wyślij Zamówienie';
                    }
                    return;
                }

                // Generuj token reCAPTCHA przed wysyłką
                grecaptcha.ready(function() {
                    grecaptcha.execute(window.recaptchaSiteKey, {action: 'order_form'}).then(function(token) {
                        // Dodaj token do formularza
                        document.getElementById('recaptcha_token_order').value = token;

                        // Teraz wyślij formularz przez AJAX
                        const formData = new FormData(form);

                        fetch('../order-products.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                showNotification('Sukces!', data.message, 'success');
                                // Wyczyść formularz po sukcesie
                                form.reset();
                                // Wyczyść produkty i dodaj jeden pusty wiersz
                                const container = document.getElementById('products-container');
                                container.innerHTML = '';
                                productCounter = 0;
                                addProductRow();
                            } else {
                                showNotification('Błąd', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('Błąd', 'Nie udało się wysłać zamówienia. Spróbuj ponownie.', 'error');
                        })
                        .finally(() => {
                            // Odblokuj przycisk
                            if (submitButton) {
                                submitButton.disabled = false;
                                submitButton.innerHTML = '<i class="fas fa-paper-plane"></i> Wyślij Zamówienie';
                            }
                        });
                    }).catch(function(error) {
                        console.error('reCAPTCHA execute error:', error);
                        showNotification('Błąd', 'Weryfikacja reCAPTCHA nie powiodła się. Spróbuj ponownie.', 'error');
                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.innerHTML = '<i class="fas fa-paper-plane"></i> Wyślij Zamówienie';
                        }
                    });
                });
            });
        }
    }

    // Email validation
    function isValidEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Phone validation
    function isValidPhone(phone) {
        const re = /^[\d\s\+\-\(\)]+$/;
        return re.test(phone) && phone.replace(/\D/g, '').length >= 9;
    }

    // Show notification (reuse from main script)
    function showNotification(title, message, type) {
        // Remove existing notifications
        const existing = document.querySelectorAll('.notification');
        existing.forEach(n => n.remove());

        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;

        const bgColors = {
            success: '#10B981',
            error: '#EF4444',
            info: '#06B6D4'
        };

        notification.innerHTML = `
            <div class="notification-content">
                <h4>${title}</h4>
                <p>${message}</p>
            </div>
            <button class="notification-close">&times;</button>
        `;

        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 20px;
            background: ${bgColors[type]};
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            max-width: 400px;
            animation: slideInRight 0.5s ease;
        `;

        document.body.appendChild(notification);

        // Close button
        const closeBtn = notification.querySelector('.notification-close');
        closeBtn.style.cssText = `
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.7;
            transition: opacity 0.3s;
        `;

        closeBtn.addEventListener('mouseenter', () => closeBtn.style.opacity = '1');
        closeBtn.addEventListener('mouseleave', () => closeBtn.style.opacity = '0.7');

        closeBtn.addEventListener('click', function() {
            notification.style.animation = 'slideOutRight 0.5s ease';
            setTimeout(() => notification.remove(), 500);
        });

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.style.animation = 'slideOutRight 0.5s ease';
                setTimeout(() => notification.remove(), 500);
            }
        }, 5000);
    }

    // Set minimum date to today
    function initDatePicker() {
        const dateInput = document.getElementById('order-date');
        if (dateInput) {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            const year = tomorrow.getFullYear();
            const month = String(tomorrow.getMonth() + 1).padStart(2, '0');
            const day = String(tomorrow.getDate()).padStart(2, '0');
            
            dateInput.min = `${year}-${month}-${day}`;
        }
    }

    // Product card hover effects
    function initProductCards() {
        const productCards = document.querySelectorAll('.product-card');

        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initOrderButtons();
            initAddProductButton();
            initOrderForm();
            initDatePicker();
            initProductCards();
            // Dodaj pierwszy pusty wiersz produktu
            addProductRow();
        });
    } else {
        initOrderButtons();
        initAddProductButton();
        initOrderForm();
        initDatePicker();
        initProductCards();
        // Dodaj pierwszy pusty wiersz produktu
        addProductRow();
    }

})();