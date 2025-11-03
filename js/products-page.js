// Products Page JavaScript

(function() {
    'use strict';

    // Handle "Zamów Teraz" buttons
    function initOrderButtons() {
        const orderButtons = document.querySelectorAll('.btn-order');
        const orderForm = document.getElementById('orderForm');
        const productSelect = document.getElementById('order-product');

        orderButtons.forEach(button => {
            button.addEventListener('click', function() {
                const productName = this.getAttribute('data-product');
                
                // Set selected product in form
                if (productSelect && productName) {
                    productSelect.value = productName;
                }

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

                // Get form data
                const formData = new FormData(form);
                const data = Object.fromEntries(formData);

                // Validation
                let isValid = true;
                let errors = [];

                if (!data.name || data.name.trim() === '') {
                    errors.push('Proszę podać imię i nazwisko lub nazwę firmy');
                    isValid = false;
                }

                if (!data.email || !isValidEmail(data.email)) {
                    errors.push('Proszę podać poprawny adres email');
                    isValid = false;
                }

                if (!data.phone || !isValidPhone(data.phone)) {
                    errors.push('Proszę podać poprawny numer telefonu');
                    isValid = false;
                }

                if (!data.product || data.product === '') {
                    errors.push('Proszę wybrać produkt');
                    isValid = false;
                }

                if (!data.quantity || data.quantity.trim() === '') {
                    errors.push('Proszę podać ilość');
                    isValid = false;
                }

                if (!data.date || data.date === '') {
                    errors.push('Proszę wybrać datę dostawy');
                    isValid = false;
                }

                if (!data.address || data.address.trim() === '') {
                    errors.push('Proszę podać adres dostawy');
                    isValid = false;
                }

                // Show errors if validation failed
                if (!isValid) {
                    showNotification('Błąd walidacji', errors.join('<br>'), 'error');
                    return;
                }

                // Check if date is not in the past
                const selectedDate = new Date(data.date);
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                if (selectedDate < today) {
                    showNotification('Błąd', 'Data dostawy nie może być w przeszłości', 'error');
                    return;
                }

                // Success notification
                showNotification(
                    'Zamówienie Wysłane!',
                    'Dziękujemy za zamówienie. Skontaktujemy się w ciągu 2 godzin roboczych.',
                    'success'
                );

                // Log data (in production, send to server)
                console.log('Zamówienie:', data);

                // Reset form
                form.reset();

                // In production, send to server via AJAX
                // fetch('/api/orders', {
                //     method: 'POST',
                //     body: JSON.stringify(data),
                //     headers: { 'Content-Type': 'application/json' }
                // });
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
            initOrderForm();
            initDatePicker();
            initProductCards();
        });
    } else {
        initOrderButtons();
        initOrderForm();
        initDatePicker();
        initProductCards();
    }

})();