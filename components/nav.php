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

    <!-- Main Navigation Bar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <a href="/" class="logo">
                    <div class="logo-icon">
                        <img src="/static/images/logo.webp" alt="Lodowe.com.pl logo"
                            style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <span>LODOWE</span>
                </a>

                <ul class="nav-menu" id="navMenu">
                    <li><a href="/eventy/#home" class="nav-link">Start</a></li>
                    <li><a href="/eventy/#about" class="nav-link">O nas</a></li>
                    <li class="nav-dropdown">
                        <a href="/eventy/#services" class="nav-link dropdown-desktop-link">
                            Usługi <i class="fas fa-chevron-down"></i>
                        </a>
                        <button class="nav-link dropdown-mobile-button" type="button">
                            Usługi <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="/eventy/rzezby-lodowe.php"><i class="fas fa-gem"></i> Rzeźby lodowe</a></li>
                            <li><a href="/eventy/bary-lodowe.php"><i class="fas fa-glass-cheers"></i> Bary lodowe</a></li>
                            <li><a href="/dostawa-lodu/"><i class="fas fa-truck-loading"></i> Dostawa Lodu B2B</a></li>
                            <li><a href="/eventy/pokazy-warsztaty.php"><i class="fas fa-users"></i> Pokazy i warsztaty</a></li>
                        </ul>
                    </li>
                    <li><a href="/eventy/#portfolio" class="nav-link">Portfolio</a></li>
                    <li><a href="/wosp.php" class="nav-link nav-link-wosp"><i class="fas fa-heart"></i> WOŚP</a></li>
                    <li><a href="/eventy/#testimonials" class="nav-link">Opinie</a></li>
                    <li><a href="/eventy/#contact" class="nav-link">Kontakt</a></li>
                    <li><a href="/eventy/#faq" class="nav-link">FAQ</a></li>
                    <li class="nav-menu-social">
                        <a href="https://www.facebook.com/lodowecompl" target="_blank" rel="noopener noreferrer"
                            aria-label="Facebook" class="nav-social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/lodowe.com.pl/" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram" class="nav-social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>

                <div class="nav-cta">
                    <div class="nav-social">
                        <a href="https://www.facebook.com/lodowecompl" target="_blank" rel="noopener noreferrer"
                            aria-label="Facebook" class="nav-social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/lodowe.com.pl/" target="_blank" rel="noopener noreferrer"
                            aria-label="Instagram" class="nav-social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <a href="tel:+48511110265" class="btn-phone">
                        <i class="fas fa-phone"></i> 511 110 265
                    </a>
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