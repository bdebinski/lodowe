// Component Loader - Load shared nav and footer
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
        const link = item.getAttribute('href');
        if (link && !link.startsWith('http') && !link.startsWith(basePath)) {
            item.setAttribute('href', basePath + link);
        }

        const img = item.querySelector('img');
        if (img) {
            const src = img.getAttribute('src');
            if (src && !src.startsWith('http') && !src.startsWith(basePath)) {
                img.setAttribute('src', basePath + src);
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