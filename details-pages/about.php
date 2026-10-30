<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Cleanergy Battery | LiFePO4 & Na-Ion Specialists</title>
    <meta name="description" content="Learn about Cleanergy Battery — supplying advanced lithium iron phosphate and sodium-ion battery systems for reliable off-grid, marine, and solar power needs.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">
    <style>
        /* Remove footer margin-top to eliminate white gap */
        footer {
            margin-top: 0 !important;
        }
    </style>
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/../components/navbar.php';
    ?>

    <!-- 1. Hero Banner (Exact Same Size, Image & Layout as All Other Pages) -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden bg-slate-900 flex items-center">
        <!-- Background Image Edge-to-Edge -->
        <img src="/assets/img/banner1.jpg" 
             alt="Clean Energy About Us Banner" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        
        <!-- Gradient Overlay matching Homepage Hero Slider -->
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/80 via-slate-900/50 to-transparent"></div>
        <div class="absolute inset-0 bg-black/20"></div>

        <!-- Banner Content with exact homepage slider padding & layout -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10 pt-24 sm:pt-32 pb-14 sm:pb-20">
            <div class="max-w-3xl">
                <span class="inline-block text-[11px] sm:text-sm font-bold tracking-[0.2em] text-[#38bdf8] uppercase mb-2 sm:mb-3 drop-shadow">
                    CLEANERGY
                </span>
                
                <h1 class="text-3xl sm:text-5xl lg:text-[62px] text-white leading-[1.12] sm:leading-[1.1] font-extrabold tracking-tight mb-4 sm:mb-5 drop-shadow-md">
                    <span class="italic block">About</span>
                    <span class="italic font-['Playfair_Display',serif] font-semibold block text-slate-100">Cleanergy</span>
                </h1>

                <p class="text-sm sm:text-lg text-white/95 max-w-2xl font-normal leading-relaxed drop-shadow">
                    Revolutionizing energy solutions with trusted LiFePO4 battery technology, chargers and smart BMS for over a decade.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Container -->
    <main class="flex-1 w-full bg-white text-slate-900">

        <!-- 2. Section 1: About Cleanergy (Exact PDF Match) -->
        <section class="py-16 sm:py-20 lg:py-24 bg-white text-slate-900">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-start">
                    
                    <!-- Left Column: Pill + Heading + Technician/Harbor Image -->
                    <div class="flex flex-col space-y-8">
                        <div>
                            <!-- Pill Badge -->
                            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#d7f3fb] text-slate-800 text-xs sm:text-sm font-semibold mb-6">
                                About Cleanergy
                            </div>

                            <!-- Main Split-Color Heading -->
                            <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold text-slate-900 leading-[1.3] tracking-tight">
                                Trusted battery technology, chargers and BMS for over a decade. 
                                <span class="text-[#12b3d6]">Safe, durable and built for marine, solar and off-grid use.</span>
                            </h2>
                        </div>

                        <!-- Left Column Image: Power System / Marine Technician -->
                        <div class="overflow-hidden rounded-3xl shadow-lg border border-slate-100">
                            <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?auto=format&fit=crop&w=1000&q=80" 
                                 alt="Cleanergy Battery Technician Working on Power System" 
                                 class="w-full h-[260px] sm:h-[400px] lg:h-[500px] object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>

                    <!-- Right Column: Luxury Yacht Image + 3 Paragraphs + Get a Quote Button -->
                    <div class="flex flex-col space-y-8 lg:pt-2">
                        <!-- Top Image: Luxury Yacht Cruising -->
                        <div class="overflow-hidden rounded-3xl shadow-lg border border-slate-100">
                            <img src="/assets/img/banner2.jpg" 
                                 alt="Luxury Yacht Marine Power Solutions" 
                                 class="w-full h-[220px] sm:h-[280px] lg:h-[320px] object-cover hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- 3 Text Paragraphs matching PDF verbatim -->
                        <div class="space-y-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                            <p>
                                Cleanergy, founded to revolutionize the energy solutions business, has been a trusted source of revolutionary battery technology, Chargers, and Battery Management Systems (BMS).
                            </p>
                            <p>
                                Cleanergy was started in 2009. We want to provide businesses and individuals with creative, sustainable, and high-performing energy solutions that promote growth and efficiency.
                            </p>
                            <p>
                                From cutting-edge Lithium Phosphate and Sodium Ion battery technologies for affordable power for fishing boat / trolling motors, golf cart, RV and Off-grid plus emergency power. Cleanergy is your partner in powering the future.
                            </p>
                        </div>

                        <!-- Action Button: Get a Quote -->
                        <div class="pt-2">
                            <a href="/index.php#contact" 
                               class="inline-flex items-center justify-center px-9 py-3.5 rounded-full text-white font-bold text-sm sm:text-base bg-[#12b3d6] hover:bg-[#0ea5e9] shadow-md shadow-cyan-500/20 transition-all duration-200">
                                Get a Quote
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 3. Section 2: Why Cleanergy (Exact PDF Match) -->
        <section class="py-16 sm:py-20 lg:py-24 bg-white text-slate-900 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                    
                    <!-- Left Column: Golf Carts Fleet Image -->
                    <div class="overflow-hidden rounded-3xl shadow-lg border border-slate-100">
                        <img src="https://images.unsplash.com/photo-1535131749006-b7f58c99034b?auto=format&fit=crop&w=1200&q=80" 
                             alt="Fleet of Green Golf Carts Powered by Cleanergy" 
                             class="w-full h-[380px] sm:h-[460px] lg:h-[520px] object-cover hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Right Column: Pill + Heading + Features + Contact Button -->
                    <div class="flex flex-col">
                        <!-- Pill Badge -->
                        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#d7f3fb] text-slate-800 text-xs sm:text-sm font-semibold w-fit mb-6">
                            Why Cleanergy
                        </div>

                        <!-- Main Split Heading -->
                        <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold text-slate-900 leading-[1.3] tracking-tight mb-4">
                            Advanced Batteries Built for 
                            <span class="text-[#12b3d6]">Reliable, Long-Term Performance</span>
                        </h2>

                        <!-- Description Paragraph -->
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8">
                            We provide application-specific LiFePO4 and sodium-ion battery solutions designed for stable power delivery, long cycle life and demanding operating conditions.
                        </p>

                        <!-- 4 Feature Points with Lightning Bolt -->
                        <div class="space-y-4 sm:space-y-5 mb-10">
                            <div class="flex items-center gap-3.5">
                                <svg class="w-5 h-5 text-slate-950 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/>
                                </svg>
                                <span class="text-slate-900 font-bold text-base sm:text-lg">High Energy Efficiency</span>
                            </div>

                            <div class="flex items-center gap-3.5">
                                <svg class="w-5 h-5 text-slate-950 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/>
                                </svg>
                                <span class="text-slate-900 font-bold text-base sm:text-lg">Application-Specific Design</span>
                            </div>

                            <div class="flex items-center gap-3.5">
                                <svg class="w-5 h-5 text-slate-950 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/>
                                </svg>
                                <span class="text-slate-900 font-bold text-base sm:text-lg">Built for Durability</span>
                            </div>

                            <div class="flex items-center gap-3.5">
                                <svg class="w-5 h-5 text-slate-950 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z"/>
                                </svg>
                                <span class="text-slate-900 font-bold text-base sm:text-lg">Eco-Friendly Technology</span>
                            </div>
                        </div>

                        <!-- Button: Contact Us -->
                        <div>
                            <a href="/contact.php" 
                               class="inline-flex items-center justify-center px-9 py-3.5 rounded-full text-white font-bold text-sm sm:text-base bg-[#12b3d6] hover:bg-[#0ea5e9] shadow-md shadow-cyan-500/20 transition-all duration-200">
                                Contact Us
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- 4. Section 3: Looking to Upgrade from Lead-Acid to LiFePO4? (Full-Width Edge-to-Edge) -->
        <section class="w-full py-16 sm:py-20" style="background-color: #cbf4d8;">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-snug">
                    Looking to Upgrade from <span class="text-[#36954b]">Lead-Acid to LiFePO4?</span>
                </h3>
                <p class="text-slate-700 text-sm sm:text-base lg:text-lg max-w-2xl mx-auto mt-4 mb-8 leading-relaxed font-normal">
                    Explore Cleanergy Battery's advanced LiFePO4 and sodium-ion battery systems designed for reliable power, long service life and demanding applications.
                </p>
                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 sm:gap-6">
                    <a href="/shop.php" 
                       class="inline-flex items-center justify-center px-8 sm:px-10 py-3.5 sm:py-4 rounded-full bg-[#41aa57] hover:bg-[#36954b] text-white font-bold text-sm sm:text-base shadow-sm transition-all duration-200">
                        Shop LiFePO4 Now
                    </a>
                    <a href="/contact.php" 
                       class="inline-flex items-center justify-center px-8 sm:px-10 py-3.5 sm:py-4 rounded-full border-2 border-slate-900 font-bold text-sm sm:text-base text-slate-900 shadow-sm transition-all duration-200 hover:bg-slate-900 hover:text-white">
                        Contact Battery Expert
                    </a>
                </div>
            </div>
        </section>

        <!-- Spacing between Upgrade CTA and FAQ -->
        <div class="w-full py-6 sm:py-8 bg-white"></div>

        <!-- 5. Full-Width FAQ Section (Clean White Background, No Green Tint) -->
        <section class="w-full pt-16 sm:pt-20 pb-12 sm:pb-16 bg-white">
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

    <!-- Product FAQ Single Accordion Toggle (100% Transparent Background) -->
    <script>
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
