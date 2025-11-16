<?php
// Load configuration if available
$recaptcha_site_key = 'YOUR_SITE_KEY_HERE';
if (file_exists(__DIR__ . '/../config.php')) {
    require_once __DIR__ . '/../config.php';
    $recaptcha_site_key = defined('RECAPTCHA_SITE_KEY') ? RECAPTCHA_SITE_KEY : 'YOUR_SITE_KEY_HERE';
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Produkty z lodu: kostki, spiry, diamenty, japońskie kule. Certyfikowana woda, profesjonalna produkcja w Łodzi. Dostawa w Polsce.">
    <meta name="keywords"
        content="kostki lodu, lód kruszony, spiry lodowe, diamenty lodowe, japońskie kule, blok lodowy, suchy lód, produkty lodowe, Łódź">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://lodowe.com.pl/uslugi/produkty-z-lodu.php">

    <!-- Open Graph -->
    <meta property="og:title" content="Produkty z Lodu - Kostki, Spiry, Diamenty | Lodowe.com.pl">
    <meta property="og:description" content="Produkty z lodu: kostki, spiry, diamenty, japońskie kule. Certyfikowana woda, profesjonalna produkcja w Łodzi.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://lodowe.com.pl/uslugi/produkty-z-lodu.php">
    <meta property="og:site_name" content="Lodowe.com.pl">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Produkty z Lodu | Lodowe.com.pl">
    <meta name="twitter:description" content="Kostki, spiry, diamenty, japońskie kule. Certyfikowana woda, dostawa w Polsce.">

    <title>Produkty z Lodu - Kostki, Spiry, Diamenty | Lodowe.com.pl</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo htmlspecialchars($recaptcha_site_key); ?>" async defer></script>
    <script>
        // Make reCAPTCHA site key available to JavaScript
        window.recaptchaSiteKey = '<?php echo htmlspecialchars($recaptcha_site_key); ?>';
    </script>

    <link rel="stylesheet" href="../css/style-ice-blue.css">
    <link rel="stylesheet" href="../css/service-page.css">
    <link rel="stylesheet" href="../css/products-page.css">

    <!-- Structured Data - JSON-LD -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "serviceType": "Produkty z Lodu",
        "name": "Produkty Lodowe - Kostki, Spiry, Diamenty",
        "description": "Profesjonalne produkty z lodu: kostki, lód kruszony, spiry lodowe, diamenty, japońskie kule, bloki lodowe. Certyfikowana woda.",
        "provider": {
            "@type": "LocalBusiness",
            "name": "Lodowe.com.pl",
            "telephone": "+48511110265",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "Srebrzyńska 63",
                "addressLocality": "Łódź",
                "postalCode": "91-074",
                "addressCountry": "PL"
            }
        },
        "areaServed": "Polska",
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Katalog Produktów Lodowych",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Product",
                        "name": "Kostki Lodu",
                        "description": "Profesjonalne kostki lodu z certyfikowanej wody"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Product",
                        "name": "Spiry Lodowe",
                        "description": "Lód w kształcie kolumny do drinków premium"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Product",
                        "name": "Diamenty Lodowe",
                        "description": "Luksusowe diamenty z lodu do champagne i koktajli VIP"
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Product",
                        "name": "Japońskie Kule Lodowe",
                        "description": "Kule lodowe o średnicy 6cm do whisky"
                    }
                }
            ]
        }
    }
    </script>

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Strona główna",
                "item": "https://lodowe.com.pl/"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Produkty z Lodu",
                "item": "https://lodowe.com.pl/uslugi/produkty-z-lodu.php"
            }
        ]
    }
    </script>
</head>

<body>
    <!-- Navigation Placeholder -->
    <div id="nav-placeholder"></div>

    <!-- Hero Section -->
    <section class="service-hero products-hero">
        <div class="container">
            <div class="hero-content">
                <h1>Produkty z Lodu</h1>
                <p class="hero-subtitle">
                    Od klasycznych kostek po diamenty i japońskie kule – odkryj pełen asortyment
                    profesjonalnych produktów lodowych. Wszystkie wykonane z certyfikowanej,
                    wielokrotnie filtrowanej wody, badanej laboratoryjnie.
                </p>
                <div class="hero-stats-row">
                    <div class="stat-badge">
                        <strong>18</strong> produktów
                    </div>
                    <div class="stat-badge">
                        <strong>Certyfikowana</strong> woda
                    </div>
                    <div class="stat-badge">
                        <strong>Dostawa</strong> w Łodzi
                    </div>
                </div>
                <div class="hero-cta-row">
                    <a href="#products" class="btn btn-primary">
                        <i class="fas fa-snowflake"></i> Zobacz Produkty
                    </a>
                    <a href="#order" class="btn btn-secondary">
                        <i class="fas fa-shopping-cart"></i> Złóż Zamówienie
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section" id="products">
        <div class="container">
            <div class="section-header-center">
                <h2>Nasze Produkty</h2>
                <p>Wybierz idealny produkt lodowy dla swojej branży</p>
            </div>

            <div class="products-grid">
                <!-- Product 1: Kostki Lodu -->
                <div class="product-card">
                    <div class="product-badge">Najpopularniejsze</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/kostki-lodu.webp" alt="Profesjonalne kostki lodu z certyfikowanej wody - pakowanie 1kg, 2kg, 10kg" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Lód w Kostkach</h3>
                        <p class="product-tagline">Niezbędne w każdym barze...</p>
                        <p class="product-description">
                            Kostki lodu to niezastąpione rozwiązanie do szybkiego i skutecznego schładzania
                            napojów. Tworzone z certyfikowanej wody wielokrotnie filtrowanej, badanej laboratoryjnie.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Standardowy rozmiar</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Certyfikowana woda</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie 1kg, 2kg, 10kg</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Ceny brutto:</div>
                            <ul class="price-list">
                                <li><i class="fas fa-snowflake"></i> 5kg - 20zł</li>
                                <li><i class="fas fa-snowflake"></i> 6x2kg - 50zł</li>
                                <li><i class="fas fa-snowflake"></i> 12x1kg - 50zł</li>
                                <li><i class="fas fa-snowflake"></i> 10kg - 40zł</li>
                            </ul>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Lód w kostkach">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 2: Lód Kruszony -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/lod-kruszony-oferta.webp" alt="Lód kruszony do koktajli i smoothie - drobna frakcja, szybkie chłodzenie" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Lód Kruszony</h3>
                        <p class="product-tagline">Świetna alternatywa dla kostek...</p>
                        <p class="product-description">
                            Idealny do koktajli, smoothie i napojów mrożonych. Szybko schładza i nadaje
                            napojom profesjonalny wygląd. Stosowany w barach, kawiarniach i na eventach.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Drobna frakcja</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Szybkie chłodzenie</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie 10kg (worek)</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Ceny brutto:</div>
                            <ul class="price-list">
                                <li><i class="fas fa-snowflake"></i> 5kg - 20zł</li>
                                <li><i class="fas fa-snowflake"></i> 6x2kg - 50zł</li>
                                <li><i class="fas fa-snowflake"></i> 12x1kg - 50zł</li>
                                <li><i class="fas fa-snowflake"></i> 10kg - 40zł</li>
                            </ul>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Lód kruszony">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 3: Spiry Lodowe -->
                <div class="product-card featured">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/spiry-lodowe.webp" alt="Spiry lodowe z różnymi wzorami - lód w kształcie kolumny do drinków premium" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Spiry Lodowe</h3>
                        <p class="product-tagline">Idealne dla barmana...</p>
                        <p class="product-description">
                            Najnowsza innowacja wśród barmanów! Lód w kształcie kolumny idealny do serwowania
                            drinków premium. Utrzymuje niską temperaturę dłużej niż zwykłe kostki.
                            <strong>U nas zamówisz spiry z różnymi wzorami!</strong>
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-star"></i> Różne wzory</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Premium look</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Długie chłodzenie</span>
                            <span class="feature-tag"><i class="fas fa-plus"></i> Z zamrożonymi dodatkami: 100szt - 400zł</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 10 szt. - 35zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Spiry lodowe">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 3a: Spiry Lodowe z zamrożonym dodatkiem -->
                <div class="product-card featured">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/lodowe3_30.jpg" alt="Spiry lodowe z zamrożonymi owocami i ziołami wewnątrz - innowacyjne kostki premium" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Spiry Lodowe z Zamrożonym Dodatkiem</h3>
                        <p class="product-tagline">Spektakularne lody z dodatkami...</p>
                        <p class="product-description">
                            Innowacyjne spiry lodowe z zamrożonymi dodatkami wewnątrz! Idealne do drinków premium
                            i koktajli. Możliwość zamrożenia owoców, ziół, kwiatów lub innych dekoracji.
                            Każda spira to małe dzieło sztuki!
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-star"></i> Z dodatkami wewnątrz</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Premium look</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Długie chłodzenie</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie 50 szt.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena brutto:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 50 szt. - 200zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Spiry lodowe z zamrożonym dodatkiem">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 4: Kostki XXL -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/kostki-xxl.webp" alt="Duże kostki lodu XXL 5x5cm do whisky i alkoholi premium - wolne topnienie" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Kostki Lodu XXL</h3>
                        <p class="product-tagline">Nieco większy kaliber...</p>
                        <p class="product-description">
                            Duże kostki lodu idealne do whisky, rumu i innych alkoholi premium.
                            Topią się wolniej, nie rozwadniają napoju. Dostępne z różnymi wzorami.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Duży rozmiar (5x5cm)</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Wolne topnienie</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie 20 szt.</span>
                            <span class="feature-tag"><i class="fas fa-plus"></i> Z zamrożonymi dodatkami: 100szt - 400zł</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 20 szt. - 70zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Kostki XXL">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 4a: Kostki XXL z zamrożonym dodatkiem -->
                <div class="product-card featured">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/lodowe3_33.jpg" alt="Kostki XXL z zamrożonymi owocami i dekoracjami - luksusowy lód do drinków" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Kostki Lodu XXL z Zamrożonym Dodatkiem</h3>
                        <p class="product-tagline">Luksusowe kostki z niespodzianką...</p>
                        <p class="product-description">
                            Premium kostki XXL z zamrożonymi dodatkami wewnątrz. Idealne do ekskluzywnych drinków,
                            whisky i koktajli. Możliwość zamrożenia owoców, ziół, kwiatów lub innych dodatków.
                            Wolno się topią, nie rozwadniają napoju.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-star"></i> Z dodatkami wewnątrz</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Duży rozmiar (5x5cm)</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Wolne topnienie</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie 50 szt.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena brutto:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 50 szt. - 200zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Kostki XXL z zamrożonym dodatkiem">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 5: Naczynia Lodowe -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/szklanki.webp" alt="Szklanki i kieliszki z lodu - naczynia wykonane w 100% z lodu na eventy" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Naczynia Lodowe</h3>
                        <p class="product-tagline">Szklanka z lodu...</p>
                        <p class="product-description">
                            Spektakularne szklanki i kieliszki wykonane w całości z lodu! Idealne na eventy,
                            wesela i imprezy firmowe. Gwarantują efekt WOW wśród gości.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> 100% lód</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Różne kształty</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Kieliszki 20 szt. - 70zł</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Szklanki 10 szt. - 50zł</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Ceny:</div>
                            <ul class="price-list">
                                <li><i class="fas fa-snowflake"></i> Kieliszki 20szt - 70zł</li>
                                <li><i class="fas fa-snowflake"></i> Szklanki 10szt - 50zł</li>
                            </ul>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Naczynia lodowe">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 5a: Kubek i butelka lodowa -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/ice-breaker-10.jpg" alt="Kubki i butelki z lodu - praktyczne naczynia lodowe na imprezy i eventy" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Kubek i Butelka Lodowa</h3>
                        <p class="product-tagline">Praktyczne i efektowne...</p>
                        <p class="product-description">
                            Kubki i butelki wykonane w całości z lodu. Idealne do serwowania napojów na eventach
                            i imprezach. Zapewniają niepowtarzalny wygląd i utrzymują niską temperaturę.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> 100% lód</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Kubek lodowy</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Butelka lodowa</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena brutto:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 3,50zł / sztuka</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Kubek i butelka lodowa">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 6: Diamenty Lodowe -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/diamenty-lodowe-2-1.webp" alt="Luksusowe diamenty lodowe - kształt diamentu do champagne i koktajli VIP" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Diamenty Lodowe</h3>
                        <p class="product-tagline">Dla osób lubiących prestiż...</p>
                        <p class="product-description">
                            Luksusowe diamenty z lodu – symbol elegancji i prestiżu. Idealny dodatek
                            do drinków premium, champagne i koktajli VIP. Krystalicznie czyste i efektowne.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-star"></i> Premium product</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Kształt diamentu</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie 10 szt.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Minimum zamówienia:</div>
                            <div class="price-value">10 szt.</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Diamenty lodowe">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product: Rzeźba Lodowa -->
                <div class="product-card featured">
                    <div class="product-badge">Bestseller</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <i class="fas fa-gem"></i>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Rzeźba Lodowa</h3>
                        <p class="product-tagline">Dzieło sztuki z lodu...</p>
                        <p class="product-description">
                            Spektakularne rzeźby lodowe na zamówienie. Idealne na wesela, eventy firmowe,
                            gale i imprezy okolicznościowe. Każda rzeźba to unikatowe dzieło sztuki
                            wykonane przez doświadczonych artystów.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-star"></i> Projekt na zamówienie</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Logo firmy w lodzie</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Dowolna tematyka</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Podświetlenie LED</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena brutto:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> Od 800zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Rzeźba lodowa">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product: Misa Lodowa Łabędź -->
                <div class="product-card featured">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <i class="fas fa-dove"></i>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Misa Lodowa Łabędź</h3>
                        <p class="product-tagline">Elegancka dekoracja na stół...</p>
                        <p class="product-description">
                            Przepiękna misa lodowa w kształcie łabędzia. Idealna do serwowania owoców,
                            owoców morza, sushi lub deserów. Gwarantuje efekt WOW na każdym przyjęciu.
                            Symbol elegancji i wyrafinowania.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-star"></i> Elegancki design</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Do serwowania potraw</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Efekt WOW</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Wesela i eventy</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena brutto:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> Od 1200zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Misa lodowa łabędź">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 7: Japońskie Kule -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/kule-na-paletach.jpg" alt="Japońskie kule lodowe średnica 6cm - najwolniejsze topnienie do whisky" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Japońskie Kule Lodowe</h3>
                        <p class="product-tagline">Lód na okrągło...</p>
                        <p class="product-description">
                            Inspirowane japońską sztuką serwowania whisky. Idealne kule lodowe o średnicy 6cm,
                            które topią się bardzo wolno, zachowując pełny smak napoju.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Średnica 6cm</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Najwolniejsze topnienie</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie 10 szt.</span>
                            <span class="feature-tag"><i class="fas fa-plus"></i> Z zamrożonymi dodatkami: 100szt - 400zł</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 10 szt. - 35zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Japońskie kule">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 8: Suchy Lód -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/suchy-lod-1.webp" alt="Suchy lód CO2 do efektów specjalnych - spektakularna mgła na eventach" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Suchy Lód</h3>
                        <p class="product-tagline">Coś specjalnego...</p>
                        <p class="product-description">
                            Lód suchy (CO₂) do efektów specjalnych na eventach. Tworzy spektakularną mgłę,
                            idealna doshow barmanów, first dance na weselu czy prezentacji produktów.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Efekt mgły</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Bezpieczny w użyciu</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Pakowanie worki</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Ceny:</div>
                            <ul class="price-list">
                                <li><i class="fas fa-snowflake"></i> 5kg - 70zł</li>
                                <li><i class="fas fa-snowflake"></i> 5kg + box termiczny - 100zł</li>
                            </ul>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Suchy lód">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 9: Wielki Blok -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/blok-lodowy.webp" alt="Wielki blok lodowy do rzeźbienia - możliwość zatopienia przedmiotów wewnątrz" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Wielki Blok Lodowy</h3>
                        <p class="product-tagline">Ogromny kaliber...</p>
                        <p class="product-description">
                            Masywny blok lodu idealny do rzeźbienia lub jako baza pod konstrukcje lodowe.
                            <strong>Co więcej – w bloku możemy zatopić praktycznie dowolny przedmiot!</strong>
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Rozmiar custom</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Możliwość zatopienia
                                przedmiotów</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Do rzeźbienia</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Cena brutto:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> Od 1000-1500zł</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Blok lodowy">
                            <i class="fas fa-shopping-cart"></i> Zamów Teraz
                        </button>
                    </div>
                </div>

                <!-- Product 10: Zamrażarki -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/zamrazarki-na-lod.webp" alt="Profesjonalne zamrażarki na lód - wynajem i sprzedaż dla gastronomii" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Zamrażarki na Lód</h3>
                        <p class="product-tagline">Wyposażamy...</p>
                        <p class="product-description">
                            Profesjonalne zamrażarki do przechowywania lodu. Idealne dla barów, restauracji
                            i firm cateringowych. Zapewniamy sprzęt najwyższej jakości z gwarancją.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Różne pojemności</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Energooszczędne</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Wynajem lub sprzedaż</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Wynajem:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> Od 350zł za dobę (netto)</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Zamrażarki">
                            <i class="fas fa-phone"></i> Zapytaj o Ofertę
                        </button>
                    </div>
                </div>

                <!-- Product 11: Termoboxy -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/termobox.webp" alt="Boxy termiczne na lód gastronomiczny - wynajem termoboxów do transportu lodu" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Boxy terminczne</h3>
                        <p class="product-tagline">Wyposażamy...</p>
                        <p class="product-description">
                            Profesjonalne <strong>termoboxy na lód gastronomiczny</strong>.
                            Utrzymują niską temperaturę przez wiele godzin, chroniąc lód przed topnieniem. Idealne do
                            transportu i
                            przechowywania lodu w gastronomii, cateringu oraz podczas eventów.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i> Różne pojemności</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Długie utrzymanie temperatury</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Wynajem</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Wynajem:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 35zł za dobę (netto)</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Boxy termiczne">
                            <i class="fas fa-phone"></i> Zapytaj o Ofertę
                        </button>
                    </div>
                </div>
                <!-- Product 12: Warsztaty i pokazy -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/pokazy-lodowe.webp" alt="Pokazy rzeźbienia w lodzie i warsztaty ice carving - integracje firmowe" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Pokazy i warsztaty</h3>
                        <p class="product-tagline">Wyposażamy...</p>
                        <p class="product-description">
                            Od profesjonalnych szkoleń z pracy z lodem, przez kreatywne pomysły na integracje firmowe, aż po widowiskowe pokazy rzeźbienia w lodzie – oferujemy doświadczenia, które łączą sztukę, zabawę i współpracę.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i>Pokazy rzeźbienia</span>
                            <span class="feature-tag"><i class="fas fa-check"></i>Profesjonalne szkolenia</span>
                            <span class="feature-tag"><i class="fas fa-check"></i>Integracje firmowe</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Dostępność:</div>
                            <div class="price-value">Na zapytanie</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Zamrażarki">
                            <i class="fas fa-phone"></i> Zapytaj o Ofertę
                        </button>
                    </div>
                </div>

                <!-- Product 13: Przewóz i wynajem samochodu -->
                <div class="product-card">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Przewóz mroźniczo-chłodniczy</h3>
                        <p class="product-tagline">Transport w kontrolowanych warunkach...</p>
                        <p class="product-description">
                            Profesjonalny przewóz mroźniczo-chłodniczy oraz wynajem samochodu jako mobilna mroźnia.
                            Dysponujemy samochodami typu <strong>Fiat Ducato, Fiat Doblo i Fiat Scudo</strong>
                            zapewniającymi optymalne warunki przechowywania i transportu produktów lodowych.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-check"></i>Fiat Ducato</span>
                            <span class="feature-tag"><i class="fas fa-check"></i>Fiat Doblo</span>
                            <span class="feature-tag"><i class="fas fa-check"></i>Fiat Scudo</span>
                            <span class="feature-tag"><i class="fas fa-check"></i>Kontrolowana temperatura</span>
                        </div>
                        <div class="product-pricing">
                            <div class="price-label">Wynajem:</div>
                            <div class="price-value"><i class="fas fa-snowflake"></i> 350-500zł (netto)</div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Przewóz mroźniczo-chłodniczy">
                            <i class="fas fa-phone"></i> Zapytaj o Ofertę
                        </button>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <!-- Delivery Info -->
    <section class="logistics-section">
        <div class="container">
            <div class="section-header-center">
                <h2>Dostawa</h2>
                <p>Informacje o dostawie naszych produktów</p>
            </div>

            <div class="logistics-grid">
                <div class="logistics-card">
                    <div class="logistics-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h3>Warunki Dostawy</h3>
                    <ul class="logistics-list">
                        <li><i class="fas fa-check"></i> Łódź i okolice</li>
                        <li><i class="fas fa-check"></i> Transport chłodniczy</li>
                        <li><i class="fas fa-check"></i> Dostawa w 24h (Łódź)</li>
                        <li><i class="fas fa-check"></i> Bezpieczne pakowanie</li>
                        <li><i class="fas fa-check"></i> Gwarancja jakości</li>
                        <li><i class="fas fa-gift"></i> <strong>Darmowa dostawa przy zamówieniu za min. 250zł</strong></li>
                    </ul>
                    <p style="margin-top: 1rem; padding-top: 1rem; border-top: 2px solid #e0f2fe; font-size: 0.9rem; color: #0891B2;">
                        <strong>Uwaga:</strong> Wszystkie ceny są cenami brutto.<br>
                        <small>Wyjątek: boxy termiczne, zamrażarki na lód i przewóz mroźniczo-chłodniczy.</small>
                    </p>
                </div>

                <div class="logistics-card">
                    <div class="logistics-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>Pakowanie</h3>
                    <ul class="logistics-list">
                        <li><strong>Lód kruszony:</strong> 10 kg (worek)</li>
                        <li><strong>Lód w kostkach:</strong> 10 kg (worek)</li>
                        <li><strong>Lód w kostkach:</strong> 2 kg (worek)<br>
                            <small>Opak. zbiorcze: 6 x 2kg = 12 kg</small>
                        </li>
                        <li><strong>Lód w kostkach:</strong> 1 kg (worek)<br>
                            <small>Opak. zbiorcze: 12 x 1kg = 12 kg</small>
                        </li>
                        <li><strong>Kieliszki/szklanki:</strong> 20 szt.</li>
                        <li><strong>Japońskie kule:</strong> 10 szt.</li>
                        <li><strong>Kostka XXL:</strong> 20 szt.</li>
                        <li><strong>Diamenty:</strong> 10 szt.</li>
                        <li><strong>Spiry:</strong> 10 szt.</li>
                    </ul>
                </div>

                <div class="logistics-card">
                    <div class="logistics-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h3>Dodatkowe Informacje</h3>
                    <ul class="logistics-list">
                        <li><i class="fas fa-certificate"></i> Certyfikowana woda</li>
                        <li><i class="fas fa-filter"></i> Wielokrotna filtracja</li>
                        <li><i class="fas fa-shield-alt"></i> Standardy HACCP</li>
                        <li><i class="fas fa-snowflake"></i> Kontrolowana temperatura</li>
                        <li><i class="fas fa-handshake"></i> Obsługa B2B i B2C</li>
                        <li><i class="fas fa-phone"></i> Wsparcie telefoniczne</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Quality Section -->
    <section class="quality-section">
        <div class="container">
            <div class="quality-content">
                <div class="quality-text">
                    <h2>Gwarancja Jakości</h2>
                    <p class="lead">
                        Wszystkie nasze produkty wykonane są z <strong>certyfikowanej wody</strong>
                        wielokrotnie filtrowanej i badanej laboratoryjnie.
                    </p>
                    <div class="quality-features">
                        <div class="quality-feature">
                            <i class="fas fa-certificate"></i>
                            <div>
                                <h4>Certyfikowana Woda</h4>
                                <p>Regularne badania laboratoryjne</p>
                            </div>
                        </div>
                        <div class="quality-feature">
                            <i class="fas fa-filter"></i>
                            <div>
                                <h4>Wielokrotna Filtracja</h4>
                                <p>Krystalicznie czysty lód</p>
                            </div>
                        </div>
                        <div class="quality-feature">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <h4>Standardy HACCP</h4>
                                <p>Zgodność z normami spożywczymi</p>
                            </div>
                        </div>
                        <div class="quality-feature">
                            <i class="fas fa-snowflake"></i>
                            <div>
                                <h4>Optymalna Temperatura</h4>
                                <p>Transport w kontrolowanych warunkach</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Order Section -->
    <section class="order-section" id="order">
        <div class="container">
            <div class="section-header-center">
                <h2>Zamów Teraz</h2>
                <p>Zamówienie możesz złożyć za pomocą formularza lub telefonicznie</p>
            </div>

            <div class="order-grid">
                <div class="order-info">
                    <h3>Dział Zamówień</h3>
                    <div class="contact-methods">
                        <div class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="method-details">
                                <span class="method-label">Telefony</span>
                                <span class="method-value">
                                    <a href="tel:+48511110265">511 110 265</a><br>
                                    <a href="tel:+48501494787">501 494 787</a><br>
                                    <a href="tel:+48608401730">608 401 730</a>
                                </span>
                            </div>
                        </div>

                        <a href="mailto:office@long-table.com.pl" class="contact-method">
                            <div class="method-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="method-details">
                                <span class="method-label">Email</span>
                                <span class="method-value">office@long-table.com.pl</span>
                            </div>
                        </a>
                    </div>

                    <div class="order-benefits">
                        <h4>Korzyści:</h4>
                        <ul>
                            <li><i class="fas fa-check"></i> Szybka realizacja (24-48h)</li>
                            <li><i class="fas fa-check"></i> Transport chłodniczy</li>
                            <li><i class="fas fa-check"></i> Gwarancja jakości</li>
                            <li><i class="fas fa-check"></i> Konkurencyjne ceny</li>
                            <li><i class="fas fa-check"></i> Obsługa B2B i B2C</li>
                        </ul>
                    </div>

                    <div class="order-social">
                        <h4>Śledź Nas</h4>
                        <p style="margin-bottom: 10px; color: #64748B; font-size: 0.9rem;">Zobacz nasze realizacje i nowości</p>
                        <div class="contact-social">
                            <a href="https://www.facebook.com/lodowecompl" target="_blank" rel="noopener noreferrer" aria-label="Facebook" class="contact-social-link">
                                <i class="fab fa-facebook-f"></i> Facebook
                            </a>
                            <a href="https://www.instagram.com/lodowe.com.pl/" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="contact-social-link">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                        </div>
                    </div>
                </div>

                <div class="order-form-wrapper">
                    <form class="order-form" id="orderForm" action="../order-products.php" method="POST">
                        <h3>Formularz Zamówienia</h3>

                        <div class="form-group">
                            <label for="order-name">Imię i Nazwisko / Firma *</label>
                            <input type="text" id="order-name" name="name" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="order-email">Email *</label>
                                <input type="email" id="order-email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="order-phone">Telefon *</label>
                                <input type="tel" id="order-phone" name="phone" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Produkty *</label>
                            <div id="products-container">
                                <!-- Produkty będą dodawane dynamicznie przez JavaScript -->
                            </div>
                            <button type="button" class="btn btn-secondary" id="add-product-btn" style="margin-top: 10px; padding: 10px 16px; font-size: 14px;">
                                <i class="fas fa-plus"></i> Dodaj Produkt
                            </button>
                        </div>

                        <div class="form-group">
                            <label for="order-date">Data dostawy *</label>
                            <input type="date" id="order-date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="order-address">Adres dostawy *</label>
                            <textarea id="order-address" name="address" rows="2" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="order-notes">Dodatkowe uwagi</label>
                            <textarea id="order-notes" name="notes" rows="3"
                                placeholder="Opcjonalnie: szczególne wymagania, pytania..."></textarea>
                        </div>

                        <!-- reCAPTCHA v3 token (hidden) -->
                        <input type="hidden" id="recaptcha_token_order" name="recaptcha_token">

                        <button type="submit" class="btn btn-primary btn-full">
                            <i class="fas fa-paper-plane"></i> Wyślij Zamówienie
                        </button>

                        <p class="form-note">
                            * Pola wymagane. Skontaktujemy się z Tobą w ciągu 2 godzin roboczych.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="contact-cta">
        <div class="container">
            <div class="cta-content">
                <h2>Masz Pytania o Nasze Produkty?</h2>
                <p>Nasz zespół chętnie doradzi i pomoże wybrać odpowiedni produkt!</p>
                <div class="cta-buttons">
                    <a href="tel:+48511110265" class="btn btn-white">
                        <i class="fas fa-phone"></i> Zadzwoń: 511 110 265
                    </a>
                    <a href="../index.html#contact" class="btn btn-outline-white">
                        <i class="fas fa-envelope"></i> Formularz Kontaktowy
                    </a>
                </div>
                <div class="cta-info">
                    <div class="cta-info-item">
                        <i class="fas fa-truck"></i>
                        <span>Szybka dostawa (24-48h)</span>
                    </div>
                    <div class="cta-info-item">
                        <i class="fas fa-certificate"></i>
                        <span>Certyfikowana jakość</span>
                    </div>
                    <div class="cta-info-item">
                        <i class="fas fa-handshake"></i>
                        <span>18+ lat doświadczenia</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Placeholder -->
    <div id="footer-placeholder"></div>

    <!-- Scripts -->
    <script src="../js/components-loader.js"></script>
    <script src="../js/script-ice-blue.js"></script>
    <script src="../js/products-page.js"></script>

</body>

</html>