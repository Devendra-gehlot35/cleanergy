<?php
// Comparison Points Data
$lifepo4_points = [
    'Long-lasting performance with thousands of cycles',
    'Lightweight and easier to install',
    'Higher usable capacity with stable power output',
    'Charges faster with compatible lithium chargers',
    'Low maintenance',
    'Higher energy efficiency',
    'Delivers more consistent voltage during discharge',
    'Higher upfront cost but better long-term value'
];

$lead_acid_points = [
    'Shorter lifespan with fewer charge cycles',
    'Heavy and bulky',
    'Lower usable capacity, especially under heavy load',
    'Slower charging time',
    'May require regular maintenance',
    'Lower energy efficiency',
    'Voltage drops more quickly during use',
    'Lower upfront cost but more frequent replacement'
];
?>

<!-- 8. Battery Upgrade Guide Section (Compact Width) -->
<section id="upgrade-guide" class="bg-white py-14 sm:py-18 text-slate-900 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="text-center max-w-2xl mx-auto mb-10 sm:mb-12">
            <!-- Pill Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#cbf4d8] text-slate-800 text-xs sm:text-sm font-medium mb-4">
                Battery Comparison
            </div>

            <!-- Main Heading with Split Color -->
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight mb-3">
                LiFePO4 vs Lead-Acid Batteries: <span class="text-[#82b89a] font-extrabold">Which Is Better?</span>
            </h2>

            <!-- Subtitle Description -->
            <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
              LiFePO4 batteries offer longer life, lighter weight, faster charging and better usable capacity compared to traditional lead-acid batteries. While lead-acid batteries may cost less upfront, LiFePO4 batteries often provide better long-term value for marine, RV, solar, golf cart and off-grid applications.
            </p>
        </div>

        <!-- 2 Compact Comparison Cards Grid (Narrower Width) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6 max-w-3xl lg:max-w-[760px] mx-auto items-stretch">
            
            <!-- Card 1: LiFePO4 Battery (Green Bordered & Elevated) -->
            <div class="bg-white rounded-3xl border-2 border-[#48bb78] p-5 sm:p-7 shadow-lg shadow-slate-200/50 flex flex-col transition-all duration-300">
                <!-- Card Header -->
                <h3 class="text-lg sm:text-xl font-black text-slate-900 text-center pb-4 border-b border-slate-100 mb-6">
                    LiFePO4 Battery
                </h3>

                <!-- List of Checkmarks -->
                <ul class="space-y-4 sm:space-y-5 flex-1">
                    <?php foreach ($lifepo4_points as $point): ?>
                        <li class="flex items-start gap-3">
                            <!-- Green Checkmark Icon -->
                            <svg class="w-4 h-4 text-[#34a853] shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span class="text-slate-800 text-xs sm:text-sm font-medium leading-snug">
                                <?php echo htmlspecialchars($point); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Card 2: Lead Acid Battery (Subtle Border) -->
            <div class="bg-white rounded-3xl border border-slate-200 hover:border-slate-300 p-5 sm:p-7 shadow-sm flex flex-col transition-all duration-300">
                <!-- Card Header -->
                <h3 class="text-lg sm:text-xl font-black text-slate-900 text-center pb-4 border-b border-slate-100 mb-6">
                    Lead Acid Battery
                </h3>

                <!-- List of Red Crosses -->
                <ul class="space-y-4 sm:space-y-5 flex-1">
                    <?php foreach ($lead_acid_points as $point): ?>
                        <li class="flex items-start gap-3">
                            <!-- Red Cross Icon -->
                            <svg class="w-4 h-4 text-[#ef4444] shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            <span class="text-slate-800 text-xs sm:text-sm font-medium leading-snug">
                                <?php echo htmlspecialchars($point); ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

    </div>
</section>
