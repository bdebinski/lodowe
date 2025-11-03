// Component Loader - Load shared nav and footer
(function() {
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
    document.addEventListener('DOMContentLoaded', async function() {
        const basePath = getBasePath();

        // Load navigation and wait for it
        await loadComponent('nav-placeholder', basePath + 'components/nav.html');

        // Dispatch custom event to signal navigation is loaded
        window.dispatchEvent(new CustomEvent('navigationLoaded'));

        // Load footer
        await loadComponent('footer-placeholder', basePath + 'components/footer.html');
    });
})();