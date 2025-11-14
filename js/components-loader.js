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
        floatingBtn.classList = "btn btn-primary";
        floatingBtn.textContent = "Zwiń";
        document.body.appendChild(floatingBtn);
    }

    // Obsługa zdarzeń
    toggleBtn.addEventListener("click", () => {
        wrapper.classList.add("expanded");
        toggleBtn.style.display = "none";
        floatingBtn.classList.add("show");
    });

    floatingBtn.addEventListener("click", () => {
        wrapper.classList.remove("expanded");
        floatingBtn.classList.remove("show");
        toggleBtn.style.display = "block";
        wrapper.scrollIntoView({ behavior: "smooth" });
    });
}
function fixPortfolioPaths() {
    function getBasePath() {
        const path = window.location.pathname;
        return path.includes('/uslugi/') ? '../' : './';
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
        // If we're in a subdirectory (like /uslugi/), go up one level
        if (path.includes('/uslugi/')) {
            return '../';
        }
        return './';
    }

    // Load components when DOM is ready
    document.addEventListener('DOMContentLoaded', async function () {
        const basePath = getBasePath();

        // Load navigation and wait for it
        await loadComponent('nav-placeholder', basePath + 'components/nav.html');

        // Dispatch custom event to signal navigation is loaded
        window.dispatchEvent(new CustomEvent('navigationLoaded'));

        // Load portfolio (PHP for automatic image loading)
        const portfolioLoaded = await loadComponent('portfolio-placeholder', basePath + 'components/portfolio.php');

        if (portfolioLoaded) {
            initPortfolioControls();
            fixPortfolioPaths();
            initLazyLoading(); // Inicjalizuj lazy loading

            // Czekaj chwilę aż DOM się zaktualizuje, potem inicjalizuj filtry
            setTimeout(() => {
                if (typeof initPortfolioFilters === 'function') {
                    initPortfolioFilters();
                    console.log('✅ Portfolio filters initialized from components-loader');
                }
            }, 100);

            window.dispatchEvent(new CustomEvent('portfolioLoaded'));
        }

        // Load footer
        await loadComponent('footer-placeholder', basePath + 'components/footer.html');
    });
})();