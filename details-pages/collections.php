<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battery Categories - Cleanergy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/../components/navbar.php';

    // 9 Application Collections / Categories Data linking to dedicated pages
    $collections = [
        [
            'slug' => 'marine',
            'title' => 'Marine Batteries',
            'desc' => 'LiFePO4 and sodium-ion battery solutions for boats, marine engines, onboard electronics and reliable power on the water.',
            'link' => '/marine-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.5l2.25-2.25a3 3 0 014.242 0l1.016 1.016a3 3 0 004.242 0l1.016-1.016a3 3 0 014.242 0L21 13.5M3 18.5l2.25-2.25a3 3 0 014.242 0l1.016 1.016a3 3 0 004.242 0l1.016-1.016a3 3 0 014.242 0L21 18.5M12 4.5v5m-4.5-2.5l4.5 2.5 4.5-2.5"/>
                </svg>'
        ],
        [
            'slug' => 'fishing-boat',
            'title' => 'Fishing Boat Batteries',
            'desc' => 'Deep-cycle battery systems for trolling motors, fish finders and extended fishing trips with dependable runtime and reduced maintenance.',
            'link' => '/fishing-boat-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v13.5m0 0a3 3 0 01-3 3H6m6-3a3 3 0 003 3h3m-9-10.5h12M4.5 12h15"/>
                </svg>'
        ],
        [
            'slug' => 'rv',
            'title' => 'RV Batteries',
            'desc' => 'Lightweight lithium power for RVs and campers, supporting appliances, lighting, off-grid camping and long-distance travel.',
            'link' => '/rv-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.75A1.5 1.5 0 012.25 17.25V6.75A2.25 2.25 0 014.5 4.5h11.25a2.25 2.25 0 012.25 2.25v2.25M8.25 18.75h6m3 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h2.25a1.5 1.5 0 001.5-1.5v-3.75a2.25 2.25 0 00-1-1.875L18 9.75M6.75 9.75h3.75"/>
                </svg>'
        ],
        [
            'slug' => 'golf-cart',
            'title' => 'Golf Cart Batteries',
            'desc' => 'High-capacity 48V and 51.2V lithium battery systems designed for dependable golf cart range, power delivery and long service life.',
            'link' => '/golf-cart-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                </svg>'
        ],
        [
            'slug' => 'solar',
            'title' => 'Solar Batteries',
            'desc' => 'Efficient deep-cycle battery storage for solar energy systems, backup power and renewable energy applications.',
            'link' => '/solar-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                </svg>'
        ],
        [
            'slug' => 'home-storage',
            'title' => 'Home Energy Storage',
            'desc' => 'High-capacity battery systems for home backup, solar integration and dependable stored energy when you need it most.',
            'link' => '/home-storage-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>'
        ],
        [
            'slug' => 'off-grid',
            'title' => 'Off-Grid Batteries',
            'desc' => 'Reliable LiFePO4 battery systems for cabins, remote sites and independent power setups where consistent energy matters.',
            'link' => '/off-grid-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>'
        ],
        [
            'slug' => 'cold-weather',
            'title' => 'Cold-Weather Batteries',
            'desc' => 'Selected self-heating and sodium-ion battery options designed to support dependable performance in low-temperature conditions.',
            'link' => '/cold-weather-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m0-18l3 3m-3-3l-3 3m0 12l3 3m0 0l3-3m-6.364-2.636l12.728-12.728m-12.728 0l12.728 12.728M3 12h18m-18 0l3-3m-3 3l3 3m12-6l3 3m0 0l-3 3"/>
                </svg>'
        ],
        [
            'slug' => 'sodium-ion',
            'title' => 'Sodium-Ion Batteries',
            'desc' => 'Advanced sodium-ion battery solutions for specialized starting, backup and cold-weather power applications.',
            'link' => '/sodium-ion-batteries.php',
            'icon_svg' => '
                <svg class="w-8 h-8 text-[#0369a1]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>'
        ]
    ];
    ?>

    <!-- 1. Hero Banner (Exact Same Size as All Other Pages, matching Categories PDF) -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden bg-slate-900 flex flex-col justify-between items-center text-center">
        
        <!-- Background Image Edge-to-Edge -->
        <img src="/assets/img/banner2.jpg" 
             alt="Clean Energy Categories Banner" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        
        <!-- Dark Overlay Matching PDF -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-900/40 to-black/30"></div>

        <!-- Empty spacer for top navbar clearance -->
        <div class="pt-24 sm:pt-32"></div>

        <!-- Big Centered "Categories" Title (Exact PDF Match) -->
        <div class="relative z-10 px-4 my-auto">
            <h1 class="text-4xl sm:text-6xl lg:text-7xl font-extrabold text-white tracking-wide drop-shadow-lg">
                Categories
            </h1>
        </div>

        <!-- Spacer for balanced height -->
        <div class="pb-16 sm:pb-24"></div>

    </section>

    <!-- 2. Shop by Application Section (9 Application Cards - Exact PDF Match) -->
    <main class="flex-1 py-16 sm:py-20 lg:py-24 bg-white text-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header (Centered) -->
            <div class="text-center max-w-4xl mx-auto mb-14 sm:mb-18">
                <!-- Centered Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#d7f3fb] text-slate-800 text-xs sm:text-sm font-semibold mb-4">
                    Shop by Application
                </div>

                <!-- Main Heading (Centered with Cyan Highlights) -->
                <h2 class="text-2xl sm:text-3xl lg:text-[36px] font-extrabold text-slate-900 leading-tight tracking-tight mb-4">
                    Find the Right LiFePO4 or Sodium-Ion Battery for 
                    <span class="text-[#12b3d6]">Your Boat, RV, Home Solar System or Off-Grid Setup</span>
                </h2>

                <!-- Centered Subtitle Description -->
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-3xl mx-auto">
                    Choose your application below and see batteries matched to your voltage, capacity and operating conditions.
                </p>
            </div>

            <!-- 9 Application Cards Grid (3 Columns on Desktop, 2 on Tablet, 1 on Mobile) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-8 items-stretch">
                <?php foreach ($collections as $item): ?>
                    <div onclick="window.location.href='<?= htmlspecialchars($item['link']) ?>'" 
                         class="cursor-pointer bg-white rounded-3xl border-[1.5px] border-[#a5e4f4] p-7 sm:p-8 flex flex-col justify-between shadow-xs hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                        
                        <div>
                            <!-- Icon Square Badge (Soft Cyan Tint matching PDF) -->
                            <div class="w-16 h-16 rounded-2xl bg-[#a2d2df] flex items-center justify-center mb-6 shadow-xs group-hover:scale-105 transition-transform duration-300">
                                <?= $item['icon_svg'] ?>
                            </div>

                            <!-- Card Title -->
                            <h3 class="font-extrabold text-slate-900 text-lg sm:text-xl leading-snug mb-3 group-hover:text-[#12b3d6] transition-colors">
                                <a href="<?= htmlspecialchars($item['link']) ?>" onclick="event.stopPropagation();">
                                    <?= htmlspecialchars($item['title']) ?>
                                </a>
                            </h3>

                            <!-- Card Description -->
                            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed mb-6">
                                <?= htmlspecialchars($item['desc']) ?>
                            </p>
                        </div>

                        <!-- Explore Pill Button with Arrow (Without green circle) -->
                        <div class="pt-2">
                            <a href="<?= htmlspecialchars($item['link']) ?>" 
                               onclick="event.stopPropagation();"
                               class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-[#a2d2df] group-hover:bg-[#12b3d6] group-hover:text-white text-slate-900 text-xs sm:text-sm font-semibold transition-all duration-200">
                                <span>Explore</span>
                                <span class="text-slate-900 group-hover:text-white text-xs sm:text-sm font-bold group-hover:translate-x-0.5 transition-transform">
                                    →
                                </span>
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </main>

    <?php
    // Include Footer
    include __DIR__ . '/../components/footer.php';
    ?>

</body>
</html>
