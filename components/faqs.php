<?php
// FAQs Data Array (Easily add, edit or remove questions and answers)
$faqs = [
    [
        'question' => 'What is a LiFePO4 battery?',
        'answer' => 'LiFePO4 (Lithium Iron Phosphate) is an advanced lithium battery chemistry known for superior thermal stability, ultimate fire safety, high discharge efficiency, and up to 10x longer cycle life compared to traditional lead-acid batteries.',
        'is_open' => false,
    ],
    [
        'question' => 'Why choose Cleanergy Battery?',
        'answer' => 'Cleanergy Batteries are built with Grade-A prismatic cells, intelligent BMS protection, high continuous discharge rates, and rugged casings built for demanding marine, RV, and off-grid conditions.',
        'is_open' => false,
    ],
    [
        'question' => 'What applications are Cleanergy batteries designed for?',
        'lead' => 'Our batteries are ideal for:',
        'column1' => [
            'Marine boats',
            'RVs and campers',
            'Solar energy systems',
        ],
        'column2' => [
            'Off-grid homes',
            'Golf carts',
            'Backup power',
            'Industrial equipment',
            'Commercial energy storage',
        ],
        'is_open' => false,
    ],
    [
        'question' => 'What is the difference between LiFePO4 and lead-acid batteries?',
        'answer' => 'LiFePO4 batteries deliver up to 5 times longer cycle life, are 60% lighter, maintain full voltage until fully depleted, charge 4 times faster, and require zero maintenance or fluid refills.',
        'is_open' => false,
    ]
];
?>

<!-- 12. FAQs Section -->
<section id="faqs" class="bg-white py-16 sm:py-20 lg:py-24 text-slate-900 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">
            
            <!-- Left Column: Header + Accordion List (7 cols on lg) -->
            <div class="lg:col-span-7 flex flex-col">
                
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#cbf4d8] text-slate-800 text-xs sm:text-sm font-medium w-fit mb-4">
                    FAQs
                </div>

                <!-- Main Heading -->
                <h2 class="text-2xl sm:text-3xl lg:text-[34px] font-extrabold text-slate-900 leading-[1.25] tracking-tight mb-2">
                    Expert Answers to Common <br>
                    <span class="text-[#8bbd9f]">Battery Questions</span>
                </h2>

                <!-- Subtitle Description -->
                <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-8 sm:mb-10">
                    Here are the answers to your most asked questions
                </p>

                <!-- FAQ Accordion Loop -->
                <div class="space-y-4 sm:space-y-5">
                    <?php foreach ($faqs as $index => $faq): 
                        $isOpen = !empty($faq['is_open']);
                    ?>
                        <div class="faq-item rounded-2xl sm:rounded-3xl border border-[#48bb78] overflow-hidden transition-all duration-300 bg-transparent"
                             style="border: 1.5px solid #48bb78;">
                            
                            <!-- Question Button -->
                            <button type="button" 
                                    onclick="toggleFaq(this)"
                                    class="w-full px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between text-left cursor-pointer focus:outline-none transition-colors">
                                
                                <div class="flex items-center gap-3 sm:gap-4 pr-3">
                                    <!-- Right Arrow Icon -->
                                    <svg class="w-5 h-5 text-slate-900 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                    
                                    <!-- Question Text -->
                                    <span class="font-bold text-slate-900 text-sm sm:text-base lg:text-[17px] leading-snug">
                                        <?= htmlspecialchars($faq['question']) ?>
                                    </span>
                                </div>

                                <!-- Chevron Icon (Down or Up) -->
                                <svg class="faq-chevron w-5 h-5 text-slate-900 shrink-0 transition-transform duration-300 <?= $isOpen ? 'rotate-180' : '' ?>" 
                                     fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Answer Body -->
                            <div class="faq-content px-5 pb-5 sm:px-6 sm:pb-6 text-slate-700 text-sm sm:text-base leading-relaxed <?= $isOpen ? '' : 'hidden' ?>">
                                <?php if (!empty($faq['column1']) || !empty($faq['column2'])): ?>
                                    <!-- 2-Column List Layout -->
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                                        <div>
                                            <?php if (!empty($faq['lead'])): ?>
                                                <p class="font-medium text-slate-800 mb-2.5"><?= htmlspecialchars($faq['lead']) ?></p>
                                            <?php endif; ?>
                                            <ul class="space-y-1.5 text-slate-700">
                                                <?php foreach ($faq['column1'] as $point): ?>
                                                    <li class="flex items-center gap-2">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-800 shrink-0"></span>
                                                        <span><?= htmlspecialchars($point) ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <div>
                                            <ul class="space-y-1.5 text-slate-700 sm:pt-7">
                                                <?php foreach ($faq['column2'] as $point): ?>
                                                    <li class="flex items-center gap-2">
                                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-800 shrink-0"></span>
                                                        <span><?= htmlspecialchars($point) ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <!-- Standard Paragraph Answer -->
                                    <p class="pt-1">
                                        <?= htmlspecialchars($faq['answer'] ?? '') ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Right Column: Vertical Yacht & Battery Image (5 cols on lg) -->
            <div class="lg:col-span-5 flex">
                <div class="overflow-hidden rounded-3xl shadow-lg border border-slate-100 w-full h-full">
                    <img src="./assets/yacht-faq.png" 
                         alt="Cleanergy Marine Power and LiFePO4 Battery" 
                         class="w-full h-full min-h-[260px] sm:min-h-[380px] lg:min-h-[580px] object-cover hover:scale-105 transition-transform duration-500">
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Vanilla JS for Accordion Interaction -->
<script>
function toggleFaq(btn) {
    const currentItem = btn.closest('.faq-item');
    const currentContent = currentItem.querySelector('.faq-content');
    const currentChevron = currentItem.querySelector('.faq-chevron');
    const isCurrentlyOpen = !currentContent.classList.contains('hidden');

    // Close all FAQ items first
    document.querySelectorAll('#faqs .faq-item').forEach(item => {
        const content = item.querySelector('.faq-content');
        const chevron = item.querySelector('.faq-chevron');
        if (content) content.classList.add('hidden');
        if (chevron) chevron.classList.remove('rotate-180');
    });

    // If the clicked item was previously closed, open it
    if (!isCurrentlyOpen) {
        currentContent.classList.remove('hidden');
        currentChevron.classList.add('rotate-180');
    }
}
</script>
