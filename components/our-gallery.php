<?php
// Gallery Items Array (Easily add, edit or remove gallery photos)
$gallery_items = [
    [
        'title' => 'Marine & Yacht Battery Storage',
        'category' => 'Marine Setup',
        'image' => '/assets/img/banner2.jpg',
        'alt' => 'Cleanergy Marine Boat LiFePO4 Battery Setup',
    ],
    [
        'title' => 'RV & Camper Off-Grid Solar Power',
        'category' => 'RV & Off-Grid',
        'image' => '/assets/img/blog-rv-battery.webp',
        'alt' => 'Cleanergy RV and Solar Off-Grid Power Setup',
    ]
];
?>

<!-- 13. Our Gallery Section -->
<section id="gallery" class="bg-[#f6fcfd] py-16 sm:py-20 lg:py-24 text-slate-900 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        <!-- Header Section -->
        <div class="mb-10 sm:mb-14">
            <!-- Pill Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#d7f3fb] text-slate-800 text-xs sm:text-sm font-medium mb-4">
                Our Gallery
            </div>

            <!-- Main Heading with Split Color -->
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight mb-3">
                <span class="text-[#12b3d6]">See Cleanergy</span> in Action
            </h2>

            <!-- Subtitle Description -->
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto">
                See how Cleanergy batteries perform across marine, RV and home storage setups.
            </p>
        </div>

        <!-- 2-Column Gallery Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 mb-12 sm:mb-14 items-stretch">
            <?php foreach ($gallery_items as $item): ?>
                <div class="group relative overflow-hidden rounded-[28px] sm:rounded-[36px] shadow-sm bg-slate-200 h-[280px] sm:h-[360px] lg:h-[420px] transition-all duration-300 hover:shadow-xl">
                    <!-- Image -->
                    <img src="<?= htmlspecialchars($item['image']) ?>" 
                         alt="<?= htmlspecialchars($item['alt']) ?>" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    
                    <!-- Subtle Dark Gradient Overlay for Readability -->
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-slate-950/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300"></div>

                    <!-- Bottom Caption Content -->
                    <div class="absolute bottom-6 left-6 right-6 sm:bottom-8 sm:left-8 sm:right-8 text-left text-white">
                        <span class="inline-block px-3.5 py-1 rounded-full bg-[#12b3d6] text-white text-xs font-semibold mb-2 shadow-sm">
                            <?= htmlspecialchars($item['category']) ?>
                        </span>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold leading-snug drop-shadow-sm">
                            <?= htmlspecialchars($item['title']) ?>
                        </h3>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Explore Gallery Action Button -->
        <div class="text-center">
            <a href="/gallery.php" 
               class="inline-flex items-center justify-center px-10 sm:px-12 py-3.5 sm:py-4 rounded-full text-white font-medium text-base sm:text-lg bg-[#12b3d6] hover:bg-[#0ea5e9] shadow-md shadow-cyan-500/20 transition-all duration-200">
                Explore Gallery
            </a>
        </div>

    </div>
</section>
