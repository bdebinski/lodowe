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
        content="Ekspresowa dostawa lodu w kostkach, lodu kruszonego i suchego lodu na terenie Łodzi i okolic. Pogotowie lodowe B2B dla restauracji, barów i na imprezy. Tel: 511 110 265.">
    <meta name="keywords"
        content="dostawa lodu łódź, lód w kostkach łódź, lód kruszony łódź, suchy lód łódź, pogotowie lodowe łódź, producent lodu łódź, lód do drinków łódź">

    <!-- Canonical URL -->
    <link rel="canonical" href="https://lodowe.com.pl/dostawa-lodu/">

    <!-- Open Graph -->
    <meta property="og:title" content="Dostawa Lodu Łódź — Kostki Lodu, Lód Kruszony & Suchy Lód | Lodowe.com.pl">
    <meta property="og:description"
        content="Ekspresowa dostawa lodu w Łodzi: lód w kostkach, lód kruszony i suchy lód dla gastronomii oraz na imprezy. Zadzwoń i zamów z dowozem!">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://lodowe.com.pl/dostawa-lodu/">
    <meta property="og:site_name" content="Lodowe.com.pl">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Dostawa Lodu Łódź — Kostki Lodu, Lód Kruszony & Suchy Lód | Lodowe.com.pl">
    <meta name="twitter:description"
        content="Lód w kostkach, lód kruszony do drinków, suchy lód z dostawą w Łodzi. Zadzwoń: 511 110 265.">

    <title>Dostawa Lodu Łódź — Kostki Lodu, Lód Kruszony & Suchy Lód | Lodowe.com.pl</title>

    <!-- Schema.org JSON-LD for LocalBusiness & Product -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Lodowe.com.pl - Dostawa Lodu Łódź",
      "image": "https://lodowe.com.pl/static/images/products/kostki-lodu.webp",
      "description": "Ekspresowa dostawa lodu w kostkach, lodu kruszonego i suchego lodu dla gastronomii oraz na imprezy w Łodzi i okolicach.",
      "url": "https://lodowe.com.pl/dostawa-lodu/",
      "telephone": "+48511110265",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "ul. Żeromskiego 49 lok 1 u",
        "addressLocality": "Łódź",
        "postalCode": "90-624",
        "addressCountry": "PL"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 51.7618,
        "longitude": 19.4502
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday"
        ],
        "opens": "08:00",
        "closes": "22:00"
      },
      "areaServed": "Łódź",
      "priceRange": "$$"
    }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google reCAPTCHA v3 -->
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo htmlspecialchars($recaptcha_site_key); ?>"
        async defer></script>
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
    <!-- Global Navigation Placeholder -->
    <?php include __DIR__ . '/../components/nav-delivery.php'; ?>

    <!-- Compact SEO Hero Section -->
    <section class="products-hero-compact">
        <div class="container hero-badge-wrapper">
            <img src="/static/images/logo.png" alt="Poznaj Inny Wymiar Lodu - Lodowe.com.pl" class="hero-brand-badge">
            <div class="hero-text-content">
                <h1>Lód w Kostkach i Lód do Drinków z Dostawą w Łodzi</h1>
                <p class="hero-seo-lead">
                    Zamów <strong>lód w kostkach</strong>, <strong>lód kruszony do drinków</strong> oraz suchy lód z szybką dostawą w Łodzi. Certyfikowana, wielokrotnie filtrowana woda pod stałą kontrolą laboratoryjną.
                </p>
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

                        <div class="product-filters">
                <button class="filter-btn active" data-filter="all">Wszystkie</button>
                <button class="filter-btn" data-filter="drink">Lód do Drinków</button>
                <button class="filter-btn" data-filter="premium">Lód Premium</button>
                <button class="filter-btn" data-filter="art">Naczynia & Rzeźby</button>
                <button class="filter-btn" data-filter="equipment">Sprzęt & Logistyka</button>
            </div>
            
            <div class="products-grid">
                <!-- Product 1: Kostki Lodu -->
                <div class="product-card" data-category="drink">
                    <div class="product-badge">Najpopularniejsze</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/kostki-lodu.webp"
                                alt="Profesjonalne kostki lodu z certyfikowanej wody - pakowanie 1kg, 2kg, 10kg"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Lód w Kostkach</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Krystaliczne kostki (woda filtrowana)</p>
                        <p class="product-description">
                            Standardowe kostki lodu do szybkiego schładzania drinków i napojów. Produkcja z czystej, wielokrotnie filtrowanej wody badanej laboratoryjnie.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-snowflake"></i> Temp. -18°C</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Standardowy rozmiar</span>
                            <span class="feature-tag"><i class="fas fa-shield-alt"></i> HACCP</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant opakowania">
                                <button type="button" class="variant-pill active" data-value="Worek 10kg (40zł)">10kg — 40zł</button>
                                <button type="button" class="variant-pill" data-value="Worek 5kg (20zł)">5kg — 20zł</button>
                                <button type="button" class="variant-pill" data-value="Karton 6x2kg (50zł)">6x2kg — 50zł</button>
                                <button type="button" class="variant-pill" data-value="Karton 12x1kg (50zł)">12x1kg — 50zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Lód w kostkach">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 2: Lód Kruszony -->
                <div class="product-card" data-category="drink">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/lod-kruszony-oferta.webp"
                                alt="Lód kruszony do koktajli i smoothie - drobna frakcja, szybkie chłodzenie"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Lód Kruszony</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Drobna frakcja do Mojito & Smoothie</p>
                        <p class="product-description">
                            Drobno kruszony lód idealny do drinków (Mojito, Caipirinha), koktajli i smoothie. Szybko obniża temperaturę napoju i tworzy aksamitny wygląd.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-bolt"></i> Szybkie chłodzenie</span>
                            <span class="feature-tag"><i class="fas fa-glass-martini-alt"></i> Do barów & kawiarni</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Drobny grys</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant opakowania">
                                <button type="button" class="variant-pill active" data-value="Worek 10kg (40zł)">10kg — 40zł</button>
                                <button type="button" class="variant-pill" data-value="Worek 5kg (20zł)">5kg — 20zł</button>
                                <button type="button" class="variant-pill" data-value="Karton 6x2kg (50zł)">6x2kg — 50zł</button>
                                <button type="button" class="variant-pill" data-value="Karton 12x1kg (50zł)">12x1kg — 50zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Lód kruszony">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 3: Spiry Lodowe -->
                <div class="product-card featured" data-category="premium">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/spiry-lodowe.webp"
                                alt="Spiry lodowe z różnymi wzorami - lód w kształcie kolumny do drinków premium"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Spiry Lodowe</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Kolumny lodowe do szklanek Highball</p>
                        <p class="product-description">
                            Lód w kształcie przezroczystych kolumn (spir). Dopasowany wymiarowo do wysokich szklanek barmańskich. Topi się wolno, dając unikalny szlif.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-gem"></i> Szlif barmański</span>
                            <span class="feature-tag"><i class="fas fa-clock"></i> Wolne topnienie</span>
                            <span class="feature-tag"><i class="fas fa-box"></i> 10 szt. w op.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant">
                                <button type="button" class="variant-pill active" data-value="10 sztuk (35zł)">10 sztuk — 35zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Spiry lodowe">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 3a: Spiry Lodowe z zamrożonym dodatkiem -->
                <div class="product-card featured" data-category="premium">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/lodowe3_30.jpg"
                                alt="Spiry lodowe z zamrożonymi owocami i ziołami wewnątrz - innowacyjne kostki premium"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Spiry Lodowe z Zamrożonym Dodatkiem</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Zatopione owoce, zioła lub kwiaty w kolumnie</p>
                        <p class="product-description">
                            Spiry lodowe z zatopioną wewnątrz świeżą miętą, cytrusami lub kwiatami jadalnymi. Spektakularna dekoracja drinków na przyjęcia i gale.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-leaf"></i> 100% naturalne dodatki</span>
                            <span class="feature-tag"><i class="fas fa-star"></i> Efekt WOW</span>
                            <span class="feature-tag"><i class="fas fa-box"></i> 50 szt. w op.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant">
                                <button type="button" class="variant-pill active" data-value="50 sztuk (200zł)">50 sztuk — 200zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Spiry lodowe z zamrożonym dodatkiem">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 4: Kostki XXL -->
                <div class="product-card" data-category="premium">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/kostki-xxl.webp"
                                alt="Duże kostki lodu XXL 5x5cm do whisky i alkoholi premium - wolne topnienie"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Kostki Lodu XXL</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Masywny blok 5x5cm do Whisky & Rum</p>
                        <p class="product-description">
                            Masywne, wycinane kostki o boku 5x5 cm. Dzięki dużej masie topią się wolno i nie rozwadniają szlachetnych alkoholi w szklance.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-ruler-combined"></i> Wymiar 5x5cm</span>
                            <span class="feature-tag"><i class="fas fa-tint-slash"></i> Zero rozcieńczania</span>
                            <span class="feature-tag"><i class="fas fa-box"></i> 20 szt. w op.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant">
                                <button type="button" class="variant-pill active" data-value="20 sztuk (70zł)">20 sztuk — 70zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Kostki XXL">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 4a: Kostki XXL z zamrożonym dodatkiem -->
                <div class="product-card featured" data-category="premium">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/lodowe3_33.jpg"
                                alt="Kostki XXL z zamrożonymi owocami i dekoracjami - luksusowy lód do drinków"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Kostki Lodu XXL z Zamrożonym Dodatkiem</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Kostki 5x5cm z owocami w środku</p>
                        <p class="product-description">
                            Luksusowa wersja kostek XXL z zatopionymi dekoracjami roślinnymi lub owocowymi. Stopniowo uwalniają aromat podczas serwowania.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-ruler-combined"></i> Wymiar 5x5cm</span>
                            <span class="feature-tag"><i class="fas fa-apple-alt"></i> Owoce wewnątrz</span>
                            <span class="feature-tag"><i class="fas fa-box"></i> 60 szt. w op.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant">
                                <button type="button" class="variant-pill active" data-value="60 sztuk (240zł)">60 sztuk — 240zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Kostki XXL z zamrożonym dodatkiem">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 5: Naczynia Lodowe -->
                <div class="product-card" data-category="art">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/szklanki.webp"
                                alt="Szklanki i kieliszki z lodu - naczynia wykonane w 100% z lodu na eventy"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Naczynia Lodowe</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Szklanki i kieliszki wykonane w 100% z lodu</p>
                        <p class="product-description">
                            Spektakularne szklanki i kieliszki z lodu. Idealne do serwowania shotów i drinków na eventach oraz weselach. Zapewniają absolutny efekt WOW!
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-wine-glass-alt"></i> Kieliszki / Szklanki</span>
                            <span class="feature-tag"><i class="fas fa-snowflake"></i> 100% czysty lód</span>
                            <span class="feature-tag"><i class="fas fa-star"></i> Efekt WOW</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant naczyń">
                                <button type="button" class="variant-pill active" data-value="Kieliszki 20szt (70zł)">Kieliszki 20szt — 70zł</button>
                                <button type="button" class="variant-pill" data-value="Szklanki 10szt (50zł)">Szklanki 10szt — 50zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Naczynia lodowe">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 5a: Kubek lodowy -->
                <div class="product-card" data-category="art">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/ice-breaker-10.jpg"
                                alt="Kubki z lodu - praktyczne naczynia lodowe na imprezy i eventy"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Kubek Lodowy</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Formowane kufle ze stężonego lodu</p>
                        <p class="product-description">
                            Kufle wykonane w całości z lodu. Przeznaczone do podawania alkoholi i napojów, wyjątkowo długo trzymają chłód.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-beer"></i> Lodowe Kufle</span>
                            <span class="feature-tag"><i class="fas fa-snowflake"></i> Utrzymują chłód</span>
                            <span class="feature-tag"><i class="fas fa-box"></i> 24 szt. w zestawie</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant">
                                <button type="button" class="variant-pill active" data-value="24 sztuki (96zł)">24 sztuki — 96zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Kubek lodowy">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 6: Diamenty Lodowe -->
                <div class="product-card" data-category="premium">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/diamenty-lodowe-2-1.webp"
                                alt="Luksusowe diamenty lodowe - kształt diamentu do champagne i koktajli VIP"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Diamenty Lodowe</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Geometryczny szlif diamentowy do Champagne & VIP</p>
                        <p class="product-description">
                            Luksusowy lód szlifowany w wielościan. Dedykowany do szampana, wykwintnych koktajli oraz stref VIP. Krystaliczny blask i elegancja.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-gem"></i> Szlif diamentu</span>
                            <span class="feature-tag"><i class="fas fa-crown"></i> Klient VIP</span>
                            <span class="feature-tag"><i class="fas fa-box"></i> 10 szt. w op.</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant">
                                <button type="button" class="variant-pill active" data-value="10 sztuk (35zł)">10 sztuk — 35zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Diamenty lodowe">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product: Rzeźba Lodowa -->
                <div class="product-card featured" data-category="art">
                    <div class="product-badge">Bestseller</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/rzezby/galeria-rzezby-78-filter.webp" alt="" width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Rzeźba Lodowa</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Unikatowa rzeźba z podświetleniem LED & grawerem logo</p>
                        <p class="product-description">
                            Rzeźba artystyczna tworzona na indywidualne zamówienie. Możliwość zatopienia logo firmy, napisów oraz montażu systemów nalewania alkoholu (Ice Luge).
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-lightbulb"></i> Podświetlenie LED</span>
                            <span class="feature-tag"><i class="fas fa-copyright"></i> Grawer / Logo</span>
                            <span class="feature-tag"><i class="fas fa-palette"></i> Projekt indywidualny</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills">
                                <span class="variant-pill badge-pill"><i class="fas fa-tag"></i> Od 1500 zł</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Rzeźba lodowa">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>

                <!-- Product: Misa Lodowa Łabędź -->
                <div class="product-card featured" data-category="art">
                    <div class="product-badge new">NOWOŚĆ!</div>
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/naczynia/galeria-naczynia-14-grey.webp" alt="" width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Misa Lodowa Łabędź</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Rzeźbiona misa na owoce, kawior lub alkohol</p>
                        <p class="product-description">
                            Rzeźbiona w lodzie misa w kształcie łabędzia. Służy do ekskluzywnego serwowania owoców, owoców morza, kawioru lub chłodzenia alkoholi.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-utensils"></i> Serwowanie potraw</span>
                            <span class="feature-tag"><i class="fas fa-star"></i> Wesela & Gala</span>
                            <span class="feature-tag"><i class="fas fa-snowflake"></i> Chłodzący stół</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills">
                                <span class="variant-pill badge-pill"><i class="fas fa-tag"></i> Od 600 zł</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Misa lodowa łabędź">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>

                <!-- Product 7: Japońskie Kule -->
                <div class="product-card" data-category="premium">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/other/kule-na-paletach.jpg"
                                alt="Japońskie kule lodowe średnica 6cm - najwolniejsze topnienie do whisky"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Japońskie Kule Lodowe</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Idealna kula ø 60mm — najniższe tempo topnienia</p>
                        <p class="product-description">
                            Inspiracja japońskim rzemiosłem barmańskim. Kula lodowa o średnicy 6 cm ma minimalny kontakt z powietrzem, zachowując pełnię smaku whisky.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-circle"></i> Średnica 60mm</span>
                            <span class="feature-tag"><i class="fas fa-stopwatch"></i> Najdłuższe chłodzenie</span>
                            <span class="feature-tag"><i class="fas fa-glass-whiskey"></i> Do ekskluzywnej whisky</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant">
                                <button type="button" class="variant-pill active" data-value="10 sztuk (35zł)">10 sztuk — 35zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-order" data-product="Japońskie kule">
                            <i class="fas fa-plus"></i> Do Koszyka
                        </button>
                    </div>
                </div>

                <!-- Product 8: Suchy Lód -->
                <div class="product-card" data-category="equipment">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/suchy-lod-1.webp"
                                alt="Suchy lód CO2 do efektów specjalnych - spektakularna mgła na eventach"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Suchy Lód (CO₂)</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Temp. -78.5°C do efektu ciężkiej mgły</p>
                        <p class="product-description">
                            Suchy lód w granulacie do pokazów barmańskich, first dance na weselu oraz chłodzenia żywności. Generuje gęstą, ciężką mgłę.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-temperature-low"></i> Temp. -78.5°C</span>
                            <span class="feature-tag"><i class="fas fa-smog"></i> Gęsta mgła CO₂</span>
                            <span class="feature-tag"><i class="fas fa-check"></i> Zgodny z żywnością</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills" aria-label="Wybierz wariant suchego lodu">
                                <button type="button" class="variant-pill active" data-value="Worek 5kg (70zł)">5kg — 70zł</button>
                                <button type="button" class="variant-pill" data-value="5kg + Box Termiczny (100zł)">5kg + Box — 100zł</button>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Suchy lód">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>

                <!-- Product 9: Wielki Blok -->
                <div class="product-card" data-category="art">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/blok-lodowy.webp"
                                alt="Wielki blok lodowy do rzeźbienia - możliwość zatopienia przedmiotów wewnątrz"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Wielki Blok Lodowy</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Krystaliczny blok z opcją zatapiania produktów</p>
                        <p class="product-description">
                            Monolityczny blok lodu o wybranym wymiarze. Idealny do rzeźbienia na żywo oraz jako gablota chłodnicza z zatopionym produktem / reklamą.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-cube"></i> Monolit lodowy</span>
                            <span class="feature-tag"><i class="fas fa-box-open"></i> Zatapianie rekwizytów</span>
                            <span class="feature-tag"><i class="fas fa-tools"></i> Do rzeźbienia</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills">
                                <span class="variant-pill badge-pill"><i class="fas fa-tag"></i> Od 1000-1500 zł</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Blok lodowy">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>

                <!-- Product 10: Zamrażarki -->
                <div class="product-card" data-category="equipment">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/zamrazarki-na-lod.webp"
                                alt="Profesjonalne zamrażarki na lód - wynajem i sprzedaż dla gastronomii"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Zamrażarki na Lód</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Wynajem sprzętu mroźniczego do -22°C na eventy</p>
                        <p class="product-description">
                            Przemysłowe zamrażarki skrzyniowe lub z przeszkloną klapą. Gwarantują stabilne utrzymanie temperatury lodu w gastronomii i plenerze.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-plug"></i> Zasilanie 230V</span>
                            <span class="feature-tag"><i class="fas fa-snowflake"></i> Praca do -22°C</span>
                            <span class="feature-tag"><i class="fas fa-truck-loading"></i> Doba / Wynajem</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills">
                                <span class="variant-pill badge-pill"><i class="fas fa-tag"></i> Od 350 zł/doba (netto)</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Zamrażarki">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>

                <!-- Product 11: Termoboxy -->
                <div class="product-card" data-category="equipment">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/termobox.webp"
                                alt="Boxy termiczne na lód gastronomiczny - wynajem termoboxów do transportu lodu"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Boxy Termiczne</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Pasywne termoboxy chroniące lód do 48h</p>
                        <p class="product-description">
                            Izolowane pojemniki pasywne z grubą warstwą termoizolacyjną. Utrzymują lód bez konieczności podłączania zasilania elektrycznego.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-shield-alt"></i> Izolacja EPS/EPP</span>
                            <span class="feature-tag"><i class="fas fa-clock"></i> Do 48h ochrony</span>
                            <span class="feature-tag"><i class="fas fa-hand-holding-box"></i> Wygodne uchwyty</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills">
                                <span class="variant-pill badge-pill"><i class="fas fa-tag"></i> 35 zł/doba (netto)</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Boxy termiczne">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>
                <!-- Product 12: Warsztaty i pokazy -->
                <div class="product-card" data-category="art">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/pokazy-lodowe.webp"
                                alt="Pokazy rzeźbienia w lodzie i warsztaty ice carving - integracje firmowe"
                                width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Pokazy i Warsztaty Ice Carving</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Show rzeźbienia na żywo & integracje dla firm</p>
                        <p class="product-description">
                            Widowiskowe pokazy rzeźbienia z użyciem pił łańcuchowych i dłut oraz warsztaty team-buildingowe z instruktażem barmańskim.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-fire"></i> Show na żywo</span>
                            <span class="feature-tag"><i class="fas fa-users"></i> Team Building</span>
                            <span class="feature-tag"><i class="fas fa-magic"></i> Sprzęt i BHP w cenie</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills">
                                <span class="variant-pill badge-pill"><i class="fas fa-tag"></i> Na zapytanie</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Pokazy i warsztaty">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>

                <!-- Product 13: Przewóz i wynajem samochodu -->
                <div class="product-card" data-category="equipment">
                    <div class="product-image">
                        <div class="image-placeholder">
                            <img src="../static/images/products/transport.webp" alt="Przewóz mroźniczo-chłodniczy - samochód chłodnia" width="600" height="400" loading="lazy">
                        </div>
                    </div>
                    <div class="product-content">
                        <h3>Przewóz mroźniczo-chłodniczy</h3>
                        <p class="product-tagline"><i class="fas fa-info-circle"></i> Flota mroźni (Fiat Ducato, Doblo, Scudo) do -20°C</p>
                        <p class="product-description">
                            Profesjonalny transport mroźniczy oraz wynajem pojazdu z agregatem jako mobilna mroźnia stacjonarna podczas imprez masowych.
                        </p>
                        <div class="product-features">
                            <span class="feature-tag"><i class="fas fa-truck-monster"></i> Agregat mroźniczy</span>
                            <span class="feature-tag"><i class="fas fa-thermometer-empty"></i> Temp. do -20°C</span>
                            <span class="feature-tag"><i class="fas fa-shuttle-van"></i> Ducato / Doblo / Scudo</span>
                        </div>
                        <div class="product-pricing">
                            <div class="variant-pills">
                                <span class="variant-pill badge-pill"><i class="fas fa-tag"></i> 350-500 zł (netto)</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-inquire" data-product="Przewóz mroźniczo-chłodniczy">
                            <i class="fas fa-comment-dots"></i> Zapytaj
                        </button>
                    </div>
                </div>
            </div>
        </div>


    <!-- Discrete Info Strip -->
    <section class="discreet-info-section" id="delivery-info">
        <div class="container">
            <div class="discreet-info-bar">
                <div class="info-bar-item">
                    <i class="fas fa-truck"></i>
                    <div>
                        <strong>Dostawa Łódź i okolice (24h):</strong> Transport chłodniczy • Darmowa dostawa od 250 zł • Ceny brutto
                    </div>
                </div>
                <div class="info-bar-item">
                    <i class="fas fa-certificate"></i>
                    <div>
                        <strong>Jakość i Certyfikaty:</strong> Certyfikowana woda badana w laboratorium • Wielokrotna filtracja • Standardy HACCP
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact & Direct Order Section -->
    <section class="order-section" id="order">
        <div class="container">
            <div class="b2b-contact-box">
                <div class="contact-box-left">
                    <h3><i class="fas fa-headset"></i> Dział Zamówień i Wsparcie B2B</h3>
                    <p style="color: #64748B; margin-bottom: 15px;">Możesz zamówić lód wyklikując koszyk na stronie lub dzwoniąc bezpośrednio do nas:</p>
                    
                    <div class="contact-phones-row">
                        <a href="tel:+48511110265" class="phone-chip"><i class="fas fa-phone"></i> 511 110 265</a>
                        <a href="tel:+48501494787" class="phone-chip"><i class="fas fa-phone"></i> 501 494 787</a>
                        <a href="tel:+48608401730" class="phone-chip"><i class="fas fa-phone"></i> 608 401 730</a>
                    </div>
                    <div class="contact-email-line">
                        <i class="fas fa-envelope"></i> Email: <a href="mailto:biuro@lodowe.com.pl">biuro@lodowe.com.pl</a>
                    </div>
                </div>

                <div class="contact-box-right">
                    <h4>Śledź Nas w Social Media</h4>
                    <p style="color: #64748B; font-size: 0.9rem; margin-bottom: 15px;">Zobacz nasze realizacje artystyczne i pokazy barmańskie:</p>
                    <div class="contact-social-grid">
                        <a href="https://www.facebook.com/lodowecompl" target="_blank" rel="noopener noreferrer" class="social-btn fb">
                            <i class="fab fa-facebook-f"></i> Facebook
                        </a>
                        <a href="https://www.instagram.com/lodowe.com.pl/" target="_blank" rel="noopener noreferrer" class="social-btn ig">
                            <i class="fab fa-instagram"></i> Instagram
                        </a>
                        <a href="https://www.tiktok.com/@lodowecompl" target="_blank" rel="noopener noreferrer" class="social-btn tt">
                            <i class="fab fa-tiktok"></i> TikTok
                        </a>
                        <a href="https://www.youtube.com/@lodowecompl" target="_blank" rel="noopener noreferrer" class="social-btn yt">
                            <i class="fab fa-youtube"></i> YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rich SEO Content Section (Dominacja Google Łódź) -->
    <section class="seo-content-section" id="seo-info">
        <div class="container">
            <div class="section-header-center">
                <h2>Dostawa Lodu w Łodzi — Kostki Lodu, Lód Kruszony & Suchy Lód</h2>
                <p>Niezawodne zaopatrzenie w lód spożywczy i techniczny dla gastronomii, barów oraz klientów indywidualnych w Łodzi i okolicach</p>
            </div>

            <div class="seo-content-grid">
                <!-- Card 1: Lód w Kostkach i Kruszony B2B -->
                <div class="seo-content-card">
                    <div class="card-icon"><i class="fas fa-cubes"></i></div>
                    <h3>Lód w Kostkach i Lód Kruszony dla Gastronomii w Łodzi</h3>
                    <p>
                        Nasza łódzka fabryka lodu dostarcza krystalicznie czysty <strong>lód w kostkach</strong> oraz <strong>lód kruszony</strong> wytwarzany z wielokrotnie filtrowanej wody w standardzie certyfikacji HACCP. Idealnie wyprofilowane sześciany i kostki lodu wolno się topią, gwarantując doskonałą temperaturę drinków, koktajli oraz smoothie w restauracjach, klubach i barach.
                    </p>
                    <ul>
                        <li>Kostki lodu o wysokiej gęstości i idealnej przejrzystości</li>
                        <li>Lód kruszony idealny do Mojito, Caipirinha i podawania owoców morza</li>
                        <li>Certyfikowana jakość wody pod stałą kontrolą laboratoryjną</li>
                        <li>Regularne dostawy hurtowe B2B z atrakcyjnymi rabatami dla lokali</li>
                    </ul>
                </div>

                <!-- Card 2: Suchy Lód -->
                <div class="seo-content-card">
                    <div class="card-icon"><i class="fas fa-smog"></i></div>
                    <h3>Suchy Lód (Dry Ice) — Efekty Specjalne & Transport Chłodniczy</h3>
                    <p>
                        Oferujemy stałe dostawy <strong>suchego lodu w Łodzi</strong> w formie granulatów i plastrów o temperaturze -78,5°C. Suchy lód znajduje zastosowanie zarówno w efektach wizualnych (ciężki dym na pierwszy taniec, dymiące drinki na weselach), jak i w przemyśle, cateringu oraz chłodniczym transporcie farmaceutycznym i spożywczym.
                    </p>
                    <ul>
                        <li>Granulat suchego lodu (Fi 3mm i 16mm) oraz bloki</li>
                        <li>Gwarancja minimalnego ubytku masy dzięki izolowanym opakowaniom</li>
                        <li>Idealny do tworzenia efektu mgły na imprezach firmowych i weselach</li>
                        <li>Odbiór osobisty w Łodzi lub ekspresowy transport mroźniczy</li>
                    </ul>
                </div>

                <!-- Card 3: Pogotowie Lodowe 24/7 -->
                <div class="seo-content-card">
                    <div class="card-icon"><i class="fas fa-shipping-fast"></i></div>
                    <h3>Pogotowie Lodowe Łódź — Dostawa Lodu na Imprezy i Dostawy Awaryjne</h3>
                    <p>
                        Awaria kostkarki w środku gorącego weekendu? Niespodziewana duża liczba gości w klubie? Nasze <strong>pogotowie lodowe w Łodzi</strong> reaguje błyskawicznie! Posiadamy własną flotę pojazdów chłodniczych (temp. do -20°C), co pozwala nam realizować dostawy lodu prosto pod drzwi Twojego lokalu lub na teren imprezy plenerowej.
                    </p>
                    <ul>
                        <li>Dostawy 7 dni w tygodniu na terenie całej Łodzi i aglomeracji</li>
                        <li>Realizacja zamówień tego samego dnia (dostawa ekspresowa)</li>
                        <li>Darmowy dowóz przy zamówieniach stałych i hurtowych</li>
                        <li>Dostawa do lokali, sal weselnych, ogrodów i na eventy plenerowe</li>
                    </ul>
                </div>

                <!-- Card 4: Termoboxy i Wynajem Sprzętu -->
                <div class="seo-content-card">
                    <div class="card-icon"><i class="fas fa-box-open"></i></div>
                    <h3>Pojemniki Termoizolacyjne & Wynajem Termoboxów na Lód</h3>
                    <p>
                        Dla zapewnienia ciągłości chłodzenia bez konieczności podłączania zasilania elektrycznego oferujemy wynajem profesjonalnych <strong>pasywnych pojemników termicznych (Termoboxów)</strong>. Gruba warstwa izolacji EPP/EPS pozwala na przechowywanie lodu w stanie nienaruszonym nawet przez 48 godzin.
                    </p>
                    <ul>
                        <li>Termoboxy pasywne o pojemności 20kg oraz 40kg lodu</li>
                        <li>Ochrona lodu przed topnieniem podczas imprez plenerowych i festiwali</li>
                        <li>Możliwość wynajmu mobilnych mroźni stacjonarnych z agregatem</li>
                        <li>Kompleksowa obsługa zaplecza chłodniczego dla gastronomii</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Events Cross-Sell Section -->
    <section class="events-cross-sell" style="padding: 60px 0; background: linear-gradient(135deg, #0F172A, #1E293B); color: white;">
        <div class="container">
            <div class="cross-sell-wrapper" style="display: flex; align-items: center; justify-content: space-between; gap: 30px; background: rgba(255, 255, 255, 0.05); padding: 35px 40px; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.1); flex-wrap: wrap;">
                <div class="cross-sell-text" style="max-width: 650px;">
                    <span style="display: inline-block; background: #0284C7; color: white; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; margin-bottom: 12px;">🎨 OPRAWA EVENTOWA & RZEŹBY</span>
                    <h2 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 10px; color: white;">Organizujesz wesele, galę lub imprezę firmową?</h2>
                    <p style="color: #94A3B8; font-size: 1rem; margin: 0; line-height: 1.6;">Odkryj spektakularne rzeźby z zatopionym logo, podświetlane bary z prawdziwego lodu oraz interaktywne pokazy rzeźbienia na żywo.</p>
                </div>
                <div class="cross-sell-action">
                    <a href="/eventy/index.php" class="btn btn-primary" style="padding: 14px 28px; font-size: 1rem; border-radius: 30px; display: inline-flex; align-items: center; gap: 10px; background: linear-gradient(135deg, #0891B2, #0284C7); border: none; text-decoration: none; color: white; font-weight: 700; box-shadow: 0 4px 15px rgba(2, 132, 199, 0.4);">
                        <i class="fas fa-gem"></i> Zobacz Ofertę Eventową <i class="fas fa-arrow-right"></i>
                    </a>
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
                    <a href="../index.php#contact" class="btn btn-outline-white">
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
                        <span>20+ lat tradycji</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Placeholder -->
    <?php include __DIR__ . '/../components/footer.php'; ?>

    
    <!-- CART DRAWER WIDGET (2-STEP) -->
    <div id="cart-drawer-overlay" class="cart-overlay"></div>
    <div id="cart-drawer" class="cart-drawer">
        <div class="cart-header">
            <h3><i class="fas fa-shopping-cart"></i> Koszyk B2B</h3>
            <button id="close-cart-btn"><i class="fas fa-times"></i></button>
        </div>
        
        <!-- STEP INDICATOR NAV -->
        <div class="cart-steps-nav">
            <div class="step-nav-item active" id="step-nav-1">
                <span class="step-num">1</span>
                <span class="step-text">Podsumowanie</span>
            </div>
            <div class="step-connector"><i class="fas fa-chevron-right"></i></div>
            <div class="step-nav-item" id="step-nav-2">
                <span class="step-num">2</span>
                <span class="step-text">Dane i wysyłka</span>
            </div>
        </div>
        
        <!-- FREE SHIPPING PROGRESS BAR -->
        <div id="free-shipping-bar-container" class="free-shipping-bar-container"></div>
        
        <!-- STEP 1: ITEM REVIEW -->
        <div id="cart-step-1-view" class="cart-step-view active">
            <div class="cart-items-wrapper">
                <div class="cart-items" id="cart-items-container">
                    <div class="empty-cart-msg">Koszyk jest pusty.<br><small>Wybierz produkty z listy obok.</small></div>
                </div>
            </div>
            <div class="cart-step-footer">
                <div class="cart-summary-line">
                    <span>Liczba pozycji:</span>
                    <strong id="cart-total-positions">0</strong>
                </div>
                <div class="cart-summary-line cart-total-price-line">
                    <span>Suma zamówienia:</span>
                    <strong id="cart-total-price" style="font-size: 1.2rem; color: #0284C7;">0 zł</strong>
                </div>
                <button type="button" class="btn btn-primary btn-full" id="btn-to-step-2" disabled>
                    Przejdź do dostawy <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
        
        <!-- STEP 2: DELIVERY FORM -->
        <div id="cart-step-2-view" class="cart-step-view">
            <div class="cart-step-body">
                <button type="button" class="back-to-step-1" id="btn-back-to-step-1">
                    <i class="fas fa-arrow-left"></i> Wróć do listy produktów
                </button>
                <div class="order-summary-box">
                    <div class="summary-box-header"><i class="fas fa-box-open"></i> Podsumowanie wybranych pozycji:</div>
                    <div id="mini-cart-summary-list"></div>
                    <div class="summary-box-footer" style="margin-top: 10px; padding-top: 8px; border-top: 1px dashed #CBD5E1; display: flex; justify-content: space-between; font-weight: 700; font-size: 0.95rem;">
                        <span>Razem do zapłaty:</span>
                        <strong id="mini-cart-total-price" style="color: #0284C7; font-size: 1.1rem;">0 zł</strong>
                    </div>
                </div>
                <form id="drawerOrderForm" action="../order-products.php" method="POST">
                    <h4 class="form-section-title">Dane dostawy i termin</h4>
                    <div class="drawer-form-group">
                        <input type="text" id="drawer-name" name="name" placeholder="Firma / Imię i Nazwisko *" required>
                    </div>
                    <div class="drawer-form-group">
                        <input type="email" id="drawer-email" name="email" placeholder="Email *" required>
                    </div>
                    <div class="drawer-form-group">
                        <input type="tel" id="drawer-phone" name="phone" placeholder="Telefon *" required>
                    </div>
                    <div class="drawer-form-group">
                        <input type="date" id="drawer-date" name="date" required title="Data dostawy">
                    </div>
                    <div class="drawer-form-group">
                        <textarea id="drawer-address" name="address" rows="2" placeholder="Adres dostawy *" required></textarea>
                    </div>
                    <div class="drawer-form-group">
                        <textarea id="drawer-notes" name="notes" rows="2" placeholder="Dodatkowe uwagi / Zapytanie o wycenę (opcjonalnie)"></textarea>
                    </div>
                    
                    <input type="hidden" id="recaptcha_token_order" name="recaptcha_token">
                    <div id="dynamic-products-inputs"></div>
                    
                    <button type="submit" class="btn btn-primary btn-full" id="drawer-submit-btn">
                        Wyślij Zamówienie
                    </button>
                    <div class="drawer-note">* Wymagane. Potwierdzimy zamówienie w 2h.</div>
                </form>
            </div>
        </div>
    </div>

    <!-- FLOATING CART BUTTON -->
    <button id="floating-cart-btn" class="floating-cart-btn">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-badge" id="cart-badge-count">0</span>
    </button>
    
    <!-- Scripts -->
    <script src="../js/components-loader.js?v=<?php echo filemtime(__DIR__ . '/../js/components-loader.js'); ?>"></script>
    <script src="../js/script-ice-blue.js?v=<?php echo filemtime(__DIR__ . '/../js/script-ice-blue.js'); ?>"></script>
    <script src="../js/products-page.js?v=<?php echo filemtime(__DIR__ . '/../js/products-page.js'); ?>"></script>

</body>

</html>