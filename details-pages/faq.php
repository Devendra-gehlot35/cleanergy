<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequently Asked Questions | Cleanergy Battery</title>
    <meta name="description" content="Common questions and expert answers about Cleanergy LiFePO4 and sodium-ion batteries, BMS protection, charging, safety, and cold-weather operation.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/../dist/output.css') ?>">
</head>
<body class="bg-white font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/../components/navbar.php';

    // Detailed FAQs List matching official cleanergybattery.com FAQs
    $faqs = [
        [
            'question' => 'What is a LiFePO4 battery?',
            'answer' => 'LiFePO4 (Lithium Iron Phosphate) is an advanced lithium battery chemistry known for superior thermal stability, ultimate fire safety, high discharge efficiency, and up to 10x longer cycle life compared to traditional lead-acid batteries.',
            'is_open' => false
        ],
        [
            'question' => 'Why choose Cleanergy Battery?',
            'answer' => 'Cleanergy Battery delivers premium LiFePO4 and sodium-ion batteries engineered with advanced Battery Management Systems (BMS), high-quality cells, long service life, and reliable performance for demanding applications.',
            'is_open' => false
        ],
        [
            'question' => 'What applications are Cleanergy batteries designed for?',
            'answer' => 'Our batteries are ideal for marine boats, RVs and campers, solar energy systems, off-grid homes, golf carts, backup power, industrial equipment, and commercial energy storage.',
            'is_open' => false
        ],
        [
            'question' => 'What is the difference between LiFePO4 and lead-acid batteries?',
            'answer' => 'LiFePO4 batteries are lighter, charge faster, last significantly longer, require no maintenance, and deliver higher efficiency than traditional lead-acid batteries.',
            'is_open' => false
        ],
        [
            'question' => 'Are Cleanergy batteries safe?',
            'answer' => 'Yes. Our batteries use one of the safest lithium chemistries available and feature an intelligent Battery Management System (BMS) that protects against overcharging, over-discharging, overcurrent, overheating, and short circuits.',
            'is_open' => false
        ],
        [
            'question' => 'What is a Battery Management System (BMS)?',
            'answer' => 'A Battery Management System (BMS) is an electronic protection system that monitors battery voltage, current, and temperature to ensure safe operation and maximize battery lifespan.',
            'is_open' => false
        ],
        [
            'question' => 'Can Cleanergy batteries be used in cold weather?',
            'answer' => 'Yes. Selected models include automatic self-heating technology that warms the battery during charging in freezing conditions, helping maintain safe and efficient performance.',
            'is_open' => false
        ],
        [
            'question' => 'How long do LiFePO4 batteries last?',
            'answer' => 'Depending on usage and operating conditions, LiFePO4 batteries can provide thousands of charge cycles, often lasting several times longer than conventional lead-acid batteries.',
            'is_open' => false
        ],
        [
            'question' => 'Can I replace my lead-acid battery with a LiFePO4 battery?',
            'answer' => 'In most applications, yes. Cleanergy LiFePO4 batteries are designed as a drop-in replacement for many lead-acid batteries while offering improved performance, reduced weight, and longer lifespan.',
            'is_open' => false
        ],
        [
            'question' => 'What battery voltages do you offer?',
            'answer' => 'Cleanergy Battery offers batteries in multiple voltage options, including 12V, 24V, 36V, 48V, and 51.2V systems for residential, commercial, and industrial applications.',
            'is_open' => false
        ],
        [
            'question' => 'Do your batteries support solar energy systems?',
            'answer' => 'Yes. Our LiFePO4 batteries are designed for solar and off-grid energy storage, providing high efficiency, deep-cycle capability, and long-term reliability.',
            'is_open' => false
        ],
        [
            'question' => 'How do I choose the right battery?',
            'answer' => 'The ideal battery depends on your application, required voltage, capacity, discharge rate, and environmental conditions. Our team can help you select the best solution for your specific needs.',
            'is_open' => false
        ]
    ];
    ?>

    <!-- 1. Hero Banner (Natural Image without Blue Overlay) -->
    <section class="relative w-full min-h-[580px] sm:min-h-[660px] h-[92vh] sm:h-screen max-h-[1000px] overflow-hidden flex items-center justify-center text-center bg-slate-900">
        
        <!-- Clean Background Image (No blue tint / overlay) -->
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=2070&q=80" 
             alt="Clean Energy Water Background" 
             class="absolute inset-0 w-full h-full object-cover object-center">
        
        <!-- Subtle Neutral Tint for Clean Text Readability (No blue) -->
        <div class="absolute inset-0 bg-black/25"></div>

        <!-- Big Centered "FAQs" Heading (Exact PDF Match) -->
        <div class="relative z-10 px-4 pt-16">
            <h1 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl font-black text-white tracking-wide drop-shadow-[0_4px_16px_rgba(0,0,0,0.5)]">
                FAQs
            </h1>
        </div>
    </section>

    <!-- 2. FAQ Header (White Background, Centered) -->
    <section class="w-full pt-16 sm:pt-20 pb-10 sm:pb-12 bg-white text-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <!-- Pill Badge (Centered) -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#dcfce7] text-[#166534] text-xs sm:text-sm font-semibold mb-4">
                    FAQs
                </div>

                <!-- Main Heading (Centered) -->
                <h2 class="text-2xl sm:text-3xl lg:text-[40px] font-extrabold text-slate-900 leading-tight tracking-tight mb-4">
                    Expert Answers to Common <br>
                    <span style="color: #92cca3;">Battery Questions</span>
                </h2>

                <!-- Centered Description Under Heading -->
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-2xl mx-auto font-normal">
                    Find answers to common questions about LiFePO4 and sodium-ion batteries, including battery selection, charging, compatibility, maintenance, and performance.
                </p>
            </div>
        </div>
    </section>

    <!-- 3. Full-Width FAQ Section (#F3FFF4 background edge-to-edge) -->
    <section class="w-full py-12 sm:py-16" style="background-color: #F3FFF4;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- FAQ Accordion Items -->
            <div id="faq-accordion-list" class="space-y-4">
                <?php foreach ($faqs as $index => $faq): 
                    $isOpen = !empty($faq['is_open']);
                ?>
                    <div class="faq-item rounded-2xl bg-transparent overflow-hidden transition-all duration-300"
                         style="border: 1.5px solid #71C179;">
                        
                        <!-- Question Button -->
                        <button type="button" 
                                onclick="togglePageFaq(this)"
                                class="w-full px-5 py-4 sm:px-6 sm:py-4.5 flex items-center justify-between text-left cursor-pointer focus:outline-none transition-colors bg-transparent">
                            
                            <div class="flex items-center gap-3 sm:gap-4 pr-3">
                                <!-- Right Arrow Icon -->
                                <svg class="w-5 h-5 text-slate-900 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                                
                                <!-- Question Text -->
                                <span class="font-bold text-slate-900 text-sm sm:text-base lg:text-[16px] leading-snug">
                                    <?= htmlspecialchars($faq['question']) ?>
                                </span>
                            </div>

                            <!-- Down Chevron Icon -->
                            <svg class="faq-chevron w-5 h-5 text-slate-900 shrink-0 transition-transform duration-300 <?= $isOpen ? 'rotate-180' : '' ?>" 
                                 fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Answer Body -->
                        <div class="faq-content px-5 pb-5 sm:px-6 sm:pb-6 text-slate-600 text-xs sm:text-sm leading-relaxed <?= $isOpen ? '' : 'hidden' ?>">
                            <p class="pl-8 sm:pl-9 pt-1">
                                <?= htmlspecialchars($faq['answer']) ?>
                            </p>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>

    <!-- 4. White Space / Gap between FAQ section and Contact Us (chipakana nahi hai) -->
    <div class="w-full py-8 sm:py-12 bg-white"></div>

    <!-- 5. Full-Width Contact Us Section (#EDFAFC background edge-to-edge, NO border) -->
    <section class="w-full py-16 sm:py-20 text-center" style="background-color: #EDFAFC;">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h3 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight mb-3 sm:mb-4">
                Have more questions? <span style="color: #12b3d6;">Contact Us Now!</span>
            </h3>
            
            <p class="text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed mb-8">
                Our team can help you choose the correct voltage, capacity and battery type based on your usage, charging setup and operating conditions.
            </p>

            <div>
                <a href="/contact.php" 
                   class="inline-flex items-center justify-center px-10 py-3.5 rounded-full text-white font-bold text-sm sm:text-base shadow-sm hover:shadow-md hover:scale-105 transition-all duration-200"
                   style="background-color: #12b3d6;">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    <?php
    // Include Footer
    include __DIR__ . '/../components/footer.php';
    ?>

    <!-- Single Open Accordion Logic -->
    <script>
    function togglePageFaq(btn) {
        const currentItem = btn.closest('.faq-item');
        const currentContent = currentItem.querySelector('.faq-content');
        const currentChevron = currentItem.querySelector('.faq-chevron');
        const isCurrentlyOpen = !currentContent.classList.contains('hidden');

        // Close all items first (single accordion)
        document.querySelectorAll('#faq-accordion-list .faq-item').forEach(item => {
            const content = item.querySelector('.faq-content');
            const chevron = item.querySelector('.faq-chevron');
            if (content) content.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        });

        // Toggle clicked item
        if (!isCurrentlyOpen) {
            currentContent.classList.remove('hidden');
            currentChevron.classList.add('rotate-180');
        }
    }
    </script>

</body>
</html>
