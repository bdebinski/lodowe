window.addEventListener("portfolioLoaded", function () {
    function getBasePath() {
        const path = window.location.pathname;
        if (path.includes('/uslugi/')) {
            return '../';
        }
        return './';
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
});