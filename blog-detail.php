<?php
// Blog Detail Page
$id = isset($_GET['id']) ? (string)$_GET['id'] : '';
$slug = isset($_GET['slug']) ? (string)$_GET['slug'] : '';

// Helper for normalizing image URLs
function formatBlogImg($url) {
    if (empty($url)) return '/assets/blog-1.png';
    if (preg_match('#^https?://#i', $url)) return $url;
    $clean = ltrim($url, '.');
    if (strpos($clean, '/') !== 0) {
        $clean = '/' . $clean;
    }
    return $clean;
}

// Load blogs from data/blogs.json
$blogsFile = __DIR__ . '/data/blogs.json';
$allBlogs = [];
if (file_exists($blogsFile)) {
    $allBlogs = json_decode(file_get_contents($blogsFile), true) ?: [];
}

// Articles repository
$articles = [
    '1' => [
        'id' => '1',
        'title' => 'How Many Ah Does an RV Battery Need? 100Ah vs 200Ah vs 300Ah LiFePO4 Guide',
        'slug' => 'how-many-ah-does-an-rv-battery-need-100ah-vs-200ah-vs-300ah-lifepo4-guide',
        'subtitle' => 'A complete sizing guide to choosing the right lithium battery capacity for boondocking, appliances, and off-grid RV travel.',
        'date' => 'September 26, 2026',
        'category' => 'RV & Boondocking Guide',
        'image' => '/assets/blog-1.png',
        'overview' => '<strong>Short answer:</strong> A 100Ah LiFePO4 battery can be enough for light RV use and frequent recharging. A 200Ah battery bank is better for moderate appliance use and short off-grid trips, while 300Ah or more makes more sense for longer boondocking, larger inverters and heavier daily power consumption. The correct size depends on your daily watt-hours, battery voltage, charging sources and how many days you want to stay off-grid.',
        'intro' => 'If you are asking <strong>how many Ah an RV battery needs</strong>, whether <strong>100Ah is enough for an RV</strong>, or whether you should choose a <strong>200Ah or 300Ah LiFePO4 battery</strong>, this guide will help you calculate the right capacity instead of guessing.',
        'sections' => [
            [
                'heading' => 'What Does Ah Mean on an RV Battery?',
                'body' => '<strong>Amp-hours (Ah)</strong> describe how much electrical charge a battery can deliver over time. A 100Ah battery can theoretically provide 10 amps for 10 hours, while a 200Ah battery stores twice the amp-hour capacity at the same voltage. In energy terms, watt-hours (Wh) give an even clearer picture: a 12V 100Ah LiFePO4 pack stores 1,200Wh, a 200Ah stores 2,400Wh, and a 300Ah stores 3,600Wh of clean usable power.'
            ],
            [
                'heading' => '100Ah vs 200Ah vs 300Ah: Which Capacity Do You Need?',
                'body' => '<strong>100Ah LiFePO4:</strong> Perfect for weekend campers and lightweight travel trailers running LED lights, water pumps, mobile devices, and a small 12V compressor fridge with moderate solar.<br><br><strong>200Ah LiFePO4:</strong> The undisputed gold standard for off-grid boondocking. Easily powers residential 12V fridges, laptops, TV, CPAP machines, and microwave ovens through a 2,000W inverter.<br><br><strong>300Ah+ LiFePO4:</strong> Ideal for full-time RV living, digital nomads, induction cooktop usage, and running high-efficiency mini-split or rooftop air conditioners without running noisy generators.'
            ],
            [
                'heading' => 'Usable Capacity: Why LiFePO4 Beats Lead-Acid',
                'body' => 'Traditional lead-acid and AGM batteries should only be discharged to 50% depth of discharge (DoD) to avoid permanent sulfation and early failure. Cleanergy Grade-A LiFePO4 batteries deliver 100% of their rated capacity safely, maintain full 12.8V–13.2V operating voltage until nearly empty, charge 4x faster, and last over 10 years.'
            ],
            [
                'heading' => 'Charging Sources & System Sizing',
                'body' => 'To keep your battery bank topped , pair your setup with 200W–600W of rooftop monocrystalline solar panels, a dedicated MPPT charge controller, and a DC-DC alternator charger to charge while driving your motorhome or towing vehicle.'
            ]
        ]
    ],
    '2' => [
        'id' => '2',
        'title' => 'Ann Arbor Home Battery Rebate 2026: How to Get Up to $3,500 for Battery Storage',
        'slug' => 'ann-arbor-home-battery-rebate-2026',
        'subtitle' => 'Maximize home energy incentives, reduce electric bills, and ensure uninterrupted emergency power backup.',
        'date' => 'October 04, 2026',
        'category' => 'Home Energy Storage',
        'image' => '/assets/blog-2.png',
        'overview' => '<strong>Short answer:</strong> Ann Arbor residents may qualify for up to $3,500 in clean energy rebates for installing certified LiFePO4 residential battery storage systems. Cleanergy 51.2V 300Ah systems meet local requirements, providing seamless solar integration and whole-home resilience.',
        'intro' => 'With Michigan winter storms and utility grid outages on the rise, pairing solar panels with high-capacity battery storage keeps your essential home circuits running.',
        'sections' => [
            [
                'heading' => 'Ann Arbor Clean Energy Rebate Overview',
                'body' => 'The Ann Arbor municipal sustainability program offers direct financial incentives to homeowners who invest in certified battery energy storage systems that reduce peak grid load and support municipal decarbonization goals.'
            ],
            [
                'heading' => 'Eligible Battery Systems & Technology',
                'body' => 'Systems must utilize non-toxic, long-cycle lithium chemistries like LiFePO4 with smart BMS communications, integrated fire suppression, and hybrid inverter compatibility.'
            ]
        ]
    ],
    '3' => [
        'id' => '3',
        'title' => 'Cold-Weather LiFePO4 Battery Guide for Michigan: RV, Marine, Solar & Backup Power',
        'slug' => 'cold-weather-lifepo4-battery-guide-michigan',
        'subtitle' => 'Detailed engineering comparison of sub-zero discharge, cold-cranking amps, and winter storage protocols.',
        'date' => 'October 12, 2026',
        'category' => 'Cold Weather Engineering',
        'image' => '/assets/yacht-battery.png',
        'overview' => '<strong>Short answer:</strong> Sodium-ion batteries deliver exceptional sub-zero cranking down to -30°C (-22°F) without freezing risks or pre-heating requirements. Standard LiFePO4 batteries excel in longevity and energy density, but require intelligent BMS low-temp charge cutoff or internal heating pads when charging below freezing.',
        'intro' => 'If you operate off-grid cabins, snow vehicles, ice fishing equipment, or cold-climate marine vessels in Michigan, understanding how cold temperatures affect battery chemistry is vital for system safety and reliability.',
        'sections' => [
            [
                'heading' => 'Why Freezing Temperatures Hurt Conventional Batteries',
                'body' => 'Sub-zero temperatures dramatically slow chemical reactions inside energy storage cells. While traditional lead-acid batteries lose over 50% of their cranking power in freezing conditions and risk cracked cases from frozen electrolyte, Cleanergy lithium and sodium-ion technologies provide reliable winter power.'
            ],
            [
                'heading' => 'Sodium-Ion Chemical Advantages in Sub-Zero Climates',
                'body' => 'Cleanergy Sodium-Ion starting batteries maintain superior discharge rates down to -30°C without the freezing damage risks of lead-acid. Sodium ions diffuse faster through low-temperature electrolytes, making them unbeatable for winter engine starting, snowmobiles, and unheated northern cabins.'
            ],
            [
                'heading' => 'LiFePO4 Cold Charging Safeguards & Internal Heaters',
                'body' => 'Standard LiFePO4 cells must not be charged below 0°C (32°F) to prevent lithium plating on the anodes. Cleanergy cold-weather series feature intelligent BMS sensors and automatic internal heating elements that warm the cells using incoming solar power before initiating charge cycles.'
            ]
        ]
    ]
];

// Match article by slug or id
$article = null;

// 1. Check data/blogs.json first by seo_url, id, or link
foreach ($allBlogs as $b) {
    $bSlug = $b['seo_url'] ?? '';
    $bId = (string)($b['id'] ?? '');
    $bLink = (string)($b['link'] ?? '');
    
    if (($slug !== '' && ($bSlug === $slug || str_contains($bLink, $slug) || str_contains($slug, $bSlug) || str_contains($bSlug, substr($slug, 0, 18)))) ||
        ($id !== '' && ($bId === $id || $bSlug === $id))) {
        
        // Find matching predefined rich article if available
        $rich = null;
        foreach ($articles as $art) {
            if (stripos($art['title'], substr($b['title'], 0, 20)) !== false || ($art['slug'] ?? '') === $slug) {
                $rich = $art;
                break;
            }
        }
        
        $article = [
            'id' => $bId,
            'title' => $b['title'],
            'subtitle' => $rich['subtitle'] ?? ($b['seo_desc'] ?? $b['desc']),
            'date' => $b['date'],
            'category' => $rich['category'] ?? 'Battery Guide',
            'image' => formatBlogImg($b['image']),
            'overview' => $rich['overview'] ?? ('<p>' . htmlspecialchars($b['desc']) . '</p>'),
            'intro' => $rich['intro'] ?? '',
            'description' => $b['description'] ?? ($rich['description'] ?? ''),
            'sections' => $rich['sections'] ?? [
                [
                    'heading' => 'Overview & Key Details',
                    'body' => htmlspecialchars($b['desc'])
                ]
            ]
        ];
        break;
    }
}

// 2. Fallback to predefined articles if not found in blogs.json
if (!$article) {
    if ($slug !== '') {
        foreach ($articles as $art) {
            if (($art['slug'] ?? '') === $slug || stripos($art['title'], str_replace('-', ' ', substr($slug, 0, 25))) !== false) {
                $article = $art;
                break;
            }
        }
    }
    if (!$article) {
        $article = $articles[$id] ?? $articles['1'];
    }
}
$article['image'] = formatBlogImg($article['image'] ?? '');
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <title><?= htmlspecialchars($article['title']) ?> - Cleanergy Blog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/dist/output.css') ?>">
    <style>
        .blog-detailed-content h2 {
            font-size: 1.75rem;
            font-weight: 800;
            color: #0f172a;
            margin-top: 2.25rem;
            margin-bottom: 1rem;
            line-height: 1.25;
            letter-spacing: -0.02em;
        }
        @media (min-width: 640px) {
            .blog-detailed-content h2 {
                font-size: 2.125rem;
            }
        }
        .blog-detailed-content h3 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 1.75rem;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }
        .blog-detailed-content p {
            margin-bottom: 1.25rem;
            line-height: 1.8;
            color: #334155;
            font-size: 1.05rem;
        }
        .blog-detailed-content strong {
            font-weight: 700;
            color: #0f172a;
        }
        .blog-detailed-content ul, .blog-detailed-content ol {
            margin-top: 0.75rem;
            margin-bottom: 1.5rem;
            padding-left: 1.75rem;
        }
        .blog-detailed-content ul {
            list-style-type: disc;
        }
        .blog-detailed-content ol {
            list-style-type: decimal;
        }
        .blog-detailed-content li {
            margin-bottom: 0.5rem;
            line-height: 1.7;
            color: #334155;
        .blog-detailed-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
            margin-bottom: 2.5rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            font-size: 0.95rem;
            display: block;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .blog-detailed-content img, .blog-detailed-content iframe, .blog-detailed-content video {
            max-width: 100%;
            height: auto;
            border-radius: 0.75rem;
        }
        .blog-detailed-content th {
            background-color: #f8fafc;
            padding: 0.85rem 1.15rem;
            text-align: left;
            font-weight: 700;
            color: #0f172a;
            border-bottom: 2px solid #cbd5e1;
        }
        .blog-detailed-content td {
            padding: 0.85rem 1.15rem;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
            vertical-align: top;
        }
        .blog-detailed-content tr:nth-child(even) td {
            background-color: #fcfdfe;
        }
        .blog-detailed-content a {
            color: #088395;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: color 0.15s ease;
        }
        .blog-detailed-content a:hover {
            color: #0e7490;
        }
        .blog-detailed-content blockquote {
            border-left: 4px solid #12b3d6;
            padding: 0.75rem 1.25rem;
            margin: 1.75rem 0;
            background-color: #f0fbfd;
            border-radius: 0 0.5rem 0.5rem 0;
            font-style: italic;
            color: #1e293b;
        }
    </style>
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/components/navbar.php';
    ?>

    <!-- 1. Top Banner (Exact Same Size as Contact Us and All Other Pages) -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden bg-slate-900 flex items-center">
        <img src="<?= htmlspecialchars($article['image']) ?>" 
             alt="<?= htmlspecialchars($article['title']) ?>" 
             class="w-full h-full object-cover object-center block">
    </section>

    <!-- 2. Content Area (H1 Heading, Date and All Content Strictly Left-Aligned) -->
    <main class="flex-1 w-full bg-white text-slate-900 py-10 sm:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-left">
            
            <!-- Category Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-[#d7f3fb] text-[#0e7490] text-xs font-bold mb-4">
                <span><?= htmlspecialchars($article['category']) ?></span>
            </div>

            <!-- H1 Heading (Left-Aligned in Content Area) -->
            <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold text-slate-900 tracking-tight leading-[1.2] mb-4 text-left">
                <?= htmlspecialchars($article['title']) ?>
            </h1>

            <!-- Subtitle (Left-Aligned) -->
            <?php if (!empty($article['subtitle'])): ?>
                <p class="text-slate-600 text-base sm:text-lg leading-relaxed mb-6 text-left font-normal">
                    <?= htmlspecialchars($article['subtitle']) ?>
                </p>
            <?php endif; ?>

            <!-- Release Date with Clock Icon and Border Line (Exact Match to Screenshot) -->
            <div class="flex items-center gap-2 text-xs sm:text-[13px] uppercase tracking-wider text-slate-500 font-medium pb-4 border-b border-slate-200 mb-8">
                <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                <span>RELEASE DATE: <?= htmlspecialchars(strtoupper($article['date'])) ?></span>
            </div>

            <?php if (!empty($article['description'])): ?>
                <!-- Full Blog Description from Live Site / Admin Editor -->
                <div class="blog-detailed-content leading-relaxed text-slate-700 text-base sm:text-lg">
                    <?= $article['description'] ?>
                </div>
            <?php else: ?>
                <!-- Overview / Short Answer Lead -->
                <?php if (!empty($article['overview'])): ?>
                    <p class="text-slate-800 text-base sm:text-lg leading-relaxed mb-6 font-normal">
                        <?= $article['overview'] ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($article['intro'])): ?>
                    <p class="text-slate-700 text-base sm:text-lg leading-relaxed mb-8 font-normal">
                        <?= $article['intro'] ?>
                    </p>
                <?php endif; ?>

                <!-- Article Sections (Left-Aligned Heading & Body) -->
                <div class="space-y-8 sm:space-y-10">
                    <?php foreach ($article['sections'] as $sec): ?>
                        <div>
                            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-4 leading-tight">
                                <?= htmlspecialchars($sec['heading']) ?>
                            </h2>
                            
                            <p class="text-slate-700 text-base sm:text-lg leading-relaxed font-normal">
                                <?= $sec['body'] ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Back to All Guides Button (Left-Aligned) -->
            <div class="mt-14 sm:mt-16 pt-8 border-t border-slate-200">
                <a href="/blog.php" 
                   class="inline-flex items-center gap-2 px-8 py-3 rounded-full bg-[#12b3d6] hover:bg-[#0ea5e9] text-white font-bold text-sm transition-all duration-200 hover:shadow-md">
                    <span>← Back to All Guides</span>
                </a>
            </div>

        </div>
    </main>

    <?php
    // Include Footer
    include __DIR__ . '/components/footer.php';
    ?>

</body>
</html>
