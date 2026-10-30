<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battery Knowledge Hub & All Blogs - Cleanergy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/../components/navbar.php';

    // Helper for normalizing image URLs
    function formatImgUrl($url) {
        if (empty($url)) return '/assets/blog-1.png';
        if (preg_match('#^https?://#i', $url)) return $url;
        $clean = ltrim($url, '.');
        if (strpos($clean, '/') !== 0) {
            $clean = '/' . $clean;
        }
        return $clean;
    }

    // Load blogs from data/blogs.json
    $blogsFile = __DIR__ . '/../data/blogs.json';
    $blogs = [];
    if (file_exists($blogsFile)) {
        $blogs = json_decode(file_get_contents($blogsFile), true) ?: [];
    }

    // Fallback if empty
    if (empty($blogs)) {
        $blogs = [
            [
                'id' => '1',
                'image' => '/assets/blog-1.png',
                'date' => 'September 26, 2026',
                'title' => 'How Many Ah Does an RV Battery Need? 100Ah vs 200Ah vs 300Ah LiFePO4 Guide',
                'desc' => 'How many amp-hours does your RV really need? Compare 100Ah, 200Ah and 300Ah LiFePO4 battery setups for weekend travel, appliances, boondocking, solar charging and Michigan camping.',
                'link' => '#blog-1'
            ]
        ];
    }

    // Latest blog is index 0
    $latestBlog = $blogs[0] ?? null;

    // Remaining blogs are index 1 and onward
    $remainingBlogs = array_slice($blogs, 1);
    ?>

    <!-- 1. Hero Banner (Exact Same Size & Dimensions as Homepage Slider) -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden bg-slate-900 flex items-center">
        <!-- Background Image Edge-to-Edge -->
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2070&q=80" 
             alt="Clean Energy Battery Knowledge Hub Banner" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        
        <!-- Gradient Overlay matching Homepage Hero Slider -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-900/50 to-transparent"></div>
        <div class="absolute inset-0 bg-black/20"></div>

        <!-- Banner Content with exact homepage slider padding & layout -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 pt-24 sm:pt-32 pb-14 sm:pb-20">
            <div class="max-w-3xl">
                <span class="inline-block text-[11px] sm:text-sm font-bold tracking-[0.2em] text-[#38bdf8] uppercase mb-2 sm:mb-3 drop-shadow">
                    CLEANERGY KNOWLEDGE HUB
                </span>
                
                <h1 class="text-3xl sm:text-5xl lg:text-[62px] text-white leading-[1.12] sm:leading-[1.1] font-extrabold tracking-tight mb-4 sm:mb-5 drop-shadow-md">
                    <span class="italic block">Powering Your Life with</span>
                    <span class="italic font-['Playfair_Display',serif] font-semibold block text-slate-100">Advanced Battery Guides</span>
                </h1>

                <p class="text-sm sm:text-lg text-white/95 max-w-2xl font-normal leading-relaxed drop-shadow">
                    Practical answers, in-depth comparisons, installation advice and technical insights for marine, RV, solar and off-grid power systems.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Area -->
    <main class="flex-1 py-14 sm:py-18 lg:py-20 bg-white text-slate-900">

        <!-- 2. Knowledge Hub Section: Featured Latest Blog -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 sm:mb-20">
            <!-- Section Header (Centered Heading Only) -->
            <div class="text-center max-w-4xl mx-auto mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight">
                    LiFePO4 &amp; Sodium-Ion Battery Knowledge Hub
                </h2>
            </div>

            <?php if ($latestBlog): ?>
                <!-- Featured / Latest Blog Card (Exact Reference Screenshot Match) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    
                    <!-- Left: Large Featured Image -->
                    <div class="lg:col-span-7 xl:col-span-7 overflow-hidden rounded-xl sm:rounded-2xl">
                        <a href="<?= htmlspecialchars($latestBlog['link']) ?>" class="block w-full">
                            <img src="<?= htmlspecialchars(formatImgUrl($latestBlog['image'])) ?>" 
                                 alt="<?= htmlspecialchars($latestBlog['title']) ?>" 
                                 class="w-full object-cover rounded-xl sm:rounded-2xl hover:opacity-95 transition-opacity"
                                 style="aspect-ratio: 16 / 9.5; max-height: 380px;">
                        </a>
                    </div>

                    <!-- Right: Title, Date, Description (Exact Match with Reference Image) -->
                    <div class="lg:col-span-5 xl:col-span-5 flex flex-col justify-center">
                        <h3 class="text-xl sm:text-2xl lg:text-[25px] font-bold text-slate-900 leading-snug mb-2 hover:text-[#12b3d6] transition-colors">
                            <a href="<?= htmlspecialchars($latestBlog['link']) ?>">
                                <?= htmlspecialchars($latestBlog['title']) ?>
                            </a>
                        </h3>

                        <p class="text-xs sm:text-sm text-slate-500 font-medium mb-4">
                            <?= htmlspecialchars($latestBlog['date']) ?>
                        </p>

                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            <?= htmlspecialchars($latestBlog['desc']) ?>
                        </p>
                    </div>

                </div>
            <?php endif; ?>
        </section>

        <!-- 3. Remaining Blogs Grid Section -->
        <?php if (!empty($remainingBlogs)): ?>
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 items-stretch">
                    <?php foreach ($remainingBlogs as $blog): ?>
                        <article class="bg-white rounded-3xl border border-slate-200/90 hover:border-[#12b3d6] p-5 sm:p-6 flex flex-col justify-between shadow-xs hover:shadow-lg transition-all duration-300 group">
                            <div>
                                <!-- Card Image Container (Full Size matching Gallery Cards) -->
                                <div class="overflow-hidden rounded-2xl mb-4 bg-slate-100 w-full h-64 sm:h-72 shadow-xs">
                                    <a href="<?= htmlspecialchars($blog['link']) ?>" class="block w-full h-full">
                                        <img src="<?= htmlspecialchars(formatImgUrl($blog['image'])) ?>" 
                                             alt="<?= htmlspecialchars($blog['title']) ?>" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    </a>
                                </div>

                                <!-- Date and Tag -->
                                <div class="flex items-center gap-2 text-xs text-slate-500 font-medium mb-2.5">
                                    <span><?= htmlspecialchars($blog['date']) ?></span>
                                </div>

                                <!-- Card Title -->
                                <h4 class="font-bold text-slate-900 text-base sm:text-lg leading-snug mb-2.5 hover:text-[#12b3d6] transition-colors">
                                    <a href="<?= htmlspecialchars($blog['link']) ?>">
                                        <?= htmlspecialchars($blog['title']) ?>
                                    </a>
                                </h4>

                                <!-- Card Description -->
                                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed line-clamp-3">
                                    <?= htmlspecialchars($blog['desc']) ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

    </main>

    <?php
    // Include Footer
    include __DIR__ . '/../components/footer.php';
    ?>

</body>
</html>
