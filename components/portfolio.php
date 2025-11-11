<?php
// Mapowanie folderów na kategorie i nazwy
$folderMapping = [
    'sculptures' => ['folder' => 'rzezby', 'title' => 'Rzeźba Lodowa', 'description' => 'Gala'],
    'blocks' => ['folder' => 'bryly', 'title' => 'Bryła z Logo', 'description' => 'Prezent firmowy'],
    'bars' => ['folder' => 'bary', 'title' => 'Bar Lodowy', 'description' => 'Wesele'],
    'shows' => ['folder' => 'pokazy', 'title' => 'Pokaz Lodowy', 'description' => 'Event'],
    'workshops' => ['folder' => 'warsztaty', 'title' => 'Warsztaty Lodowe', 'description' => 'Integracja'],
    'products' => ['folder' => 'products', 'title' => 'Produkt', 'description' => 'Oferta']
];

// Funkcja do pobrania wszystkich obrazków z folderu
function getImagesFromFolder($folderPath) {
    $images = [];
    $allowedExtensions = ['webp', 'jpg', 'jpeg', 'png'];

    if (is_dir($folderPath)) {
        $files = scandir($folderPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;

            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($extension, $allowedExtensions)) {
                $images[] = $file;
            }
        }
    }

    return $images;
}

// Generowanie HTML dla portfolio
$portfolioItems = [];

foreach ($folderMapping as $category => $config) {
    $folderPath = __DIR__ . '/../static/images/' . $config['folder'];
    $images = getImagesFromFolder($folderPath);

    foreach ($images as $image) {
        $imagePath = 'static/images/' . $config['folder'] . '/' . $image;
        $portfolioItems[] = [
            'category' => $category,
            'imagePath' => $imagePath,
            'title' => $config['title'],
            'description' => $config['description'],
            'alt' => $config['title']
        ];
    }
}
?>
<section class="portfolio" id="portfolio">
    <div class="container">
        <div class="section-header">
            <span class="section-subtitle">Nasze Prace</span>
            <h2 class="section-title">Portfolio Realizacji</h2>
        </div>

        <div class="portfolio-filters">
            <button class="filter-btn active" data-filter="all">Wszystkie</button>
            <button class="filter-btn" data-filter="sculptures">Rzeźby</button>
            <button class="filter-btn" data-filter="blocks">Bryły</button>
            <button class="filter-btn" data-filter="bars">Bary</button>
            <button class="filter-btn" data-filter="shows">Pokazy</button>
            <button class="filter-btn" data-filter="workshops">Warsztaty</button>
            <button class="filter-btn" data-filter="products">Produkty</button>
        </div>
        <div class="portfolio-wrapper" id="portfolioWrapper">
            <div class="portfolio-grid">
                <?php foreach ($portfolioItems as $item): ?>
                <a href="<?php echo htmlspecialchars($item['imagePath']); ?>" class="glightbox portfolio-item"
                    data-category="<?php echo htmlspecialchars($item['category']); ?>" data-gallery="portfolio"
                    data-glightbox="title: <?php echo htmlspecialchars($item['title']); ?>; description: <?php echo htmlspecialchars($item['description']); ?>">
                    <div class="portfolio-placeholder">
                        <img src="<?php echo htmlspecialchars($item['imagePath']); ?>" alt="<?php echo htmlspecialchars($item['alt']); ?>" loading="lazy">
                    </div>
                    <div class="portfolio-overlay">
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p><?php echo htmlspecialchars($item['description']); ?></p>
                        <span class="portfolio-btn"><i class="fas fa-search-plus"></i></span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="portfolio-fade" id="portfolioFade">
                <button id="portfolioToggleBtn" class="btn btn-primary">Zobacz więcej</button>
            </div>
        </div>
    </div>
</section>
