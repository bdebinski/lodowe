// Products Page & Shopping Cart JavaScript

(function () {
    'use strict';

    // --- CART STATE & PERSISTENCE ---
    let cart = {}; // { "Product Name": quantity }

    function saveCart() {
        try {
            localStorage.setItem('lodowe_b2b_cart', JSON.stringify(cart));
        } catch (e) {
            console.error('LocalStorage write failed:', e);
        }
    }

    function loadCart() {
        try {
            const saved = localStorage.getItem('lodowe_b2b_cart');
            if (saved) {
                cart = JSON.parse(saved) || {};
            }
        } catch (e) {
            console.error('LocalStorage read failed:', e);
            cart = {};
        }
    }

    // --- HELPERS ---
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function isValidPhone(phone) {
        const digits = phone.replace(/\D/g, '');
        return digits.length >= 9 && digits.length <= 15;
    }

    function showNotification(title, message, type = 'success') {
        document.querySelectorAll('.toast-notification').forEach(el => el.remove());

        const notification = document.createElement('div');
        notification.className = 'toast-notification';
        notification.innerHTML = `
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="background: ${type === 'success' ? 'rgba(56, 189, 248, 0.15)' : 'rgba(239, 68, 68, 0.15)'}; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: ${type === 'success' ? '#38BDF8' : '#EF4444'};">
                    <i class="fas ${type === 'success' ? 'fa-check' : 'fa-exclamation'}" style="font-size: 1.1rem;"></i>
                </div>
                <div>
                    <strong style="display: block; font-size: 0.95rem; color: #FFFFFF; margin-bottom: 2px;">${title}</strong>
                    <span style="font-size: 0.85rem; color: #94A3B8;">${message}</span>
                </div>
            </div>
            <button class="toast-close-btn" style="background: transparent; border: none; color: #64748B; cursor: pointer; font-size: 1.1rem; padding: 4px; line-height: 1; transition: color 0.2s;" aria-label="Zamknij">
                <i class="fas fa-times"></i>
            </button>
        `;

        const dismiss = () => {
            notification.classList.add('hide');
            setTimeout(() => {
                if (notification.parentElement) notification.remove();
            }, 250);
        };

        notification.addEventListener('click', dismiss);

        document.body.appendChild(notification);
        setTimeout(dismiss, 3500);
    }

    function parseItemPrice(name) {
        const match = name.match(/(\d+)\s*(zł|PLN)/i);
        if (match && match[1]) {
            return parseInt(match[1], 10);
        }
        return 0;
    }

    function updateFreeShippingBar(items) {
        const barContainer = document.getElementById('free-shipping-bar-container');
        if (!barContainer) return;

        let cartTotal = 0;
        items.forEach(([name, qty]) => {
            const price = parseItemPrice(name);
            cartTotal += price * qty;
        });

        const threshold = 250;

        if (items.length === 0) {
            barContainer.innerHTML = `
                <div class="free-shipping-message">
                    <i class="fas fa-truck"></i> <span>Darmowa dostawa w Łodzi od <strong>250 zł</strong></span>
                </div>
                <div class="free-shipping-progress-track">
                    <div class="free-shipping-progress-fill" style="width: 0%;"></div>
                </div>
            `;
            return;
        }

        if (cartTotal > 0 && cartTotal < threshold) {
            const needed = threshold - cartTotal;
            const percent = Math.min(Math.round((cartTotal / threshold) * 100), 99);
            barContainer.innerHTML = `
                <div class="free-shipping-message">
                    <i class="fas fa-truck" style="color: #0284C7;"></i> <span>Brakuje Ci jeszcze <strong>${needed} zł</strong> do darmowej dostawy!</span>
                </div>
                <div class="free-shipping-progress-track">
                    <div class="free-shipping-progress-fill" style="width: ${percent}%;"></div>
                </div>
            `;
        } else if (cartTotal >= threshold) {
            barContainer.innerHTML = `
                <div class="free-shipping-message" style="color: #059669;">
                    <i class="fas fa-check-circle" style="color: #10B981;"></i> <span>Masz <strong>DARMOWĄ DOSTAWĘ</strong> w Łodzi! (${cartTotal} zł)</span>
                </div>
                <div class="free-shipping-progress-track">
                    <div class="free-shipping-progress-fill unlocked" style="width: 100%;"></div>
                </div>
            `;
        } else {
            barContainer.innerHTML = `
                <div class="free-shipping-message">
                    <i class="fas fa-truck"></i> <span>Darmowa dostawa w Łodzi od <strong>250 zł</strong></span>
                </div>
                <div class="free-shipping-progress-track">
                    <div class="free-shipping-progress-fill" style="width: 0%;"></div>
                </div>
            `;
        }
    }

    // --- CART LOGIC ---
    function updateCartUI() {
        saveCart();
        const container = document.getElementById('cart-items-container');
        const badge = document.getElementById('cart-badge-count');
        const totalPosEl = document.getElementById('cart-total-positions');
        const totalPriceEl = document.getElementById('cart-total-price');
        const miniTotalPriceEl = document.getElementById('mini-cart-total-price');
        const btnToStep2 = document.getElementById('btn-to-step-2');
        const miniList = document.getElementById('mini-cart-summary-list');
        
        if (!container || !badge) return;
        
        let totalItems = 0;
        let grandTotal = 0;
        container.innerHTML = '';
        
        const items = Object.entries(cart);
        
        updateFreeShippingBar(items);

        if (totalPosEl) totalPosEl.textContent = items.length;

        if (items.length === 0) {
            container.innerHTML = '<div class="empty-cart-msg">Koszyk jest pusty.<br><small>Wybierz produkty z listy obok.</small></div>';
            badge.textContent = '0';
            const headerBadge = document.getElementById('header-cart-badge');
            if (headerBadge) headerBadge.textContent = '0';
            if (totalPriceEl) totalPriceEl.textContent = '0 zł';
            if (miniTotalPriceEl) miniTotalPriceEl.textContent = '0 zł';
            if (btnToStep2) btnToStep2.disabled = true;
            if (miniList) miniList.innerHTML = '<em>Brak wybranych produktów</em>';
            return;
        }

        if (btnToStep2) btnToStep2.disabled = false;

        items.forEach(([name, qty]) => {
            totalItems += qty;
            const unitPrice = parseItemPrice(name);
            const itemTotal = unitPrice * qty;
            grandTotal += itemTotal;

            const priceDisplay = unitPrice > 0 ? `<div class="cart-item-price" style="font-size: 0.85rem; color: #0284C7; font-weight: 600; margin-top: 2px;">${itemTotal} zł ${qty > 1 ? `<span style="color: #94A3B8; font-weight: normal;">(${unitPrice} zł/szt)</span>` : ''}</div>` : '';

            const itemHTML = `
                <div class="cart-item">
                    <div class="cart-item-info">
                        <div class="cart-item-title">${name}</div>
                        ${priceDisplay}
                    </div>
                    <div class="cart-item-controls">
                        <button class="qty-btn minus" data-name="${name}">-</button>
                        <span class="qty-val">${qty}</span>
                        <button class="qty-btn plus" data-name="${name}">+</button>
                        <button class="remove-item" data-name="${name}"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', itemHTML);
        });
        
        badge.textContent = totalItems;
        const headerBadge = document.getElementById('header-cart-badge');
        if (headerBadge) headerBadge.textContent = totalItems;
        if (totalPriceEl) totalPriceEl.textContent = `${grandTotal} zł`;
        if (miniTotalPriceEl) miniTotalPriceEl.textContent = `${grandTotal} zł`;
        
        if (miniList) {
            miniList.innerHTML = items.map(([name, qty]) => {
                const uPrice = parseItemPrice(name);
                const sub = uPrice * qty;
                const subStr = sub > 0 ? ` — <strong>${sub} zł</strong>` : '';
                return `
                    <div class="mini-summary-item" style="display: flex; justify-content: space-between; font-size: 0.85rem; padding: 4px 0;">
                        <span>${name} (${qty}x)</span>
                        <span>${subStr}</span>
                    </div>
                `;
            }).join('');
        }

        attachCartListeners();
    }

    function attachCartListeners() {
        document.querySelectorAll('.qty-btn.plus').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const name = btn.getAttribute('data-name');
                if (name && cart[name]) {
                    cart[name]++;
                    updateCartUI();
                }
            });
        });
        document.querySelectorAll('.qty-btn.minus').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const name = btn.getAttribute('data-name');
                if (name && cart[name]) {
                    if (cart[name] > 1) {
                        cart[name]--;
                    } else {
                        delete cart[name];
                    }
                    updateCartUI();
                }
            });
        });
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const name = btn.parentElement.getAttribute('data-name') || btn.getAttribute('data-name');
                if (name) {
                    delete cart[name];
                    updateCartUI();
                }
            });
        });
    }

    function addToCart(productName) {
        if (!cart[productName]) cart[productName] = 1;
        else cart[productName]++;
        
        updateCartUI();
        showNotification('Dodano do koszyka', productName);
        
        const btn = document.getElementById('floating-cart-btn');
        if(btn) {
            btn.classList.add('pop');
            setTimeout(() => btn.classList.remove('pop'), 300);
        }
    }

    // --- UI/UX INTERACTIONS ---
    function initUI() {
        const floatingBtn = document.getElementById('floating-cart-btn');
        const drawer = document.getElementById('cart-drawer');
        const overlay = document.getElementById('cart-drawer-overlay');
        const closeBtn = document.getElementById('close-cart-btn');
        
        const btnToStep2 = document.getElementById('btn-to-step-2');
        const btnBackToStep1 = document.getElementById('btn-back-to-step-1');
        const stepNav1 = document.getElementById('step-nav-1');
        const stepNav2 = document.getElementById('step-nav-2');

        // Variant Pills Click Handler
        document.addEventListener('click', function(e) {
            const pill = e.target.closest('.variant-pill');
            if (pill) {
                e.preventDefault();
                const container = pill.closest('.variant-pills');
                if (container) {
                    container.querySelectorAll('.variant-pill').forEach(p => p.classList.remove('active'));
                    pill.classList.add('active');
                }
            }
        });

        function goToStep(stepNumber) {
            const step1View = document.getElementById('cart-step-1-view');
            const step2View = document.getElementById('cart-step-2-view');

            if (stepNumber === 1) {
                if(step1View) step1View.classList.add('active');
                if(step2View) step2View.classList.remove('active');
                if(stepNav1) { stepNav1.classList.add('active'); stepNav1.classList.remove('completed'); }
                if(stepNav2) stepNav2.classList.remove('active');
            } else if (stepNumber === 2) {
                if(step1View) step1View.classList.remove('active');
                if(step2View) step2View.classList.add('active');
                if(stepNav1) { stepNav1.classList.remove('active'); stepNav1.classList.add('completed'); }
                if(stepNav2) stepNav2.classList.add('active');
            }
        }

        function openDrawer(defaultStep = 1) {
            if(drawer) drawer.classList.add('active');
            if(overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
            goToStep(defaultStep);
        }

        function closeDrawer() {
            if(drawer) drawer.classList.remove('active');
            if(overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if(floatingBtn) floatingBtn.addEventListener('click', () => openDrawer(1));
        document.addEventListener('click', function(e) {
            const trigger = e.target.closest('#nav-cart-trigger-btn');
            if (trigger) {
                e.preventDefault();
                openDrawer(1);
            }
        });
        if(closeBtn) closeBtn.addEventListener('click', closeDrawer);
        if(overlay) overlay.addEventListener('click', closeDrawer);

        if(btnToStep2) btnToStep2.addEventListener('click', () => goToStep(2));
        if(btnBackToStep1) btnBackToStep1.addEventListener('click', () => goToStep(1));
        if(stepNav1) stepNav1.addEventListener('click', () => goToStep(1));
        if(stepNav2) stepNav2.addEventListener('click', () => {
            if (Object.keys(cart).length > 0) goToStep(2);
        });
        
        document.querySelectorAll('.btn-order').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const card = this.closest('.product-card') || this.parentElement;
                const productH3 = card.querySelector('h3');
                const activePill = card.querySelector('.variant-pill.active');
                const select = card.querySelector('.package-select');
                
                if (productH3) {
                    let fullName = productH3.innerText.trim();
                    let variantVal = '';
                    if (activePill) {
                        variantVal = activePill.getAttribute('data-value') || activePill.innerText.trim();
                    } else if (select && select.value) {
                        variantVal = select.value;
                    } else {
                        const fallbackPrice = card.querySelector('.product-pricing');
                        if (fallbackPrice) {
                            const text = fallbackPrice.innerText.trim();
                            if (text.match(/\d+\s*zł/i)) {
                                variantVal = text;
                            }
                        }
                    }
                    if (variantVal) {
                        fullName += ' — ' + variantVal;
                    }
                    addToCart(fullName);

                    // Micro-animation for button feedback
                    const btn = this;
                    const originalText = btn.innerHTML;
                    btn.classList.add('added');
                    btn.innerHTML = '<i class="fas fa-check"></i> Dodano do koszyka!';
                    setTimeout(() => {
                        btn.classList.remove('added');
                        btn.innerHTML = originalText;
                    }, 1200);
                }
            });
        });

        document.querySelectorAll('.btn-inquire').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const card = this.closest('.product-card') || this.parentElement;
                const productH3 = card.querySelector('h3');
                const activePill = card.querySelector('.variant-pill.active');
                const select = card.querySelector('.package-select');
                
                let fullName = productH3 ? productH3.innerText.trim() : '';
                let variantVal = activePill ? (activePill.getAttribute('data-value') || activePill.innerText.trim()) : (select ? select.value : '');
                if (variantVal) {
                    fullName += ' (' + variantVal + ')';
                }
                
                openDrawer(2);
                const notes = document.getElementById('drawer-notes');
                if (notes && fullName) {
                    notes.value = "Zapytanie o usługę / dodatkową wycenę dla: " + fullName + "\n\nWitam, ";
                    setTimeout(() => notes.focus(), 300);
                }
            });
        });
    }

    // --- FORM SUBMIT LOGIC ---
    function initCartForm() {
        const form = document.getElementById('drawerOrderForm');
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = document.getElementById('drawer-submit-btn');
            
            // Client-side field validation
            const nameEl = document.getElementById('drawer-name');
            const emailEl = document.getElementById('drawer-email');
            const phoneEl = document.getElementById('drawer-phone');
            const dateEl = document.getElementById('drawer-date');
            const addressEl = document.getElementById('drawer-address');
            const notesEl = document.getElementById('drawer-notes');
            
            const name = nameEl ? nameEl.value.trim() : '';
            const email = emailEl ? emailEl.value.trim() : '';
            const phone = phoneEl ? phoneEl.value.trim() : '';
            const date = dateEl ? dateEl.value.trim() : '';
            const address = addressEl ? addressEl.value.trim() : '';
            const notes = notesEl ? notesEl.value.trim() : '';

            let errors = [];
            if (!name) errors.push('Podaj imię i nazwisko lub nazwę firmy.');
            if (!email || !isValidEmail(email)) errors.push('Podaj poprawny adres e-mail.');
            if (!phone || !isValidPhone(phone)) errors.push('Podaj poprawny numer telefonu (min. 9 cyfr).');
            if (!date) errors.push('Wybierz datę dostawy.');
            if (!address) errors.push('Podaj adres dostawy.');

            let items = Object.entries(cart);
            if (items.length === 0) {
                if (notes.length > 0) {
                    items = [["Zapytanie indywidualne / Wycena", "1 szt."]];
                } else {
                    errors.push('Twój koszyk jest pusty! Wybierz produkty lub wpisz treść zapytania.');
                }
            }

            if (errors.length > 0) {
                showNotification('Błąd walidacji', errors.join('<br>'), 'error');
                return;
            }

            // Build JSON/POST mapping array inputs for order-products.php
            const inputsContainer = document.getElementById('dynamic-products-inputs');
            if (inputsContainer) {
                inputsContainer.innerHTML = '';
                items.forEach(([pName, qty], index) => {
                    const qtyStr = typeof qty === 'number' ? `${qty} opak.` : qty;
                    inputsContainer.innerHTML += `
                        <input type="hidden" name="products[${index}][name]" value="${pName}">
                        <input type="hidden" name="products[${index}][quantity]" value="${qtyStr}">
                    `;
                });
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Przetwarzanie...';

            const safetyTimeout = setTimeout(() => {
                if (btn && btn.disabled) {
                    btn.disabled = false;
                    btn.innerHTML = 'Wyślij Zamówienie';
                    showNotification('Błąd przekroczenia czasu', 'Upłynął limit czasu odpowiedzi. Spróbuj ponownie.', 'error');
                }
            }, 15000);

            const sendCartForm = () => {
                const formData = new FormData(form);
                fetch(form.action, { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    clearTimeout(safetyTimeout);
                    if (data.success) {
                        showNotification('Sukces', 'Zamówienie przekazane do realizacji!');
                        cart = {};
                        updateCartUI();
                        form.reset();
                        setTimeout(() => {
                            const closeBtn = document.getElementById('close-cart-btn');
                            if (closeBtn) closeBtn.click();
                        }, 2500);
                    } else {
                        showNotification('Błąd wysyłki', data.message || 'Wystąpił problem z wysłaniem zamówienia.', 'error');
                    }
                })
                .catch(err => {
                    clearTimeout(safetyTimeout);
                    console.error('Fetch error:', err);
                    showNotification('Błąd sieci', 'Błąd komunikacji z serwerem. Odśwież stronę i spróbuj ponownie.', 'error');
                })
                .finally(() => {
                    clearTimeout(safetyTimeout);
                    btn.disabled = false;
                    btn.innerHTML = 'Wyślij Zamówienie';
                });
            };

            // Check if reCAPTCHA script is available
            if (typeof grecaptcha === 'undefined') {
                clearTimeout(safetyTimeout);
                btn.disabled = false;
                btn.innerHTML = 'Wyślij Zamówienie';
                console.error('grecaptcha is undefined');
                showNotification('Ochrona przed spamem', 'Nie można załadować modułu reCAPTCHA. Wyłącz adblockera lub odśwież stronę.', 'error');
                return;
            }

            if (!window.recaptchaSiteKey || window.recaptchaSiteKey === 'YOUR_SITE_KEY_HERE') {
                clearTimeout(safetyTimeout);
                btn.disabled = false;
                btn.innerHTML = 'Wyślij Zamówienie';
                console.error('reCAPTCHA site key is missing or invalid');
                showNotification('Błąd konfiguracji', 'Klucz reCAPTCHA nie został skonfigurowany. Skontaktuj się z administratorem.', 'error');
                return;
            }

            const recaptchaAPI = (window.recaptchaIsEnterprise && grecaptcha.enterprise) ? grecaptcha.enterprise : grecaptcha;
            recaptchaAPI.ready(function() {
                recaptchaAPI.execute(window.recaptchaSiteKey, {action: 'order_form'}).then(function(token) {
                    let tokenEl = document.getElementById('recaptcha_token_order');
                    if (!tokenEl) {
                        tokenEl = document.createElement('input');
                        tokenEl.type = 'hidden';
                        tokenEl.id = 'recaptcha_token_order';
                        tokenEl.name = 'recaptcha_token';
                        form.appendChild(tokenEl);
                    }
                    tokenEl.value = token;
                    sendCartForm();
                }).catch(function(err) {
                    clearTimeout(safetyTimeout);
                    console.error('reCAPTCHA execution error:', err);
                    showNotification('Błąd reCAPTCHA', 'Weryfikacja ochrony antyspamowej nie powiodła się. Odśwież stronę i spróbuj ponownie.', 'error');
                    btn.disabled = false;
                    btn.innerHTML = 'Wyślij Zamówienie';
                });
            });
        });
    }

    function initFilters() {
        const filterBtns = document.querySelectorAll('.filter-btn');
        const productCards = document.querySelectorAll('.product-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                productCards.forEach(card => {
                    if (filterValue === 'all') {
                        card.style.display = 'flex'; /* Flex is needed for .product-card horizontal layout */
                    } else {
                        if (card.getAttribute('data-category') === filterValue) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });
    }

    function initDatePicker() {
        const dateInput = document.getElementById('drawer-date');
        if (dateInput) {
            const today = new Date();
            today.setDate(today.getDate() + 1); // min tomorrow
            const d = today.toISOString().split('T')[0];
            dateInput.min = d;
        }
    }

    function initCalculator() {
        const slider = document.getElementById('guestsRangeSlider');
        const display = document.getElementById('guestsCountDisplay');
        const chipBtns = document.querySelectorAll('.event-chip');
        const durBtns = document.querySelectorAll('.dur-pill');
        const addBundleBtn = document.getElementById('btnCalcAddBundle');

        if (!slider || !display || !addBundleBtn) return;

        let currentCubesRatio = 0.4;
        let currentCrushedRatio = 0.15;
        let currentDurationMult = 1.0;

        let computedCubesBags = 2;
        let computedCrushedBags = 1;
        let computedBoxQty = 1;

        function recalculate() {
            const guests = parseInt(slider.value, 10);
            display.textContent = guests + ' osób';

            // Raw kg calculation
            const rawCubesKg = guests * currentCubesRatio * currentDurationMult;
            const rawCrushedKg = guests * currentCrushedRatio * currentDurationMult;

            // Round up to bags of 10kg
            computedCubesBags = Math.max(1, Math.ceil(rawCubesKg / 10));
            computedCrushedBags = Math.max(0, Math.ceil(rawCrushedKg / 10));
            
            const totalKg = (computedCubesBags + computedCrushedBags) * 10;
            computedBoxQty = totalKg > 30 ? Math.ceil(totalKg / 30) : 1;

            const cubesTotalKg = computedCubesBags * 10;
            const crushedTotalKg = computedCrushedBags * 10;

            const priceCubes = computedCubesBags * 30; // 30 zł/10kg
            const priceCrushed = computedCrushedBags * 35; // 35 zł/10kg
            const priceBox = computedBoxQty * 35; // 35 zł/szt
            const totalPrice = priceCubes + priceCrushed + priceBox;

            // Update UI
            const guestsLabel = document.getElementById('guestsLabelInSummary');
            if (guestsLabel) guestsLabel.textContent = guests + ' os.';

            const resCubesKg = document.getElementById('resCubesKg');
            const resCubesBags = document.getElementById('resCubesBags');
            const resCrushedKg = document.getElementById('resCrushedKg');
            const resCrushedBags = document.getElementById('resCrushedBags');
            const resBoxQty = document.getElementById('resBoxQty');
            const resTotalPrice = document.getElementById('resTotalPrice');

            if (resCubesKg) resCubesKg.textContent = cubesTotalKg + ' kg';
            if (resCubesBags) resCubesBags.textContent = `(${computedCubesBags} ${computedCubesBags === 1 ? 'worek' : 'worki'})`;

            if (resCrushedKg) resCrushedKg.textContent = crushedTotalKg + ' kg';
            if (resCrushedBags) resCrushedBags.textContent = `(${computedCrushedBags} ${computedCrushedBags === 1 ? 'worek' : 'worki'})`;

            if (resBoxQty) resBoxQty.textContent = computedBoxQty;
            if (resTotalPrice) resTotalPrice.textContent = totalPrice + ' zł';
        }

        slider.addEventListener('input', recalculate);

        chipBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                chipBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentCubesRatio = parseFloat(this.getAttribute('data-cubes')) || 0.4;
                currentCrushedRatio = parseFloat(this.getAttribute('data-crushed')) || 0.15;
                recalculate();
            });
        });

        durBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                durBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentDurationMult = parseFloat(this.getAttribute('data-mult')) || 1.0;
                recalculate();
            });
        });

        addBundleBtn.addEventListener('click', function() {
            const cubesItemName = "Lód w kostkach — Worek 10 kg (30 zł)";
            const crushedItemName = "Lód kruszony — Worek 10 kg (35 zł)";
            const boxItemName = "Boxy Termiczne — 35 zł/doba (netto)";

            if (computedCubesBags > 0) {
                cart[cubesItemName] = (cart[cubesItemName] || 0) + computedCubesBags;
            }
            if (computedCrushedBags > 0) {
                cart[crushedItemName] = (cart[crushedItemName] || 0) + computedCrushedBags;
            }
            if (computedBoxQty > 0) {
                cart[boxItemName] = (cart[boxItemName] || 0) + computedBoxQty;
            }

            updateCartUI();
            showNotification('Dodano zestaw do koszyka!', `${computedCubesBags * 10}kg kostki + ${computedCrushedBags * 10}kg kruszonego + ${computedBoxQty} box`);

            const drawerBtn = document.getElementById('floating-cart-btn');
            if (drawerBtn) {
                drawerBtn.click();
            }
        });

        recalculate();
    }

    function initProductThumbnailsAndLightbox() {
        const productImages = document.querySelectorAll('.product-image');
        
        let lightboxModal = document.getElementById('product-lightbox-modal');
        if (!lightboxModal) {
            lightboxModal = document.createElement('div');
            lightboxModal.id = 'product-lightbox-modal';
            lightboxModal.className = 'product-lightbox-modal';
            lightboxModal.innerHTML = `
                <div class="lightbox-overlay"></div>
                <div class="lightbox-content">
                    <button class="lightbox-close" aria-label="Zamknij"><i class="fas fa-times"></i></button>
                    <div class="lightbox-img-wrapper">
                        <img src="" alt="" id="lightbox-img">
                    </div>
                    <div class="lightbox-caption" id="lightbox-caption"></div>
                </div>
            `;
            document.body.appendChild(lightboxModal);

            const closeBtn = lightboxModal.querySelector('.lightbox-close');
            const overlay = lightboxModal.querySelector('.lightbox-overlay');
            
            const closeLightbox = () => {
                lightboxModal.classList.remove('active');
                document.body.style.overflow = '';
            };

            closeBtn.addEventListener('click', closeLightbox);
            overlay.addEventListener('click', closeLightbox);
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && lightboxModal.classList.contains('active')) {
                    closeLightbox();
                }
            });
        }

        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCaption = document.getElementById('lightbox-caption');

        productImages.forEach(container => {
            const img = container.querySelector('img');
            if (img && img.src) {
                container.style.setProperty('--product-img-bg', `url("${img.src}")`);

                container.addEventListener('click', () => {
                    const card = container.closest('.product-card');
                    const title = card ? (card.querySelector('h3')?.textContent || img.alt) : img.alt;
                    const tagline = card ? (card.querySelector('.product-tagline')?.textContent || '') : '';

                    lightboxImg.src = img.src;
                    lightboxImg.alt = title;
                    lightboxCaption.innerHTML = `<h4>${title}</h4>${tagline ? `<p>${tagline}</p>` : ''}`;

                    lightboxModal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        loadCart();
        initUI();
        initCartForm();
        initFilters();
        initDatePicker();
        initCalculator();
        initProductThumbnailsAndLightbox();
        updateCartUI();
    });

})();