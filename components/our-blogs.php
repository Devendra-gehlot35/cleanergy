<?php
$blogsFile = __DIR__ . '/../data/blogs.json';
$blogs = [];
if (file_exists($blogsFile)) {
    $blogs = json_decode(file_get_contents($blogsFile), true) ?: [];
}
if (empty($blogs)) {
    $blogs = [
        [
            'id' => '1',
            'image' => './assets/blog-1.png',
            'date' => 'September 26, 2026',
            'title' => 'How Many Ah Does an RV Battery Need? 100Ah vs 200Ah vs 300Ah LiFePO4 Guide',
            'desc' => 'LiFePO4 and sodium-ion battery solutions for boats, marine engines, onboard electronics and reliable power on the water......',
            'link' => '#blog-1'
        ]
    ];
}
?>

<!-- 11. Our Blogs Section -->
<section id="blogs" class="bg-white py-16 sm:py-20 lg:py-24 text-slate-900 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-left mb-10 sm:mb-12">
            <!-- Pill Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#d7f3fb] text-slate-800 text-xs sm:text-sm font-medium mb-4">
                Our Blogs
            </div>

            <!-- Main Heading with Split Color -->
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight mb-3">
                Latest Battery Guides and <span class="text-[#12b3d6]">Technical Insights</span>
            </h2>

            <!-- Subtitle Description -->
            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-3xl">
                Practical answers on sizing, voltage, installation and cold-weather performance.
            </p>
        </div>

        <!-- Blog Cards 3-Column Grid (Latest 3 Blogs) -->
        <?php $homeBlogs = array_slice($blogs, 0, 3); ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 items-stretch mb-12 sm:mb-16">
            <?php foreach ($homeBlogs as $blog): ?>
                <div class="bg-white rounded-3xl p-4 sm:p-5 flex flex-col justify-between transition-all duration-300 hover:shadow-xl hover:-translate-y-1"
                     style="border: 1.5px solid #38bdf8;">
                    
                    <div>
                        <!-- Blog Feature Image (Full Size matching Gallery Cards) -->
                        <div class="overflow-hidden rounded-2xl mb-4 bg-slate-100 h-64 sm:h-72 w-full">
                            <img src="<?= htmlspecialchars($blog['image']) ?>" 
                                 alt="<?= htmlspecialchars($blog['title']) ?>" 
                                 class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Date without Bullet -->
                        <div class="flex items-center gap-2 mb-3 text-[#12b3d6] text-xs sm:text-sm font-semibold">
                            <span><?= htmlspecialchars($blog['date']) ?></span>
                        </div>

                        <!-- Blog Title -->
                        <h3 class="font-bold text-slate-900 text-base sm:text-lg leading-snug mb-3 hover:text-[#12b3d6] transition-colors">
                            <a href="<?= htmlspecialchars($blog['link']) ?>">
                                <?= htmlspecialchars($blog['title']) ?>
                            </a>
                        </h3>

                        <!-- Blog Excerpt / Description -->
                        <p class="text-slate-500 text-xs sm:text-sm leading-relaxed mb-6">
                            <?= htmlspecialchars($blog['desc']) ?>
                        </p>
                    </div>

                    <!-- Read More Button -->
                    <div class="pt-2">
                        <a href="<?= htmlspecialchars($blog['link']) ?>" 
                           class="group inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-[#b8e8f2] hover:bg-[#12b3d6] text-slate-900 hover:text-white font-medium text-xs sm:text-sm transition-all duration-200">
                            <span>Read More</span>
                            <svg class="w-4 h-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- View All Blogs Button (Centered) -->
        <div class="text-center">
            <a href="/blog.php" 
               class="inline-flex items-center justify-center px-10 sm:px-12 py-3.5 sm:py-4 rounded-full text-[#12b3d6] hover:text-white hover:bg-[#12b3d6] font-medium text-base sm:text-lg transition-all duration-200"
               style="border: 1.5px solid #38bdf8;">
                View All Blogs
            </a>
        </div>

    </div>
</section>
