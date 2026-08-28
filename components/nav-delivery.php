<header class="global-header">
    <!-- Gateway Split Top Bar -->
    <div class="top-gateway-bar" id="topGatewayBar">
        <div class="gateway-split-container">
            <a href="/dostawa-lodu/" class="gateway-side gateway-delivery <?php echo (strpos($_SERVER['REQUEST_URI'] ?? '', '/dostawa-lodu') !== false) ? 'active' : ''; ?>" id="gatewayDelivery">
                <div class="gateway-side-content">
                    <span class="gateway-icon"><i class="fas fa-truck-loading"></i></span>
                    <span class="gateway-title">Zaopatrzenie & Dostawa Lodu</span>
                    <span class="gateway-badge">B2B / Sklep</span>
                </div>
            </a>
            <a href="/eventy/" class="gateway-side gateway-events <?php echo (strpos($_SERVER['REQUEST_URI'] ?? '', '/dostawa-lodu') === false) ? 'active' : ''; ?>" id="gatewayEvents">
                <div class="gateway-side-content">
                    <span class="gateway-icon"><i class="fas fa-gem"></i></span>
                    <span class="gateway-title">Rzeźby, Bary & Pokazy</span>
                    <span class="gateway-badge">Eventy Premium</span>
                </div>
            </a>
        </div>
    </div>

    <!-- Main Delivery B2B Navigation Bar -->
    <nav class="navbar navbar-delivery" id="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="logo">
                    <div class="logo-icon">
                        <img src="/static/images/logo.webp" alt="Lodowe.com.pl logo"
                            style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="logo-text">
                        <span class="logo-brand">LODOWE</span>
                        <span class="logo-tag">DOSTAWA LODU B2B</span>
                    </div>
                </a>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="#products" class="nav-link">Asortyment</a></li>
                    <li><a href="#delivery-info" class="nav-link">Dostawa</a></li>
                    <li><a href="#seo-info" class="nav-link">O Nas</a></li>
                    <li><a href="#order" class="nav-link">Kontakt</a></li>
                    <li><a href="/wosp.php" class="nav-link nav-link-wosp"><i class="fas fa-heart"></i> WOŚP</a></li>
                </ul>

                <div class="nav-cta">
                    <a href="tel:+48511110265" class="btn-phone">
                        <i class="fas fa-phone"></i> 511 110 265
                    </a>
                    <button class="btn btn-outline-primary nav-cart-trigger" id="nav-cart-trigger-btn" type="button" style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 12px; border-radius: 20px; border: 2px solid #0284C7; color: #0284C7; font-weight: 700; background: transparent; cursor: pointer;">
                        <i class="fas fa-shopping-cart"></i> <span class="cart-text">Koszyk</span> <span class="badge-count" id="header-cart-badge" style="background: #0284C7; color: white; border-radius: 10px; padding: 2px 8px; font-size: 0.8rem;">0</span>
                    </button>
                    <button class="hamburger" id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>
