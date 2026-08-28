<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lodowe.com.pl — Dostawa Lodu, Rzeźby & Bary Lodowe Łódź</title>
    <meta name="description"
        content="Oficjalny serwis Lodowe.com.pl: Ekspresowa dostawa lodu w kostkach, kruszonego i suchego lodu oraz ekskluzywne rzeźby i bary lodowe na eventy w Łodzi. Tel: 511 110 265.">
    <meta name="keywords"
        content="lodowe, dostawa lodu łódź, lód w kostkach łódź, lód kruszony łódź, suchy lód łódź, rzeźby lodowe łódź, bary lodowe łódź">
    <link rel="canonical" href="https://lodowe.com.pl/">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        body, html {
            height: 100vh;
            width: 100%;
            overflow: hidden; /* Brak tradycyjnego scrollowania */
            background-color: #111;
        }

        /* Split Screen Container */
        .split-container {
            display: flex;
            height: 100vh;
            width: 100vw;
            flex-direction: row;
        }

        /* Generic Section Styles */
        .split-section {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            flex: 1; /* Podział 50/50 */
            height: 100%;
            position: relative;
            transition: flex 0.6s cubic-bezier(0.25, 1, 0.5, 1); /* Płynne skalowanie szerokości */
            color: #fff;
            text-align: center;
            padding: 2rem;
            cursor: pointer;
            overflow: hidden;
        }

        /* Hover Effect for Split Sections - grow to 60%, shrink other to 40% (1.5 vs 1) */
        .split-container:hover .split-section {
            flex: 1; /* default dla nie-najechanych, ale jeśli najedziemy - kurczą się */
        }
        
        /* By osiągnąć dokładny efekt 60/40 należy zdefiniować konkretne zjawiska flex */
        @media (min-width: 769px) {
            .split-container:hover .split-section:not(:hover) {
                flex: 0.666; /* 40% (reszta) */
            }
            .split-section:hover {
                flex: 1.5 !important; /* 60% */
            }
        }

        /* ============================
           Left Section: B2B / Gastro
           ============================ */
        .b2b-section {
            /* Jasne, zimne techniczne tło, przypominające chłód i lód */
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #0f172a;
        }
        
        .b2b-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url('data:image/svg+xml;utf8,<svg opacity="0.05" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%230ea5e9" stroke-width="2"/></svg>') repeat;
            background-size: 20px 20px;
            z-index: 0;
            pointer-events: none;
        }

        .b2b-section .content-wrapper,
        .premium-section .content-wrapper {
            position: relative;
            z-index: 1;
            max-width: 450px;
            transition: transform 0.4s ease;
        }

        .split-section:hover .content-wrapper {
            transform: scale(1.05); /* Delikatne najechanie zawartości */
        }

        .b2b-section h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -1px;
            color: #0c4a6e;
        }

        .b2b-section p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: #334155;
            font-weight: 500;
        }

        .btn-b2b {
            padding: 1rem 2.5rem;
            background-color: #0ea5e9;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.4);
            transition: background 0.3s, transform 0.2s;
        }

        .btn-b2b:hover {
            background-color: #0284c7;
            transform: translateY(-2px);
        }

        /* ============================
           Right Section: Premium / Art
           ============================ */
        .premium-section {
            /* Ciemne, luksusowe tło (antracyt) */
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        .premium-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            /* Złoty pyłek / noise dający poczucie prestiżu */
            background: radial-gradient(circle at center, rgba(234, 179, 8, 0.08) 0%, transparent 60%);
            z-index: 0;
            pointer-events: none;
        }

        .premium-section h2 {
            font-size: 2.5rem;
            font-weight: 400; /* Lżejszy font dla prestiżu */
            margin-bottom: 1rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Cinzel', serif, sans-serif; /* Fallback sans-serif, ale zalecany Cinzel dla eleganckiego h2 */
            color: #f8fafc;
        }

        .premium-section p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            color: #cbd5e1;
            font-weight: 300;
        }

        .btn-premium {
            padding: 1rem 2.5rem;
            background-color: transparent;
            color: #eab308; /* Subtelne złoto */
            border: 1px solid rgba(234, 179, 8, 0.5);
            border-radius: 0px; /* Ostre krawędzie dodaja ekskluzywności */
            font-size: 1.1rem;
            font-weight: 400;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.4s ease;
        }

        .btn-premium:hover {
            background-color: rgba(234, 179, 8, 0.1);
            border-color: #eab308;
            box-shadow: 0 0 20px rgba(234, 179, 8, 0.15);
        }

        /* ============================
           Logo na środku (Opcjonalne, ale bardzo UX)
           ============================ */
        .center-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90px;
            height: 90px;
            background: #FFFFFF;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            z-index: 10;
            pointer-events: none;
            border: 4px solid #F8FAFC;
            padding: 8px;
        }

        /* ============================
           Responsywność (Mobile)
           ============================ */
        @media (max-width: 768px) {
            .split-container {
                flex-direction: column;
            }

            .split-section {
                width: 100vw;
                height: 50vh; /* Zmiana flex-direction w 50vh per sekcja */
                flex: none; /* Odpięcie hover-flex dla mobile z uwagi na touch device */
                transition: padding 0.3s ease;
            }

            /* Na mobile nie stosujemy rośnięcia sekcji flex po najechaniu (hover psuje UX palca) */
            .split-container:hover .split-section {
                flex: none;
            }
            .split-section:hover,
            .split-container:hover .split-section:not(:hover) {
                flex: none !important; 
            }
            
            /* Zmniejszamy logo na srodku */
            .center-logo {
                width: 60px;
                height: 60px;
                font-size: 11px;
            }

            .b2b-section h2, .premium-section h2 {
                font-size: 2rem;
            }

            .b2b-section p, .premium-section p {
                font-size: 1rem;
                margin-bottom: 1.5rem;
            }
        }

        /* WOŚP Floating Badge */
        .wosp-badge {
            position: absolute;
            bottom: 25px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ef4444; /* red */
            color: #fff;
            padding: 10px 24px;
            border-radius: 99px;
            font-size: 1rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 50;
            box-shadow: 0 5px 20px rgba(239, 68, 68, 0.4);
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .wosp-badge:hover {
            transform: translateX(-50%) scale(1.05);
            background-color: #dc2626;
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.6);
        }
        
        .wosp-badge i {
            animation: pulse-heart 1.5s infinite;
        }

        @media (max-width: 768px) {
            .wosp-badge {
                /* On mobile, split happens horizontally. Put the badge exactly in the center of the screen to break the two sections nicely */
                bottom: 50%;
                transform: translate(-50%, 50%);
                padding: 10px 20px;
                font-size: 0.9rem;
                border: 2px solid white;
            }
            .wosp-badge:hover {
                transform: translate(-50%, 50%) scale(1.05);
            }
            /* Adjust the central LODOWE logo upwards so they don't overlap, or hide it on mobile if needed. Actually they would overlap heavily */
            .center-logo {
                display: none;
            }
        }

        @keyframes pulse-heart {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
    <!-- Import eleganckiego fontu dla sekcji Premium, jeżeli jest dostępny -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Inter:wght@300;500;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="split-container">
        <!-- Lewa Sekcja: Gastronomia B2B -->
        <a href="/dostawa-lodu/" class="split-section b2b-section" style="text-decoration: none;">
            <div class="content-wrapper">
                <h2>Dział Zaopatrzenia</h2>
                <p>Niezawodne dostawy lodu dla Twojego lokalu. Lód w kostkach, kruszony, suchy lód - prosto pod Twoje drzwi.</p>
                <span class="btn-b2b">Zamów Lód</span>
            </div>
        </a>

        <!-- Prawa Sekcja: Rzeźby i Eventy -->
        <a href="/eventy/" class="split-section premium-section" style="text-decoration: none;">
            <div class="content-wrapper">
                <h2>Rzeźby i Pokazy</h2>
                <p>Ekskluzywne rzeźby lodowe i spektakularne pokazy Live Carvingu na Twój wyjątkowy event.</p>
                <span class="btn-premium">Strefa Eventowa</span>
            </div>
        </a>
    </div>

</body>
</html>
