// ===================================
// INITIALIZATION
// ===================================

document.addEventListener('DOMContentLoaded', function () {
    initScrollEffects();
    initFAQ();
    initPortfolioFilters();
    initContactForm();
    initScrollToTop();
    initSmoothScroll();
    initLightbox();

    console.log('%c❄️ Lodowe.com.pl - Ice Blue Version loaded!',
        'font-size: 16px; color: #06B6D4; font-weight: bold;'
    );
});

// Listen for navigation loaded event from components-loader
window.addEventListener('navigationLoaded', function () {
    initNavigation();
    console.log('%c✓ Navigation initialized after component load',
        'font-size: 14px; color: #10B981; font-weight: bold;'
    );
});

// Listen for portfolio loaded event and re-scroll to hash if present
window.addEventListener('portfolioLoaded', function () {
    console.log('%c✓ Portfolio loaded, checking for hash',
        'font-size: 14px; color: #10B981; font-weight: bold;'
    );

    // If there's a hash in URL, scroll to it after portfolio loads
    if (window.location.hash) {
        const hash = window.location.hash;
        const target = document.querySelector(hash);

        if (target) {
            setTimeout(() => {
                const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
                console.log(`%c✓ Re-scrolled to ${hash} after portfolio load`,
                    'font-size: 14px; color: #10B981; font-weight: bold;'
                );
            }, 150); // Small delay to ensure DOM is fully updated
        }
    }
});

// ===================================
// NAVIGATION
// ===================================

function initNavigation() {
    const navbar = document.getElementById('navbar');
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('navMenu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Sticky navbar on scroll
    window.addEventListener('scroll', function () {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function () {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
        });
    }

    // Handle dropdown mobile button click
    const dropdownMobileButton = document.querySelector('.dropdown-mobile-button');
    if (dropdownMobileButton) {
        dropdownMobileButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const parent = this.parentElement;

            // Close other dropdowns
            document.querySelectorAll('.nav-dropdown').forEach(dropdown => {
                if (dropdown !== parent) {
                    dropdown.classList.remove('active');
                }
            });

            // Toggle current dropdown
            parent.classList.toggle('active');
        });
    }

    // Close mobile menu when clicking on a link (but not dropdown parent)
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Skip if this is the desktop dropdown link or mobile dropdown button
            if (this.classList.contains('dropdown-desktop-link') ||
                this.classList.contains('dropdown-mobile-button')) {
                return;
            }

            if (hamburger && navMenu) {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // Handle dropdown menu clicks on mobile
    const dropdownItems = document.querySelectorAll('.dropdown-menu a');
    dropdownItems.forEach(link => {
        link.addEventListener('click', function () {
            if (hamburger && navMenu && window.innerWidth <= 768) {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    });

    // Active nav link on scroll - tylko na stronie głównej
    // Check if we're on the homepage by looking for sections with relevant IDs
    const isHomepage = document.querySelector('#home, #about, #services, #portfolio');

    if (isHomepage) {
        window.addEventListener('scroll', throttle(function () {
            let current = '';
            const sections = document.querySelectorAll('section[id]');

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (scrollY >= (sectionTop - 200)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').includes(current)) {
                    link.classList.add('active');
                }
            });
        }, 100));
    }
}

// ===================================
// SCROLL EFFECTS
// ===================================

function initScrollEffects() {
    // Parallax effect for hero (subtle)
    const hero = document.querySelector('.hero');

    if (hero) {
        window.addEventListener('scroll', throttle(function () {
            const scrolled = window.pageYOffset;
            const parallax = scrolled * 0.3;
            if (scrolled < window.innerHeight) {
                hero.style.transform = `translateY(${parallax}px)`;
            }
        }, 16));
    }

    // Fade in elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe service cards, portfolio items, etc.
    const fadeElements = document.querySelectorAll('.service-card, .portfolio-item, .testimonial-card');
    fadeElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

// ===================================
// FAQ ACCORDION
// ===================================

function initFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        if (question) {
            question.addEventListener('click', function () {
                // Close other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });

                // Toggle current item
                item.classList.toggle('active');
            });
        }
    });
}

// ===================================
// PORTFOLIO FILTERS
// ===================================

function initPortfolioFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');

            // Get filter value
            const filterValue = this.getAttribute('data-filter');

            // Filter portfolio items with animation
            portfolioItems.forEach((item, index) => {
                const category = item.getAttribute('data-category');

                // Hide all first
                item.style.opacity = '0';
                item.style.transform = 'scale(0.8)';

                setTimeout(() => {
                    if (filterValue === 'all' || category === filterValue) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 50);

                        // Natychmiast załaduj obrazy z lazy loadingu dla widocznych elementów
                        const lazyImg = item.querySelector('img.lazy-load');
                        if (lazyImg) {
                            const src = lazyImg.getAttribute('data-src');
                            if (src) {
                                lazyImg.src = src;
                                lazyImg.classList.remove('lazy-load');
                                lazyImg.classList.add('lazy-loaded');
                            }
                        }
                    } else {
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                }, index * 50);
            });
        });
    });
}

// ===================================
// CONTACT FORM VALIDATION
// ===================================

function initContactForm() {
    const form = document.getElementById('contactForm');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // blokujemy klasyczne wysyłanie

            // Pobierz wartości z pól
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const service = document.getElementById('service').value;
            const message = document.getElementById('message').value.trim();
            
            // Walidacja
            let isValid = true;
            let errors = [];
            
            if (name === '') {
                errors.push('Proszę podać imię i nazwisko');
                isValid = false;
            }
            
            if (email === '' || !isValidEmail(email)) {
                errors.push('Proszę podać poprawny adres email');
                isValid = false;
            }
            
            if (phone === '' || !isValidPhone(phone)) {
                errors.push('Proszę podać poprawny numer telefonu');
                isValid = false;
            }
            
            if (service === '') {
                errors.push('Proszę wybrać rodzaj usługi');
                isValid = false;
            }
            
            if (message === '') {
                errors.push('Proszę wpisać wiadomość');
                isValid = false;
            }
            
            // Jeśli walidacja nie przeszła
            if (!isValid) {
                showNotification('Błąd walidacji', errors.join('<br>'), 'error');
                return;
            }

            // Wysyłka danych AJAX-em do PHP
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) throw new Error('Błąd serwera');
                return response.text();
            })
            .then(data => {
                console.log('Odpowiedź z PHP:', data);
                showNotification(
                    'Dziękujemy!',
                    'Twoja wiadomość została wysłana. Skontaktujemy się wkrótce!',
                    'success'
                );
                form.reset();
            })
            .catch(error => {
                console.error('Błąd wysyłki:', error);
                showNotification('Błąd!', 'Nie udało się wysłać wiadomości.', 'error');
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

// Show notification
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

    closeBtn.addEventListener('click', function () {
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

// ===================================
// SCROLL TO TOP BUTTON
// ===================================

function initScrollToTop() {
    const scrollTopBtn = document.getElementById('scrollTop');

    if (scrollTopBtn) {
        // Show/hide button on scroll
        window.addEventListener('scroll', throttle(function () {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('visible');
            } else {
                scrollTopBtn.classList.remove('visible');
            }
        }, 100));

        // Scroll to top on click
        scrollTopBtn.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
}

// ===================================
// SMOOTH SCROLL
// ===================================

function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            // Skip if it's just '#'
            if (href === '#') return;

            e.preventDefault();
            const target = document.querySelector(href);

            if (target) {
                const offsetTop = target.offsetTop - 80; // Account for fixed navbar

                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ===================================
// LIGHTBOX GALLERY
// ===================================

function initLightbox() {
    if (typeof GLightbox !== 'undefined') {
        const lightbox = GLightbox({
            touchNavigation: true,
            loop: true,
            autoplayVideos: true,
            closeButton: true,
            zoomable: true,
            draggable: true,
            skin: 'modern',
            moreLength: 0
        });

        // Usuń pasek GLightbox JS po otwarciu
        lightbox.on('open', () => {
            setTimeout(() => {
                const poweredElements = document.querySelectorAll('.gpowered, .gpowered-by, [class*="gpowered"]');
                poweredElements.forEach(el => el.remove());
            }, 100);
        });

        console.log('%c✓ Lightbox initialized',
            'font-size: 14px; color: #10B981; font-weight: bold;'
        );
    }
}

// ===================================
// UTILITY FUNCTIONS
// ===================================

// Throttle function for performance
function throttle(func, limit) {
    let inThrottle;
    return function () {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// ===================================
// ANIMATIONS
// ===================================

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .notification-content h4 {
        margin: 0 0 8px 0;
        font-size: 1.1rem;
        font-weight: 700;
    }
    
    .notification-content p {
        margin: 0;
        font-size: 0.95rem;
        line-height: 1.5;
    }
`;
document.head.appendChild(style);

// ===================================
// EASTER EGG
// ===================================

// Konami code easter egg
let konamiCode = [];
const konamiSequence = [
    'ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown',
    'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight',
    'b', 'a'
];

document.addEventListener('keydown', function (e) {
    konamiCode.push(e.key);
    konamiCode = konamiCode.slice(-10);

    if (konamiCode.join(',') === konamiSequence.join(',')) {
        activateSnowEffect();
        showNotification(
            '❄️ Śnieżny Easter Egg!',
            'Gratulacje! Odkryłeś sekretny kod!',
            'info'
        );
        konamiCode = [];
    }
});

function activateSnowEffect() {
    // Add falling snowflakes
    for (let i = 0; i < 50; i++) {
        createSnowflake();
    }
}

function createSnowflake() {
    const snowflake = document.createElement('div');
    snowflake.innerHTML = '❄';
    snowflake.style.cssText = `
        position: fixed;
        top: -20px;
        left: ${Math.random() * 100}vw;
        font-size: ${Math.random() * 20 + 10}px;
        color: #06B6D4;
        opacity: ${Math.random() * 0.7 + 0.3};
        pointer-events: none;
        z-index: 9999;
        animation: fall ${Math.random() * 3 + 2}s linear forwards;
    `;

    document.body.appendChild(snowflake);

    setTimeout(() => snowflake.remove(), 5000);
}

// Add fall animation
const fallAnimation = document.createElement('style');
fallAnimation.textContent = `
    @keyframes fall {
        to {
            transform: translateY(100vh) rotate(360deg);
        }
    }
`;
document.head.appendChild(fallAnimation);