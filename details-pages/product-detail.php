<?php
// Centralized Product Catalog
require_once __DIR__ . '/../data/products.php';

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$product = get_product_by_id($productId);

// Filter similar products (exclude current product)
$similarProducts = array_filter($all_products, function($p) use ($productId) {
    return $p['id'] !== $productId;
});
if (empty($similarProducts)) {
    $similarProducts = $all_products;
}
$similarProducts = array_slice($similarProducts, 0, 4);
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['title']) ?> - Cleanergy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/../components/navbar.php';
    ?>

    <!-- Main Product Detail Container -->
    <main class="flex-1 pt-28 sm:pt-36 pb-16">
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Back Navigation Arrow (Matching PDF) -->
            <div class="mb-6 sm:mb-8">
                <a href="/shop.php" class="inline-flex items-center gap-2 text-slate-600 hover:text-[#239B52] font-semibold text-sm transition-colors group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                    </svg>
                    <span>Back to Shop</span>
                </a>
            </div>

            <!-- Top Product Showcase (2-Column Grid: Image Gallery Left, Product Info Right) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start mb-16 sm:mb-20">
                
                <!-- Left Column: Gallery & Thumbnails (lg: 6 cols) -->
                <div class="lg:col-span-6">
                    <!-- Main Showcase Card -->
                    <div class="relative rounded-3xl p-4 sm:p-6 bg-[#f8fafc] border border-slate-200 flex items-center justify-center h-[280px] sm:h-[420px] lg:h-[500px] overflow-hidden group">
                        
                        <!-- IN STOCK Badge (Top Left - Matching PDF) -->
                        <span class="absolute top-5 left-5 px-3.5 py-1.5 rounded-full text-[11px] font-extrabold uppercase tracking-wider text-white shadow-xs z-10" style="background-color: <?= $product['in_stock'] ? '#239B52' : '#DC3545' ?>;">
                            <?= $product['in_stock'] ? 'IN STOCK' : 'NOT IN STOCK' ?>
                        </span>

                        <!-- Main Image Display (Fills the box completely) -->
                        <img id="main-product-img" 
                             src="<?= htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') ?>" 
                             alt="<?= htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8') ?>" 
                             class="w-full h-full max-h-[440px] sm:max-h-[460px] object-contain transition-transform duration-500 group-hover:scale-105">
                    </div>

                    <!-- 4 Thumbnails -->
                    <div class="grid grid-cols-4 gap-3 sm:gap-4 mt-4 sm:mt-5">
                        <?php foreach ($product['gallery'] as $idx => $gImg): ?>
                            <?php $isFirst = ($idx === 0); ?>
                            <button type="button" onclick="switchImage(this, '<?= htmlspecialchars($gImg, ENT_QUOTES, 'UTF-8') ?>')" 
                                    class="thumb-btn <?= $isFirst ? 'border-2' : 'border border-slate-200 opacity-85 hover:opacity-100' ?> rounded-2xl p-2 bg-white flex items-center justify-center aspect-square shadow-xs transition-all cursor-pointer" 
                                    style="<?= $isFirst ? 'border-color: #239B52;' : '' ?>">
                                <img src="<?= htmlspecialchars($gImg, ENT_QUOTES, 'UTF-8') ?>" alt="Angle <?= $idx + 1 ?>" class="w-full h-full object-contain">
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Right Column: Product Meta, Pricing, Purchase Actions (lg: 6 cols) -->
                <div class="lg:col-span-6 flex flex-col justify-start">
                    
                    <!-- Category Badge (Matching PDF) -->
                    <div class="mb-3">
                        <span class="inline-block px-4 py-1 rounded-full border border-slate-300 text-xs font-semibold text-slate-700 bg-white">
                            <?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </div>

                    <!-- Main Product Heading -->
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight mb-3">
                        <?= htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8') ?>
                    </h1>



                    <!-- Intro Lead Summary -->
                    <div class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                        <?= $product['lead_desc'] ?? htmlspecialchars($product['desc']) ?>
                    </div>

                    <!-- Price Row ($251.95 and Strikethrough) -->
                    <div class="flex items-baseline gap-3 mb-6">
                        <span class="text-3xl sm:text-4xl font-extrabold text-[#239B52]"><?= htmlspecialchars($product['price']) ?></span>
                        <span class="text-lg sm:text-xl text-slate-400 line-through"><?= htmlspecialchars($product['original_price']) ?></span>
                    </div>

                    <!-- Feature Bullet Points with Green Checkmarks -->
                    <div class="space-y-2.5 mb-8">
                        <?php 
                        $prodHighlights = $product['highlights'] ?? [
                            'Lightweight & Powerful',
                            'High Cold Cranking Amps',
                            'Long-Lasting Energy',
                            'Durable Design'
                        ];
                        foreach ($prodHighlights as $hl): 
                        ?>
                            <div class="flex items-center gap-2.5 text-sm font-semibold text-slate-700">
                                <span class="text-[#239B52] font-bold text-base">✓</span>
                                <span><?= htmlspecialchars($hl) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Quantity Counter & Buy Now Row -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 mb-4">
                        <!-- Quantity Pill -->
                        <div class="inline-flex items-center justify-between border border-slate-300 rounded-full px-5 py-3 w-full sm:w-36 text-base font-bold text-slate-800 bg-white">
                            <button type="button" onclick="adjustQty(-1)" class="text-slate-500 hover:text-slate-900 text-xl font-bold cursor-pointer px-1">−</button>
                            <span id="product-qty">1</span>
                            <button type="button" onclick="adjustQty(1)" class="text-slate-500 hover:text-slate-900 text-xl font-bold cursor-pointer px-1">+</button>
                        </div>

                        <!-- Buy Now Button -->
                        <button type="button" onclick="handleBuyNow()" 
                                class="flex-1 py-3.5 px-8 rounded-full text-white font-bold text-sm sm:text-base shadow-sm hover:shadow-md hover:scale-[1.02] transition-all duration-200 text-center cursor-pointer bg-[#239B52] hover:bg-[#1e8244]">
                            Buy Now
                        </button>
                    </div>

                    <!-- Need Help Choosing? Get a Quote -->
                    <a href="/index.php#contact" 
                       onclick="openEnquiryModal('<?= htmlspecialchars(addslashes($product['title'])) ?>', '<?= htmlspecialchars($product['image']) ?>'); return false;"
                       class="block w-full py-3 px-6 rounded-full border border-[#239B52] text-[#239B52] hover:bg-emerald-50 text-center font-semibold text-sm transition-colors mb-4 cursor-pointer">
                        Need help choosing? Get a Quote
                    </a>

                </div>

            </div>

            <!-- Tab Navigation & Content (Description, Specifications, Features, Applications) -->
            <div class="border-t border-slate-100 pt-10 sm:pt-12 mb-16 sm:mb-20">
                <!-- Tab Buttons Row (Touch scrollable on mobile, wrapped on larger screens) -->
                <div class="flex items-center gap-2 sm:gap-3 mb-8 overflow-x-auto scrollbar-none pb-2 sm:flex-wrap">
                    <button type="button" onclick="switchTab(this, 'tab-desc')" 
                            class="tab-btn px-6 py-2 rounded-full text-sm font-bold transition-all cursor-pointer bg-[#dcfce7] text-[#166534]">
                        Description
                    </button>
                    <button type="button" onclick="switchTab(this, 'tab-specs')" 
                            class="tab-btn px-6 py-2 rounded-full text-sm font-semibold transition-all cursor-pointer text-slate-500 hover:text-slate-900">
                        Specifications
                    </button>
                    <button type="button" onclick="switchTab(this, 'tab-features')" 
                            class="tab-btn px-6 py-2 rounded-full text-sm font-semibold transition-all cursor-pointer text-slate-500 hover:text-slate-900">
                        Features
                    </button>
                    <button type="button" onclick="switchTab(this, 'tab-apps')" 
                            class="tab-btn px-6 py-2 rounded-full text-sm font-semibold transition-all cursor-pointer text-slate-500 hover:text-slate-900">
                        Applications
                    </button>
                </div>

                <!-- Tab 1: Description -->
                <div id="tab-desc" class="tab-pane max-w-5xl text-slate-600 text-sm sm:text-base leading-relaxed space-y-4">
                    <?php if (!empty($product['full_desc']) && is_array($product['full_desc'])): ?>
                        <?php foreach ($product['full_desc'] as $descP): ?>
                            <p><?= htmlspecialchars($descP) ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p><?= htmlspecialchars($product['desc']) ?></p>
                    <?php endif; ?>
                </div>

                <!-- Tab 2: Specifications -->
                <div id="tab-specs" class="tab-pane hidden max-w-3xl text-slate-700 text-sm sm:text-base leading-relaxed">
                    <div class="border border-slate-200 rounded-2xl overflow-hidden divide-y divide-slate-100">
                        <?php $sIdx = 0; foreach ($product['specs'] as $specName => $specVal): ?>
                            <div class="flex justify-between py-3 px-4 <?= ($sIdx % 2 === 0) ? 'bg-slate-50' : 'bg-white' ?> font-medium">
                                <span><?= htmlspecialchars($specName) ?></span>
                                <span class="font-bold text-slate-900"><?= htmlspecialchars($specVal) ?></span>
                            </div>
                        <?php $sIdx++; endforeach; ?>
                    </div>
                </div>

                <!-- Tab 3: Features -->
                <div id="tab-features" class="tab-pane hidden max-w-4xl text-slate-600 text-sm sm:text-base leading-relaxed space-y-3">
                    <ul class="list-disc pl-5 space-y-2">
                        <?php foreach ($product['features'] as $feat): ?>
                            <li><?= htmlspecialchars($feat) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tab 4: Applications -->
                <div id="tab-apps" class="tab-pane hidden max-w-4xl text-slate-600 text-sm sm:text-base leading-relaxed space-y-3">
                    <p class="font-bold text-slate-900">Engineered for high-reliability applications including:</p>
                    <ul class="list-disc pl-5 space-y-2.5">
                        <?php 
                        $apps = $product['applications'] ?? [
                            'Marine inboard and outboard engine starting',
                            'Fishing boats and multi-battery trolling motor banks',
                            'Class A, B, and C RV motorhome house and chassis power',
                            'Off-grid solar backup and commercial utility vehicles'
                        ];
                        foreach ($apps as $app): 
                        ?>
                            <li><?= htmlspecialchars($app) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </div>

        <!-- 3. Similar Products Section -->
        <section class="w-full py-16 sm:py-20 mt-10" style="background-color: #f7fdf9;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Section Header -->
                <div class="mb-10 sm:mb-12">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mb-2">
                         LiFePO4 and <span style="color: #239B52;">Sodium Ion Batteries</span> You May Like
                    </h2>

                    <p class="text-slate-600 text-sm sm:text-base max-w-3xl leading-relaxed">
                        Need more power, a different voltage or a deep-cycle option? Explore batteries built for boats, RVs, solar and off-grid use.
                    </p>
                </div>

                <!-- Similar Product Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <?php foreach ($similarProducts as $sim): ?>
                        <?php 
                            $simUrl = '/product-detail.php?id=' . urlencode((string)$sim['id']); 
                            $simInStock = (bool)($sim['in_stock'] ?? false);
                        ?>
                        <div class="bg-white rounded-3xl border border-[#239B52] p-4 flex flex-col justify-between shadow-xs hover:shadow-md transition-all group">
                            <div>
                                <!-- Image with Stock Badge (Full Size matching Gallery Cards) -->
                                <div class="relative bg-[#f8fafc] rounded-2xl overflow-hidden mb-3.5 h-64 sm:h-72 flex items-center justify-center p-2">
                                    <span class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider text-white z-10" style="background-color: <?= $simInStock ? '#239B52' : '#DC3545' ?>;">
                                        <?= $simInStock ? 'IN STOCK' : 'NOT IN STOCK' ?>
                                    </span>
                                    <a href="<?= htmlspecialchars($simUrl) ?>" class="w-full h-full flex items-center justify-center overflow-hidden">
                                        <img src="<?= htmlspecialchars($sim['image']) ?>" 
                                             alt="<?= htmlspecialchars($sim['title']) ?>" 
                                             class="w-full h-full object-contain scale-110 group-hover:scale-120 transition-transform duration-300">
                                    </a>
                                </div>

                                <!-- Title -->
                                <h3 class="text-sm sm:text-base font-bold text-slate-900 leading-snug mb-2 hover:text-[#239B52] transition-colors">
                                    <a href="<?= htmlspecialchars($simUrl) ?>"><?= htmlspecialchars($sim['title']) ?></a>
                                </h3>

                                <!-- Price Row -->
                                <div class="flex items-baseline gap-2 mb-4">
                                    <span class="text-base font-extrabold text-[#239B52]"><?= htmlspecialchars($sim['price']) ?></span>
                                    <span class="text-xs text-slate-400 line-through"><?= htmlspecialchars($sim['original_price']) ?></span>
                                </div>
                            </div>

                            <!-- Buttons: Buy Now & Details -->
                            <div class="flex items-center gap-2 pt-1">
                                <a href="<?= htmlspecialchars($simUrl) ?>" class="flex-1 py-2 px-3 rounded-full text-white text-xs font-bold text-center transition-colors shadow-xs bg-[#239B52] hover:bg-[#1e8244]">
                                    Buy Now
                                </a>
                                <a href="<?= htmlspecialchars($simUrl) ?>" class="flex-1 py-2 px-3 rounded-full border border-[#239B52] text-[#239B52] hover:bg-emerald-50 text-center text-xs font-bold transition-colors">
                                    Details
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </section>

        <!-- Spacing between Similar Products and FAQ -->
        <div class="w-full py-6 sm:py-8 bg-white"></div>

        <!-- 4. Full-Width FAQ Section (#F3FFF4 edge-to-edge) -->
        <section class="w-full py-16 sm:py-20" style="background-color: #F3FFF4;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- FAQ Header -->
                <div class="mb-10 sm:mb-12 text-center sm:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#dcfce7] text-[#166534] text-xs sm:text-sm font-semibold mb-3">
                        FAQs
                    </div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-slate-600 text-sm sm:text-base">
                        Here are the answers to your most asked questions
                    </p>
                </div>

                <div id="product-faq-list" class="space-y-4">
                    
                    <!-- FAQ 1 -->
                    <div class="faq-item rounded-2xl bg-transparent overflow-hidden transition-all duration-300" style="border: 1.5px solid #71C179;">
                        <button type="button" onclick="toggleProductFaq(this)" class="w-full px-5 py-4 flex items-center justify-between text-left cursor-pointer bg-transparent">
                            <div class="flex items-center gap-3">
                                <span class="text-slate-900 font-bold">→</span>
                                <span class="font-bold text-slate-900 text-sm sm:text-base">What is a LiFePO4 battery?</span>
                            </div>
                            <svg class="faq-chevron w-5 h-5 text-slate-900 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="faq-content px-5 pb-5 text-slate-600 text-xs sm:text-sm bg-transparent hidden">
                            <p class="pl-6">LiFePO4 is an advanced lithium chemistry known for long cycle life, high thermal stability, and light weight.</p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="faq-item rounded-2xl bg-transparent overflow-hidden transition-all duration-300" style="border: 1.5px solid #71C179;">
                        <button type="button" onclick="toggleProductFaq(this)" class="w-full px-5 py-4 flex items-center justify-between text-left cursor-pointer bg-transparent">
                            <div class="flex items-center gap-3">
                                <span class="text-slate-900 font-bold">→</span>
                                <span class="font-bold text-slate-900 text-sm sm:text-base">What applications are Cleanergy batteries designed for?</span>
                            </div>
                            <svg class="faq-chevron w-5 h-5 text-slate-900 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="faq-content px-5 pb-5 text-slate-600 text-xs sm:text-sm bg-transparent hidden">
                            <p class="pl-6">Engineered for marine vessels, RVs, solar homes, trolling motors, and backup power.</p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="faq-item rounded-2xl bg-transparent overflow-hidden transition-all duration-300" style="border: 1.5px solid #71C179;">
                        <button type="button" onclick="toggleProductFaq(this)" class="w-full px-5 py-4 flex items-center justify-between text-left cursor-pointer bg-transparent">
                            <div class="flex items-center gap-3">
                                <span class="text-slate-900 font-bold">→</span>
                                <span class="font-bold text-slate-900 text-sm sm:text-base">What is the difference between LiFePO4 and lead-acid batteries?</span>
                            </div>
                            <svg class="faq-chevron w-5 h-5 text-slate-900 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="faq-content px-5 pb-5 text-slate-600 text-xs sm:text-sm bg-transparent hidden">
                            <p class="pl-6">LiFePO4 delivers 5x longer lifespan, 60% less weight, faster charging, and zero maintenance.</p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="faq-item rounded-2xl bg-transparent overflow-hidden transition-all duration-300" style="border: 1.5px solid #71C179;">
                        <button type="button" onclick="toggleProductFaq(this)" class="w-full px-5 py-4 flex items-center justify-between text-left cursor-pointer bg-transparent">
                            <div class="flex items-center gap-3">
                                <span class="text-slate-900 font-bold">→</span>
                                <span class="font-bold text-slate-900 text-sm sm:text-base">What is a Battery Management System (BMS)?</span>
                            </div>
                            <svg class="faq-chevron w-5 h-5 text-slate-900 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="faq-content px-5 pb-5 text-slate-600 text-xs sm:text-sm bg-transparent hidden">
                            <p class="pl-6">An intelligent circuit that protects each cell against overcharging, deep discharge, high temperature, and short circuits.</p>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="faq-item rounded-2xl bg-transparent overflow-hidden transition-all duration-300" style="border: 1.5px solid #71C179;">
                        <button type="button" onclick="toggleProductFaq(this)" class="w-full px-5 py-4 flex items-center justify-between text-left cursor-pointer bg-transparent">
                            <div class="flex items-center gap-3">
                                <span class="text-slate-900 font-bold">→</span>
                                <span class="font-bold text-slate-900 text-sm sm:text-base">How long do LiFePO4 batteries last?</span>
                            </div>
                            <svg class="faq-chevron w-5 h-5 text-slate-900 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div class="faq-content px-5 pb-5 text-slate-600 text-xs sm:text-sm bg-transparent hidden">
                            <p class="pl-6">Depending on usage and operating conditions, LiFePO4 batteries can provide thousands of charge cycles, often lasting several times longer than conventional lead-acid batteries.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <?php
    // Include Footer
    include __DIR__ . '/../components/footer.php';
    ?>

    <!-- Interactive Scripts for Gallery, Tabs, Qty & FAQ -->
    <script>
    // Thumbnail Image Switcher
    function switchImage(btn, src) {
        document.getElementById('main-product-img').src = src;
        document.querySelectorAll('.thumb-btn').forEach(b => {
            b.classList.remove('border-2');
            b.classList.add('border', 'border-slate-200', 'opacity-85');
            b.style.borderColor = '';
        });
        btn.classList.remove('border', 'border-slate-200', 'opacity-85');
        btn.classList.add('border-2');
        btn.style.borderColor = '#12b3d6';
    }

    // Quantity Counter
    let currentQty = 1;
    function adjustQty(delta) {
        currentQty = Math.max(1, currentQty + delta);
        document.getElementById('product-qty').textContent = currentQty;
    }

    // Tabs Switcher
    function switchTab(btn, tabId) {
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('bg-[#dcfce7]', 'text-[#166534]', 'bg-[#cbf1f8]', 'text-slate-900', 'font-bold');
            b.classList.add('text-slate-500', 'font-semibold');
        });
        btn.classList.remove('text-slate-500', 'font-semibold');
        btn.classList.add('bg-[#dcfce7]', 'text-[#166534]', 'font-bold');

        document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('hidden'));
        const activePane = document.getElementById(tabId);
        if (activePane) activePane.classList.remove('hidden');
    }

    // Buy Now Handler
    function handleBuyNow() {
        openEnquiryModal('<?= htmlspecialchars(addslashes($product['title'])) ?>', '<?= htmlspecialchars($product['image']) ?>');
    }
    const handleAddToCart = handleBuyNow;

    // Product FAQ Single Accordion Toggle
    function toggleProductFaq(btn) {
        const currentItem = btn.closest('.faq-item');
        const currentContent = currentItem.querySelector('.faq-content');
        const currentChevron = currentItem.querySelector('.faq-chevron');
        const isCurrentlyOpen = !currentContent.classList.contains('hidden');

        document.querySelectorAll('#product-faq-list .faq-item').forEach(item => {
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
