<?php
// Centralized Category Page View for Cleanergy
// Used by marine-batteries.php, rv-batteries.php, golf-cart-batteries.php, etc.

require_once __DIR__ . '/../data/products.php';

$categorySlug = $current_category_slug ?? 'marine';

// Extended category metadata dictionary
$categoryMeta = [
    'marine' => [
        'title' => 'Marine Batteries',
        'badge' => 'Marine & Saltwater Power',
        'subtitle' => 'High-cranking LiFePO4 and sodium-ion starting and deep-cycle battery systems for boats, yachts, outboard engines and marine electronics.',
        'banner_img' => '/assets/img/banner1.jpg',
        'highlights' => [
            ['title' => '1300+ Cranking Amps', 'desc' => 'High continuous discharge capability for intense engine ignition and heavy auxiliary thrusters.'],
            ['title' => 'IP67 Saltwater Sealed', 'desc' => 'Corrosion-resistant housing keeping moisture, salt fog, and bilge spray completely out.'],
            ['title' => '70% Lighter on Vessels', 'desc' => 'Saves hundreds of pounds on your transom, improving boat speed, draft, and fuel efficiency.'],
            ['title' => 'Smart Marine BMS', 'desc' => 'Integrated safety protection against marine vibrations, over-charge, and short circuits.']
        ],
        'faqs' => [
            ['q' => 'Can I use Cleanergy marine batteries for starting boat engines?', 'a' => 'Yes! Our high-cranking sodium-ion and LiFePO4 batteries deliver up to 1300 CCA, engineered specifically for high-compression marine outboards and inboard engines.'],
            ['q' => 'Are these batteries sealed against saltwater bilge moisture?', 'a' => 'Yes. All our marine battery cases feature IP67 hermetic sealing and anti-corrosion stainless steel / brass hardware designed for brutal marine environments.'],
            ['q' => 'Can I charge them with my outboard alternator?', 'a' => 'Yes, our built-in Smart BMS accepts standard marine alternator output with compatible DC-DC or lithium-compatible regulators.'],
            ['q' => 'How many years do marine lithium batteries typically last?', 'a' => 'Cleanergy marine batteries provide over 4,000 deep cycles, typically lasting 10+ years — more than 4x longer than traditional marine lead-acid batteries.']
        ]
    ],
    'fishing-boat' => [
        'title' => 'Fishing Boat Batteries',
        'badge' => 'Angler & Tournament Grade',
        'subtitle' => 'Dependable deep-cycle lithium power for trolling motors, high-definition fish finders, livewells, and extended fishing trips.',
        'banner_img' => '/assets/img/banner1.jpg',
        'highlights' => [
            ['title' => 'Constant Trolling Thrust', 'desc' => 'Maintains full 12V/24V power without voltage sag from early morning blast-off to weigh-in.'],
            ['title' => 'Zero Interference', 'desc' => 'Ultra-clean DC power delivery preventing screen noise on Garmin, Humminbird, and Lowrance sonar.'],
            ['title' => 'Rapid Dockside Charge', 'desc' => 'Recharges to 100% in under 2 hours with compatible lithium chargers.'],
            ['title' => 'Vibration Proof', 'desc' => 'Internal cell cushioning engineered to handle high-speed choppy water and boat chop.']
        ],
        'faqs' => [
            ['q' => 'How long can I run a 24V or 36V trolling motor?', 'a' => 'With our 100Ah LiFePO4 batteries, anglers easily get full multi-day fishing trips without dropping power or experiencing trolling speed drag.'],
            ['q' => 'Can I connect two 12V batteries in series for a 24V motor?', 'a' => 'Yes, our batteries support series and parallel configurations up to 48V for 24V and 36V trolling motor systems.'],
            ['q' => 'Will this clean battery power fix fish finder noise?', 'a' => 'Yes, lithium phosphate delivers ultra-low ripple DC power that eliminates electrical noise on sonar and live-scope displays.']
        ]
    ],
    'rv' => [
        'title' => 'RV Batteries',
        'badge' => 'Mobile Living & Campers',
        'subtitle' => 'Lightweight lithium power for motorhomes, fifth wheels, and camper vans supporting air conditioners, microwaves, and off-grid boondocking.',
        'banner_img' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&w=2070&q=80',
        'highlights' => [
            ['title' => '100% Usable Capacity', 'desc' => 'Draw down to 0% with no voltage drop, providing twice the usable energy of lead-acid RV batteries.'],
            ['title' => 'Drop-in Group 24/27/31', 'desc' => 'Standard RV battery tray dimensions for straightforward plug-and-play installation.'],
            ['title' => 'Silent AC Operation', 'desc' => 'Powers 12V or inverter air conditioning and appliances without noisy campsite generators.'],
            ['title' => 'Safe Indoor Mounting', 'desc' => 'Non-toxic, zero gas emissions and zero acid spills allow safe installation inside RV living areas.']
        ],
        'faqs' => [
            ['q' => 'Can I replace my lead-acid camper batteries with lithium?', 'a' => 'Yes, our RV batteries are standard drop-in replacements with standard terminal connections and built-in Smart BMS.'],
            ['q' => 'Can I run my RV air conditioner off these batteries?', 'a' => 'Yes! When paired with a 2000W-3000W inverter, our 200Ah+ lithium battery banks easily run modern RV air conditioners.'],
            ['q' => 'Do I need to vent lithium batteries outside the RV?', 'a' => 'No. LiFePO4 cells do not produce hydrogen gas, allowing safe installation under your RV bed or inside storage compartments.']
        ]
    ],
    'golf-cart' => [
        'title' => 'Golf Cart Batteries',
        'badge' => 'Fleet & Utility Vehicles',
        'subtitle' => 'High-capacity 48V and 51.2V lithium conversion packs designed for maximum range, hill-climbing torque, and zero maintenance.',
        'banner_img' => 'https://images.unsplash.com/photo-1535131749006-b7f58c99034b?auto=format&fit=crop&w=2070&q=80',
        'highlights' => [
            ['title' => '300+ lbs Lighter', 'desc' => 'Drastically reduces vehicle curb weight, accelerating speed and reducing tire and turf wear.'],
            ['title' => '45+ Miles on One Charge', 'desc' => 'Extended drive distance allowing multiple 18-hole rounds or long neighborhood cruising.'],
            ['title' => 'Zero Battery Watering', 'desc' => 'No corrosive acid spills, terminal corrosion, or messy monthly distilled water top-ups.'],
            ['title' => '300A Hill Climb Peak', 'desc' => 'Strong peak discharge amps deliver rapid hill climbing without sluggish speed reduction.']
        ],
        'faqs' => [
            ['q' => 'Are these compatible with EZ-GO, Club Car, and Yamaha?', 'a' => 'Yes! Our 48V / 51.2V packs are designed as single-unit drop-in conversions for all leading golf cart brands.'],
            ['q' => 'How much weight do I save converting to lithium?', 'a' => 'Replacing six 8V lead-acid batteries with our single lithium pack saves over 300 pounds (135 kg), dramatically increasing acceleration and range.'],
            ['q' => 'Does it come with a digital state-of-charge gauge?', 'a' => 'Yes, our complete golf cart conversion kits include a round dash-mounted digital battery meter and dedicated high-speed charger.']
        ]
    ],
    'solar' => [
        'title' => 'Solar Batteries',
        'badge' => 'Renewable Energy Storage',
        'subtitle' => 'High-efficiency deep-cycle battery storage for residential solar systems, off-grid arrays, and commercial renewable installations.',
        'banner_img' => '/assets/img/banner2.jpg',
        'highlights' => [
            ['title' => '98% Round-Trip Efficiency', 'desc' => 'Captures virtually every watt generated by your solar panels with minimal conversion losses.'],
            ['title' => '6,000+ Cycle Lifespan', 'desc' => 'Built with Grade-A prismatic EV cells for 15+ years of daily solar cycling.'],
            ['title' => 'Inverter Communication', 'desc' => 'Native CAN and RS485 communication with Victron, Growatt, Sol-Ark, and Deye inverters.'],
            ['title' => 'Modular Scalability', 'desc' => 'Easily scale capacity in parallel up to 16 packs for large residential solar banks.']
        ],
        'faqs' => [
            ['q' => 'Can I expand my solar battery bank later?', 'a' => 'Yes, our solar battery modules are engineered to connect in parallel, allowing you to add more capacity as your power needs grow.'],
            ['q' => 'Which solar inverters are compatible?', 'a' => 'Our batteries communicate directly with Victron, Growatt, Deye, Sol-Ark, Schneider, and all standard 48V/24V solar charge controllers.']
        ]
    ],
    'home-storage' => [
        'title' => 'Home Energy Storage',
        'badge' => 'Residential Backup Power',
        'subtitle' => 'High-capacity home powerwall and rack-mount battery storage providing whole-home blackout protection and peak utility bill reduction.',
        'banner_img' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=2070&q=80',
        'highlights' => [
            ['title' => 'Whole-Home Backup', 'desc' => 'Keeps refrigerators, medical equipment, lights, and WiFi router active during storm blackouts.'],
            ['title' => 'Peak Shaving Savings', 'desc' => 'Store low-cost off-peak power and consume stored energy during costly peak utility hours.'],
            ['title' => 'Ultra-Slim Wall Mount', 'desc' => 'Sleek design fits flush on garage or utility room walls, maximizing floor space.'],
            ['title' => 'Thermal Safety Protections', 'desc' => 'Non-combustible LiFePO4 chemistry with multi-sensor thermal and over-voltage BMS.']
        ],
        'faqs' => [
            ['q' => 'How does a home energy storage battery protect against blackouts?', 'a' => 'During a grid outage, your hybrid inverter automatically switches to battery power in milliseconds, keeping your home running seamlessly.'],
            ['q' => 'Can I use this without solar panels?', 'a' => 'Yes, you can charge the battery from the utility grid during off-peak hours and use stored energy during high-cost peak rates or emergency grid outages.']
        ]
    ],
    'off-grid' => [
        'title' => 'Off-Grid Batteries',
        'badge' => 'Autonomous Power',
        'subtitle' => 'Rugged LiFePO4 and sodium-ion battery banks built for remote cabins, cell towers, telecommunications, and independent off-grid homesteads.',
        'banner_img' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=2070&q=80',
        'highlights' => [
            ['title' => 'Zero Maintenance', 'desc' => 'No acid checking or terminal scrubbing in remote locations miles away from civilization.'],
            ['title' => 'Wide Temperature Range', 'desc' => 'Reliable performance across arctic winter cold and intense summer desert heat.'],
            ['title' => 'High Surge Tolerance', 'desc' => 'Powers high inductive motor start-ups including deep-well water pumps and power tools.'],
            ['title' => '10-Year Field Durability', 'desc' => 'Heavy-gauge steel enclosures built to resist transit vibrations and field conditions.']
        ],
        'faqs' => [
            ['q' => 'How many batteries do I need for an off-grid cabin?', 'a' => 'Most cabins start with a 5kWh to 10kWh bank (1 to 2x 48V 100Ah batteries), easily expandable as your seasonal needs increase.'],
            ['q' => 'Can I leave these unattended during winter?', 'a' => 'Yes, our batteries have ultra-low self-discharge (<2% per month) and can sit safely disconnected during cold winter months.']
        ]
    ],
    'cold-weather' => [
        'title' => 'Cold-Weather Batteries',
        'badge' => 'Sub-Zero Resilience',
        'subtitle' => 'Advanced self-heating LiFePO4 and sodium-ion batteries engineered for dependable starting and deep-cycle performance down to -40°C.',
        'banner_img' => 'https://images.unsplash.com/photo-1517824806704-9040b037703b?auto=format&fit=crop&w=2070&q=80',
        'highlights' => [
            ['title' => 'Full Power at -40°C', 'desc' => 'Sodium-ion and self-heating chemistry operable in freezing snow conditions without capacity loss.'],
            ['title' => 'Automatic Internal Heating', 'desc' => 'Integrated heating pads automatically warm internal cells before charging begins.'],
            ['title' => 'No Cold Thermal Shock', 'desc' => 'Engineered internal cell structures that do not freeze or expand under sub-zero berths.'],
            ['title' => 'Instant Winter Ignition', 'desc' => 'High cold cranking amps ensuring prompt engine starts in arctic winter mornings.']
        ],
        'faqs' => [
            ['q' => 'Can lithium batteries charge in freezing weather?', 'a' => 'Our Cold-Weather series features automatic internal heating elements that warm the cells to safe charging temperatures before accepting charge current.'],
            ['q' => 'Why is Sodium-Ion superior for extreme cold?', 'a' => 'Sodium-ion chemistry naturally maintains full conductivity and rapid discharge even at -40°C without requiring heating pads.']
        ]
    ],
    'sodium-ion' => [
        'title' => 'Sodium-Ion Batteries',
        'badge' => 'Next-Gen Chemistry',
        'subtitle' => 'Revolutionary sustainable sodium-ion batteries featuring ultra-fast 20-minute charging, 0V deep discharge safety, and cobalt-free earth-abundant materials.',
        'banner_img' => '/assets/img/banner3.jpg',
        'highlights' => [
            ['title' => '20-Minute Fast Charging', 'desc' => 'High-rate charging to 80% capacity in approximately 20 minutes with compatible DC sources.'],
            ['title' => '0V Safe Deep Discharge', 'desc' => 'Can be safely discharged down to 0 volts with zero cell degradation or fire hazards.'],
            ['title' => '100% Cobalt & Nickel Free', 'desc' => 'Manufactured with earth-abundant sodium, eliminating scarce rare earth geopolitical supply risks.'],
            ['title' => 'Zero Thermal Runaway', 'desc' => 'Highest thermal safety rating in energy storage technology, safe from thermal runaway.']
        ],
        'faqs' => [
            ['q' => 'What makes Sodium-Ion different from Lithium-Ion?', 'a' => 'Sodium-Ion uses abundant sodium instead of scarce lithium, charges significantly faster, operates down to -40°C, and can be completely discharged to 0V without damage.'],
            ['q' => 'Can Sodium-Ion batteries be transported at 0 Volts?', 'a' => 'Yes! Because sodium cells can be fully discharged to 0V without copper dissolution, they can be shipped completely dead with zero fire risk.']
        ]
    ],
];

$activeMeta = $categoryMeta[$categorySlug] ?? $categoryMeta['marine'];
$categoryTitle = $activeMeta['title'];
$categoryBadge = $activeMeta['badge'];
$categorySubtitle = $activeMeta['subtitle'];
$bannerImg = $activeMeta['banner_img'];
$highlights = $activeMeta['highlights'];
$faqs = $activeMeta['faqs'];

// Filter products matching this category
$categoryProducts = [];
foreach ($all_products as $id => $p) {
    if (in_array($categorySlug, $p['collections'] ?? [])) {
        $categoryProducts[$id] = $p;
    }
}
if (empty($categoryProducts)) {
    $categoryProducts = array_slice($all_products, 0, 3, true);
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categoryTitle) ?> - Cleanergy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/../components/navbar.php';
    ?>

    <!-- 1. Hero Banner with Edge-to-Edge Visual and Breadcrumb -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden bg-slate-900 flex items-center">
        <!-- Background Image Edge-to-Edge -->
        <img src="<?= htmlspecialchars($bannerImg) ?>" 
             alt="<?= htmlspecialchars($categoryTitle) ?> Banner" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/85 via-slate-950/70 to-slate-950/85 sm:bg-gradient-to-r sm:from-slate-950/90 sm:via-slate-900/60 sm:to-transparent"></div>
        <div class="absolute inset-0 bg-black/25"></div>

        <!-- Hero Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 pt-20 sm:pt-32 pb-14 sm:pb-20 flex justify-center sm:justify-start">
            <div class="max-w-3xl flex flex-col items-center sm:items-start text-center sm:text-left">
                <span class="inline-flex items-center text-[10px] sm:text-xs font-bold tracking-[0.2em] text-cyan-300 sm:text-[#38bdf8] uppercase mb-2 sm:mb-3 drop-shadow bg-cyan-950/50 sm:bg-transparent px-3 py-1 sm:p-0 rounded-full border border-cyan-400/20 sm:border-0">
                    <?= htmlspecialchars($categoryBadge) ?>
                </span>
                
                <h1 class="text-2xl xs:text-3xl sm:text-5xl lg:text-6xl text-white leading-[1.15] sm:leading-[1.1] font-extrabold tracking-tight mb-3 sm:mb-5 drop-shadow-md">
                    <span>Premium High-Output</span>
                    <span class="italic font-['Playfair_Display',serif] font-semibold block text-slate-100"><?= htmlspecialchars($categoryTitle) ?></span>
                </h1>

                <p class="text-xs sm:text-base lg:text-lg text-white/90 sm:text-white/95 max-w-xl sm:max-w-2xl font-normal leading-relaxed drop-shadow">
                    <?= htmlspecialchars($categorySubtitle) ?>
                </p>
            </div>
        </div>
    </section>

    <!-- Dedicated Products Grid for this Category -->
    <main id="product-grid" class="flex-1 py-16 sm:py-20 lg:py-24 bg-white text-slate-900 scroll-mt-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#d7f3fb] text-slate-800 text-xs sm:text-sm font-semibold mb-3">
                    Category Catalog
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                    Available <span style="color: #12b3d6;"><?= htmlspecialchars($categoryTitle) ?></span> In Stock
                </h2>
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                    Compare models, capacities, and specifications specifically engineered for this application.
                </p>
            </div>

            <!-- Product Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 items-stretch">
                <?php foreach ($categoryProducts as $prod): ?>
                    <?php
                        $safeTitle = htmlspecialchars($prod['title'], ENT_QUOTES, 'UTF-8');
                        $safeImage = htmlspecialchars($prod['image'], ENT_QUOTES, 'UTF-8');
                        $safePrice = htmlspecialchars($prod['price'], ENT_QUOTES, 'UTF-8');
                        $safeOriginalPrice = htmlspecialchars($prod['original_price'], ENT_QUOTES, 'UTF-8');
                        $detailUrl = '/product-detail.php?id=' . urlencode((string)$prod['id']);
                        $safeDetailUrl = htmlspecialchars($detailUrl, ENT_QUOTES, 'UTF-8');
                        $inStock = (bool)($prod['in_stock'] ?? false);
                    ?>
                    <article class="bg-white rounded-3xl border border-[#239B52] p-4 sm:p-5 flex flex-col justify-between shadow-xs hover:shadow-lg transition-all duration-300 group">
                        <div>
                            <!-- Inner Image Box (Full Size matching Gallery Cards) -->
                            <div class="relative bg-[#f8fafc] rounded-2xl p-2 flex items-center justify-center h-64 sm:h-72 mb-4 overflow-hidden">
                                <!-- Stock Badge (Top Right) -->
                                <span class="absolute top-3 right-3 z-10 inline-flex items-center px-3 py-1 rounded-full text-white text-[11px] font-extrabold uppercase tracking-wide shadow-xs" style="background-color: <?= $inStock ? '#239B52' : '#DC3545' ?>;">
                                    <?= $inStock ? 'IN STOCK' : 'NOT IN STOCK' ?>
                                </span>

                                <!-- Single Centered Clean Product Photo -->
                                <a href="<?= $safeDetailUrl ?>" class="flex items-center justify-center w-full h-full overflow-hidden">
                                    <img src="<?= $safeImage ?>" 
                                         alt="<?= $safeTitle ?>" 
                                         loading="lazy"
                                         class="w-full h-full object-contain p-0 scale-105 transition-transform duration-300 group-hover:scale-115">
                                </a>
                            </div>

                            <!-- Product Title -->
                            <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug mb-2 hover:text-[#239B52] transition-colors">
                                <a href="<?= $safeDetailUrl ?>"><?= $safeTitle ?></a>
                            </h3>

                            <!-- Price Row -->
                            <div class="flex items-baseline gap-2 mb-4">
                                <span class="text-lg sm:text-xl font-extrabold text-[#239B52]"><?= $safePrice ?></span>
                                <span class="text-xs sm:text-sm text-slate-400 line-through"><?= $safeOriginalPrice ?></span>
                            </div>
                        </div>

                        <!-- Buttons Row (Buy Now & Enquiry) -->
                        <div class="flex items-center gap-2.5 mt-auto pt-2">
                            <a href="<?= $safeDetailUrl ?>" class="flex-1 py-2.5 px-4 rounded-full bg-[#239B52] hover:bg-[#1e8244] text-white text-center font-bold text-xs sm:text-sm transition-colors shadow-sm">
                                Buy Now
                            </a>
                            <a href="/index.php#contact" 
                               onclick="openEnquiryModal('<?= htmlspecialchars(addslashes($prod['title'])) ?>', '<?= htmlspecialchars($prod['image']) ?>'); return false;"
                               class="flex-1 py-2.5 px-4 rounded-full border border-[#239B52] text-[#239B52] hover:bg-emerald-50 text-center font-bold text-xs sm:text-sm transition-colors cursor-pointer">
                                Enquiry
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

        </div>
    </main>

    <!-- Category-Specific FAQs -->
    <section class="w-full py-16 sm:py-20" style="background-color: #F3FFF4;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 sm:mb-12 text-center sm:text-left">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#dcfce7] text-[#166534] text-xs sm:text-sm font-semibold mb-3">
                    Category FAQs
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">
                    <?= htmlspecialchars($categoryTitle) ?> FAQs
                </h2>
                <p class="text-slate-600 text-sm sm:text-base">
                    Frequently asked questions about our <?= htmlspecialchars(strtolower($categoryTitle)) ?>.
                </p>
            </div>

            <div id="category-faq-list" class="space-y-4">
                <?php foreach ($faqs as $idx => $faq): ?>
                    <div class="faq-item rounded-2xl bg-transparent overflow-hidden transition-all duration-300" style="border: 1.5px solid #71C179;">
                        <button type="button" onclick="toggleCategoryFaq(this)" class="w-full px-5 py-4 flex items-center justify-between text-left cursor-pointer bg-transparent">
                            <div class="flex items-center gap-3">
                                <span class="text-slate-900 font-bold">→</span>
                                <span class="font-bold text-slate-900 text-sm sm:text-base"><?= htmlspecialchars($faq['q']) ?></span>
                            </div>
                            <svg class="faq-chevron w-5 h-5 text-slate-900 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="faq-content px-5 pb-5 text-slate-600 text-xs sm:text-sm bg-transparent hidden">
                            <p class="pl-6"><?= htmlspecialchars($faq['a']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    // Include Footer
    include __DIR__ . '/../components/footer.php';
    ?>

    <script>
    function toggleCategoryFaq(btn) {
        const currentItem = btn.closest('.faq-item');
        const currentContent = currentItem.querySelector('.faq-content');
        const currentChevron = currentItem.querySelector('.faq-chevron');
        const isCurrentlyOpen = !currentContent.classList.contains('hidden');

        document.querySelectorAll('#category-faq-list .faq-item').forEach(item => {
            const content = item.querySelector('.faq-content');
            const chevron = item.querySelector('.faq-chevron');
            if (content) content.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        });

        if (!isCurrentlyOpen) {
            currentContent.classList.remove('hidden');
            currentChevron.classList.add('rotate-180');
        }
    }
    </script>

</body>
</html>
