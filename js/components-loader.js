// Component Loader - Load shared nav and footer

// Lazy loading obrazów portfolio z Intersection Observer
function initLazyLoading() {
    const lazyImages = document.querySelectorAll('img.lazy-load');

    if (!lazyImages.length) return;

    // Sprawdź czy przeglądarka wspiera Intersection Observer
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.getAttribute('data-src');

                    if (src) {
                        img.src = src;
                        img.classList.remove('lazy-load');
                        img.classList.add('lazy-loaded');
                        observer.unobserve(img);

                        // Załaduj również rozmyte tło dla tego elementu
                        const portfolioItem = img.closest('.portfolio-item');
                        if (portfolioItem) {
                            const placeholderBg = portfolioItem.querySelector('.placeholder-bg');
                            if (placeholderBg) {
                                const bgSrc = placeholderBg.getAttribute('data-bg-src');
                                if (bgSrc) {
                                    placeholderBg.style.backgroundImage = `url('${bgSrc}')`;
                                }
                            }
                        }
                    }
                }
            });
        }, {
            // Ładuj obrazy 200px przed wejściem do viewportu
            rootMargin: '200px 0px',
            threshold: 0.01
        });

        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback dla starszych przeglądarek - ładuj wszystko od razu
        lazyImages.forEach(img => {
            const src = img.getAttribute('data-src');
            if (src) {
                img.src = src;
                img.classList.remove('lazy-load');

                // Załaduj również tła
                const portfolioItem = img.closest('.portfolio-item');
                if (portfolioItem) {
                    const placeholderBg = portfolioItem.querySelector('.placeholder-bg');
                    if (placeholderBg) {
                        const bgSrc = placeholderBg.getAttribute('data-bg-src');
                        if (bgSrc) {
                            placeholderBg.style.backgroundImage = `url('${bgSrc}')`;
                        }
                    }
                }
            }
        });
    }
}

function initPortfolioControls() {
    const wrapper = document.getElementById("portfolioWrapper");
    const toggleBtn = document.getElementById("portfolioToggleBtn");

    if (!wrapper || !toggleBtn) return;

    // Tworzymy pływający przycisk (jeśli jeszcze nie istnieje)
    let floatingBtn = document.getElementById("floatingCollapseBtn");
    if (!floatingBtn) {
        floatingBtn = document.createElement("button");
        floatingBtn.id = "floatingCollapseBtn";
        floatingBtn.className = "btn btn-primary";
        floatingBtn.textContent = "Zwiń portfolio";
        document.body.appendChild(floatingBtn);
    }

    // Obsługa kliknięcia "Zobacz więcej"
    toggleBtn.addEventListener("click", (e) => {
        e.preventDefault();

        // KROK 1: Usuń tymczasowo ograniczenie, aby zmierzyć rzeczywistą wysokość zawartości
        wrapper.style.maxHeight = 'none';
        const fullHeight = wrapper.scrollHeight;

        // KROK 2: Przywróć 600px jako punkt startowy animacji CSS
        wrapper.style.maxHeight = '600px';

        // KROK 3: Animuj płynnie do pełnej wysokości
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                wrapper.style.maxHeight = fullHeight + 'px';
                wrapper.classList.add("expanded");

                setTimeout(() => {
                    wrapper.style.maxHeight = 'none';
                    toggleBtn.style.display = "none";
                    if (floatingBtn) floatingBtn.classList.add("show");
                }, 800);
            });
        });
    });

    // Obsługa kliknięcia "Zwiń portfolio"
    floatingBtn.addEventListener("click", (e) => {
        e.preventDefault();

        // KROK 1: Ustaw aktualną wysokość jako punkt wyjścia dla zwijania
        wrapper.style.maxHeight = wrapper.scrollHeight + 'px';

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                // KROK 2: Zwiń z powrotem do 600px
                wrapper.style.maxHeight = '600px';
                wrapper.classList.remove("expanded");

                setTimeout(() => {
                    if (floatingBtn) floatingBtn.classList.remove("show");
                    toggleBtn.style.display = "block";
                }, 800);
            });
        });

        // KROK 3: Smooth scroll do sekcji portfolio
        setTimeout(() => {
            const portfolioSection = document.getElementById("portfolio");
            if (portfolioSection) {
                portfolioSection.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        }, 100);
    });
}
function fixPortfolioPaths() {
    function getBasePath() {
        const path = window.location.pathname;
        return (path.includes('/uslugi/') || path.includes('/dostawa-lodu/') || path.includes('/eventy/')) ? '../' : './';
    }

    const basePath = getBasePath();
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    portfolioItems.forEach(item => {
        // Fix href for lightbox links
        const link = item.getAttribute('href');
        if (link && !link.startsWith('http') && !link.startsWith(basePath) && !link.startsWith('/')) {
            item.setAttribute('href', basePath + link);
        }

        // Fix img src
        const img = item.querySelector('img');
        if (img) {
            const src = img.getAttribute('src');
            if (src && !src.startsWith('http') && !src.startsWith('data:') && !src.startsWith(basePath) && !src.startsWith('/')) {
                img.setAttribute('src', basePath + src);
            }

            // Fix data-src for lazy loading
            const dataSrc = img.getAttribute('data-src');
            if (dataSrc && !dataSrc.startsWith('http') && !dataSrc.startsWith('data:') && !dataSrc.startsWith(basePath) && !dataSrc.startsWith('/')) {
                img.setAttribute('data-src', basePath + dataSrc);
            }
        }

        // Fix placeholder background
        const placeholderBg = item.querySelector('.placeholder-bg');
        if (placeholderBg) {
            const bgSrc = placeholderBg.getAttribute('data-bg-src');
            if (bgSrc && !bgSrc.startsWith('http') && !bgSrc.startsWith('data:') && !bgSrc.startsWith(basePath) && !bgSrc.startsWith('/')) {
                placeholderBg.setAttribute('data-bg-src', basePath + bgSrc);
            }
        }
    });
}
(function () {
    // Function to load HTML component
    async function loadComponent(elementId, componentPath) {
        try {
            const response = await fetch(componentPath);
            if (!response.ok) {
                throw new Error(`Failed to load ${componentPath}`);
            }
            const html = await response.text();
            const element = document.getElementById(elementId);
            if (element) {
                element.innerHTML = html;
            }
            return true; // Return success
        } catch (error) {
            console.error('Error loading component:', error);
            return false;
        }
    }

    // Determine the base path based on current location
    function getBasePath() {
        const path = window.location.pathname;
        // If we're in a subdirectory, go up one level
        if (path.includes('/uslugi/') || path.includes('/dostawa-lodu/') || path.includes('/eventy/')) {
            return '../';
        }
        return './';
    }

    // Load components when DOM is ready
    document.addEventListener('DOMContentLoaded', async function () {
        const basePath = getBasePath();

        // Navigation is loaded server-side via PHP now
        // Dispatch custom event to signal navigation is loaded for other scripts
        window.dispatchEvent(new CustomEvent('navigationLoaded'));

        // Portfolio is loaded server-side via PHP now
        initPortfolioControls();
        fixPortfolioPaths();
        initLazyLoading();

        if (typeof initPortfolioFilters === 'function') {
            initPortfolioFilters();
            console.log('✅ Portfolio filters initialized from components-loader');
        }

        window.dispatchEvent(new CustomEvent('portfolioLoaded'));

        // Footer is loaded server-side via PHP now
    });
})();