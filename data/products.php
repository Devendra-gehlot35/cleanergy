<?php
// Centralized Product Catalog for Cleanergy
// Exact 5 official products from cleanergybattery.com
// Used across shop.php, components/best-selling.php, product-detail.php, and category-page.php

if (!isset($all_collections)) {
    $all_collections = [
        'marine' => [
            'slug' => 'marine',
            'title' => 'Marine Batteries',
            'short_title' => 'Marine',
            'desc' => 'LiFePO4 and sodium-ion battery solutions for boats, marine engines, onboard electronics and reliable power on the water.'
        ],
        'fishing-boat' => [
            'slug' => 'fishing-boat',
            'title' => 'Fishing Boat Batteries',
            'short_title' => 'Fishing Boat',
            'desc' => 'Deep-cycle battery systems for trolling motors, fish finders and extended fishing trips with dependable runtime and reduced maintenance.'
        ],
        'rv' => [
            'slug' => 'rv',
            'title' => 'RV Batteries',
            'short_title' => 'RV & Camper',
            'desc' => 'Lightweight lithium power for RVs and campers, supporting appliances, lighting, off-grid camping and long-distance travel.'
        ],
        'golf-cart' => [
            'slug' => 'golf-cart',
            'title' => 'Golf Cart Batteries',
            'short_title' => 'Golf Cart',
            'desc' => 'High-capacity 48V and 51.2V lithium battery systems designed for dependable golf cart range, power delivery and long service life.'
        ],
        'solar' => [
            'slug' => 'solar',
            'title' => 'Solar Batteries',
            'short_title' => 'Solar',
            'desc' => 'Efficient deep-cycle battery storage for solar energy systems, backup power and renewable energy applications.'
        ],
        'home-storage' => [
            'slug' => 'home-storage',
            'title' => 'Home Energy Storage',
            'short_title' => 'Home Storage',
            'desc' => 'High-capacity battery systems for home backup, solar integration and dependable stored energy when you need it most.'
        ],
        'off-grid' => [
            'slug' => 'off-grid',
            'title' => 'Off-Grid Batteries',
            'short_title' => 'Off-Grid',
            'desc' => 'Reliable LiFePO4 battery systems for cabins, remote sites and independent power setups where consistent energy matters.'
        ],
        'cold-weather' => [
            'slug' => 'cold-weather',
            'title' => 'Cold-Weather Batteries',
            'short_title' => 'Cold Weather',
            'desc' => 'Selected self-heating and sodium-ion battery options designed to support dependable performance in low-temperature conditions.'
        ],
    ];
}

if (!function_exists('normalize_collection_slug')) {
    function normalize_collection_slug($input) {
        $slug = strtolower(trim((string)$input));
        $slug = str_replace([' batteries', ' battery', ' '], ['', '', '-'], $slug);
        
        $aliases = [
            'marine' => 'marine',
            'marine-batteries' => 'marine',
            'fishing' => 'fishing-boat',
            'fishing-boat' => 'fishing-boat',
            'fishing-boat-batteries' => 'fishing-boat',
            'rv' => 'rv',
            'rv-batteries' => 'rv',
            'camper' => 'rv',
            'golf' => 'golf-cart',
            'golf-cart' => 'golf-cart',
            'golf-cart-batteries' => 'golf-cart',
            'solar' => 'solar',
            'solar-batteries' => 'solar',
            'home' => 'home-storage',
            'home-storage' => 'home-storage',
            'home-energy' => 'home-storage',
            'home-energy-storage' => 'home-storage',
            'off-grid' => 'off-grid',
            'offgrid' => 'off-grid',
            'off-grid-batteries' => 'off-grid',
            'cold' => 'cold-weather',
            'cold-weather' => 'cold-weather',
            'cold-weather-batteries' => 'cold-weather',
            'sodium' => 'sodium-ion',
            'sodium-ion' => 'sodium-ion',
            'sodium-ion-batteries' => 'sodium-ion',
        ];
        
        return $aliases[$slug] ?? $slug;
    }
}

if (!isset($all_products)) {
    $all_products = [
        1 => [
            'id' => 1,
            'handle' => 'cranking-sodium-ion-battery',
            'name' => 'Sodium Ion Starting Battery 12V, 200Ah',
            'title' => 'Sodium Ion Starting Battery 12V, 200Ah',
            'category' => 'Sodium - Ion',
            'collections' => ['marine', 'fishing-boat', 'cold-weather', 'sodium-ion', 'off-grid'],
            'desc' => 'The Cranking Sodium Battery is designed for high-demand engines, marine applications, and vehicles that need powerful and dependable cold-weather power.',
            'best_for' => 'Marine starting, vehicles and cold-weather use.',
            'lead_desc' => 'The <strong class="text-slate-900 font-bold">Cranking Sodium Battery</strong> is designed for high-demand engines, marine applications, and other vehicles that need a powerful and dependable power source.',
            'full_desc' => [
                'The Cranking Sodium Battery is designed for high-demand engines, marine applications, and other vehicles that need a powerful and dependable power source.',
                'Weighing only 25 lbs, it is 60% lighter than standard SLA batteries, making it easy to install, especially in applications where weight is critical, like boats.',
                'Provides 200Ah capacity and 2,400Wh energy for sustained performance without sacrificing power. Delivers a stable 12V output with a 14.6V charging voltage, enhancing the performance and lifespan of vehicle systems.',
                'Its compact size and F12 screw-in terminals make it adaptable to various setups, suitable for modern boats, vehicles, and backup power needs.'
            ],
            'price' => '$251.95',
            'price_num' => 251.95,
            'original_price' => '$801.89',
            'old_price' => 801.89,
            'rating' => 4.9,
            'image' => '/assets/img/sodiumIon.png',
            'gallery' => [
                '/assets/img/sodiumIon.png',
            ],
            'in_stock' => true,
            'link' => '/product-detail.php?id=1',
            'specs' => [
                'Model' => 'Cranking Sodium-Ion 12V 200Ah',
                'Nominal Voltage' => '12V',
                'Rated Capacity' => '200Ah',
                'Energy' => '2,400Wh',
                'Cold Cranking Amps (CCA)' => '1300 CCA',
                'Weight' => '25 lbs (60% lighter than SLA)',
                'Charging Voltage' => '14.6V',
                'Continuous Discharge' => '100A',
                'Recommended Charge Current' => '50A or less',
                'Chemistry' => 'Sodium-Ion (Na-Ion) Grade A',
                'Terminals' => 'M8 / F12 Screw-in Terminals',
                'Operating Temperature' => 'Reliable ignition even in frigid sub-zero conditions',
            ],
            'features' => [
                'High Cold Cranking Power: 1300 CCA ensures reliable ignition in frigid conditions.',
                'Lightweight & Easy to Handle: At 25 lbs, it is 60% lighter than standard SLA batteries.',
                'Extended Usage: Provides 200Ah capacity and 2,400Wh energy for sustained performance.',
                'Consistent Voltage: Stable 12V output with 14.6V charging voltage enhances system life.',
                'High Amp Support: Supports continuous charge/discharge up to 100A for demanding systems.',
                'Compact and Versatile: M8 / F12 screw-in terminals provide secure, vibration-proof connections.'
            ],
            'highlights' => [
                'Lightweight & Powerful (25 lbs)',
                'High Cold Cranking Amps (1300 CCA)',
                'Long-Lasting Energy (200Ah / 2,400Wh)',
                'Durable & Cold-Weather Resilient'
            ],
            'applications' => [
                'Marine inboard and outboard engine starting',
                'Vehicles, trucks, and cold-weather starting equipment',
                'Snow and sub-zero temperature equipment starting',
                'Emergency backup power and high-discharge DC starter systems'
            ]
        ],
        2 => [
            'id' => 2,
            'handle' => '51-2-v-300-ah-15-kwh-lithium-battery',
            'name' => '51.2V 300Ah 15.3Kwh Lithium Phosphate Home Power Storage Battery',
            'title' => '51.2V 300Ah 15.3Kwh Lithium Phosphate Home Power Storage Battery',
            'category' => 'Lithium Phosphate',
            'collections' => ['home-storage', 'solar', 'off-grid'],
            'desc' => 'Colorful LCD touch screen and WiFi compatible with most inverters (Victron, Solis, Growatt). Longer 6000~11000 cycle life with built-in aerosol fire suppression.',
            'best_for' => 'Home energy storage, solar backup and off-grid power.',
            'lead_desc' => 'High-capacity 51.2V 300Ah (15.36kWh) energy storage with smart BMS, built-in wheels for mobility, and seamless hybrid solar inverter integration.',
            'full_desc' => [
                'Colorful LCD screen and WiFi compatible with most inverters (e.g. Victron, Solis, Growatt). Longer Life Span: 6,000 ~ 11,000 cycles, 5 years Warranty, Built in intelligent smart BMS, Higher energy density and efficiency, Built-in aerosol fire suppression system.',
                'Easily movable with built-in wheels, offering unmatched convenience. Provides abundant power with 51.2V, 300Ah capacity (15.36kWh), ensuring long-lasting residential energy storage.',
                'Simple installation for seamless integration into residential systems. Equipped with built-in safeguards against overcharging and over-discharging for ultimate safety.',
                'Conveniently monitor battery status and control from anywhere with WiFi, adding a modern touch to your energy management. Delivers consistent and reliable power supply, ensuring uninterrupted performance for your residential needs.'
            ],
            'price' => '$1,792.45',
            'price_num' => 1792.45,
            'original_price' => '$2,358.49',
            'old_price' => 2358.49,
            'rating' => 5.0,
            'image' => '/assets/img/homestorage.png',
            'gallery' => [
                '/assets/img/homestorage.png',
            ],
            'in_stock' => true,
            'link' => '/product-detail.php?id=2',
            'specs' => [
                'Model' => 'EXES-W2 (51.2V 300Ah)',
                'Rated Voltage' => '51.2V',
                'Rated Capacity' => '300Ah',
                'Rated Energy' => '15.36kWh',
                'Output Voltage Range' => '43.2V ~ 58.4V',
                'Charging Voltage' => '57.6V ~ 58.4V',
                'Cut-off Voltage' => '43.2V',
                'Max. Charging Current' => '150A',
                'Recommended Charging Current' => '50A',
                'Max. Discharging Current' => '150A',
                'Efficiency' => '>98%',
                'Dimension L*W*H (mm)' => '820 * 460 * 280 mm',
                'Weight (kg)' => '110 kg',
                'Humidity' => '5% ~ 95% Relative Humidity',
                'Charging Temperature' => '0°C ~ 55°C',
                'Discharging Temperature' => '-20℃ ~ 60℃',
                'Storage Temperature' => '-10℃ ~ 30℃',
                'Cycle Life' => '>6000 times (0.2C, @25℃, 80% DOD), up to 11000 cycles',
                'Design Life' => '>10 years (5 Years Warranty)',
                'Operating Mode' => 'Color LCD Touch Screen & WiFi Remote Monitoring',
                'Safety' => 'Built-in Aerosol Fire Suppression System & Smart BMS',
            ],
            'features' => [
                'Easily movable with built-in wheels, offering unmatched convenience.',
                'Provides abundant power with 51.2V, 300Ah capacity (15.36kWh), ensuring long-lasting energy storage.',
                'Simple installation for seamless integration into residential systems.',
                'Equipped with built-in safeguards against overcharging and over-discharging for ultimate safety.',
                'Conveniently monitor battery status and control from anywhere with WiFi and touch screen.',
                'Built-in aerosol fire suppression system provides top-tier safety against thermal runaway.'
            ],
            'highlights' => [
                'High 15.36kWh Residential Storage Capacity',
                'Built-in Mobility Wheels & Aerosol Fire Suppression',
                'Colorful LCD Touchscreen & WiFi Remote Monitoring',
                'Long Life Span: 6,000 ~ 11,000 Deep Cycles'
            ],
            'applications' => [
                'Residential whole-home solar energy storage and backup',
                'Hybrid and off-grid solar inverter systems (Victron, Solis, Growatt)',
                'Whole-house emergency blackout protection and load shifting',
                'Commercial offices, remote cabins, and telecom power storage'
            ]
        ],
        3 => [
            'id' => 3,
            'handle' => 'lithium-phosphate-48v-52v-105ah-5-460-wh',
            'name' => 'Lithium Phosphate 51.2V 105Ah 5,460Wh',
            'title' => 'Lithium Phosphate 51.2V 105Ah 5,460Wh',
            'category' => 'Lithium Phosphate',
            'collections' => ['golf-cart', 'rv', 'solar', 'off-grid'],
            'desc' => 'High-performance 5,460Wh LiFePO4 battery pack designed for golf carts and RVs, offering lightweight, reliable energy and fire-separation lining.',
            'best_for' => 'Golf carts, RVs and mobile power applications.',
            'lead_desc' => 'The <strong class="text-slate-900 font-bold">Cleanergy Lithium Phosphate 48V-52V 105Ah 5,460Wh</strong> battery is engineered for golf carts, RVs, and off-grid adventures with exceptional safety features.',
            'full_desc' => [
                'The Cleanergy Lithium Phosphate 48V-52V 105Ah 5,460Wh LiFePO4 Deep Cycle Battery Set is designed to provide exceptional performance, dependability, and safety for a variety of applications.',
                'Powered by LiFePO4 technology, this battery boasts exceptional safety features such as fire-separation lining and thermal stability, ensuring safe operation even in extreme temperatures.',
                'The 5,460Wh capacity provides ample power for your golf cart or RV systems, saving downtime and ensuring your energy requirements are satisfied with consistent, long-lasting power.',
                'Built to support: It is waterproof and vibration resistant, making it ideal for marine, solar, and off-grid applications. Whether powering golf carts, RVs, or solar systems, it keeps your gadgets functioning smoothly.'
            ],
            'price' => '$801.89',
            'price_num' => 801.89,
            'original_price' => '$1,084.91',
            'old_price' => 1084.91,
            'rating' => 4.9,
            'image' => '/assets/img/golfcart.webp',
            'gallery' => [
                '/assets/img/golfcart.webp',
            ],
            'in_stock' => true,
            'link' => '/product-detail.php?id=3',
            'specs' => [
                'Product' => 'Lithium Phosphate Battery 48V-52V 105Ah 5,460Wh',
                'Volts' => '48V - 52V (51.2V)',
                'AH' => '105AH (100AH rated)',
                'Cells' => '16S Cells',
                'WH' => '5,460WH',
                'Technology' => 'LiFePO4 (Lithium Iron Phosphate) Grade A',
                'Charge Temperature (Celsius)' => '0℃ ~ +65℃',
                'Discharge Temperature (Celsius)' => '-20℃ ~ +65℃',
                'Dimension (Inches)' => '20 X 12 X 12',
                'Safety' => 'Fire-separation lining & enhanced thermal stability',
                'Weight Advantage' => 'Over 300 lbs lighter than lead-acid battery banks',
            ],
            'features' => [
                '5,460Wh capacity perfect for golf carts and RVs, delivering lightweight and reliable energy.',
                'Equipped with LiFePO4 (Lithium Iron Phosphate) technology for long-lasting and highly efficient power.',
                'Exceptional safety features including fire-separation lining and thermal stability.',
                'Waterproof and vibration resistant, ideal for golf carts, marine, and RV setups.',
                'Energizes any environment with dependable power for all your journeys.'
            ],
            'highlights' => [
                '5,460Wh Capacity Perfect for Golf Carts & RVs',
                'Grade-A LiFePO4 Cell Chemistry',
                'Fire-Separation Lining & Thermal Stability',
                '300+ lbs Lighter Drop-in Replacement'
            ],
            'applications' => [
                'Perfect for golf carts (EZ-GO, Club Car, Yamaha) and utility carts',
                'Ideal for RVs, camper vans, and off-grid mobile living',
                'Off-grid cabins, tiny homes, and solar energy systems',
                'Low-speed commercial and recreational electric vehicles'
            ]
        ],
        4 => [
            'id' => 4,
            'handle' => 'heated-lithium-phosphate-24v-100ah-2400-wh',
            'name' => 'Lithium Phosphate 24V 100Ah 2,400Wh Battery',
            'title' => 'Lithium Phosphate 24V 100Ah 2,400Wh Battery',
            'category' => 'Lithium Phosphate',
            'collections' => ['fishing-boat', 'marine', 'solar', 'rv', 'cold-weather', 'off-grid'],
            'desc' => 'High-performance 24V 100Ah 2,400Wh deep-cycle battery with over 2000 cycles, engineered for trolling motors, fishing boats, and marine power.',
            'best_for' => 'Fishing boats, trolling motors, solar and off-grid systems.',
            'lead_desc' => 'Our <strong class="text-slate-900 font-bold">Lithium Phosphate 24V 100Ah 2,400Wh</strong> battery offers exceptional endurance and safety for marine trolling motors, solar systems, and backup power.',
            'full_desc' => [
                'Advanced LiFePO4 Chemistry: Our Lithium Phosphate 24V 100Ah 2,400Wh battery is powered by LiFePO4 technology, offering exceptional endurance and safety. It is the perfect energy storage solution for marine trolling motors, solar power systems, and backup energy storage.',
                'Deep Cycle Battery: Offering over 2,000 cycles, it ensures longer cycle life, greater thermal stability, and higher safety. The stable chemistry reduces the risk of fire, overheating, and thermal runaway, making it a safer and environmentally friendly alternative to traditional lead-acid batteries.',
                'Wide Temperature Range: This battery operates efficiently in temperatures ranging from -20°C to +65°C during discharge and 0°C to +65°C while charging, making it ideal for use in extreme weather conditions.',
                'Long Lifespan and Low Maintenance: LiFePO4 technology ensures a long lifespan, reducing the need for frequent replacements and lowering overall maintenance costs.'
            ],
            'price' => '$518.87',
            'price_num' => 518.87,
            'original_price' => '$801.89',
            'old_price' => 801.89,
            'rating' => 4.9,
            'image' => '/assets/img/fishingboat.webp',
            'gallery' => [
                '/assets/img/fishingboat.webp',
            ],
            'in_stock' => true,
            'link' => '/product-detail.php?id=4',
            'specs' => [
                'Product' => 'Lithium Phosphate 24V 100Ah 2,400Wh Battery',
                'Volts' => '24V',
                'AH' => '100AH',
                'WH' => '2,400WH',
                'Cells' => '8S Cells',
                'Cycle Life' => 'Over 2,000 Cycles',
                'Charge Temperature (Celsius)' => '0℃ ~ +65℃',
                'Discharge Temperature (Celsius)' => '-20℃ ~ +65℃',
                'Dimension (Inches)' => '20 X 8 X 12',
                'Chemistry' => 'LiFePO4 (Lithium Iron Phosphate)',
                'Safety' => 'Increased safety features for reliable operation',
            ],
            'features' => [
                '2,400Wh capacity delivers high-performance runtime for fishing boat / trolling motors.',
                'Deep cycle battery offering over 2,000 cycles with greater thermal stability and higher safety.',
                'Operates efficiently in temperatures ranging from -20°C to +65°C.',
                'Long lifespan and low maintenance reduces replacement frequency and costs.',
                'Provides efficient performance in diverse and challenging marine and off-grid environments.'
            ],
            'highlights' => [
                '2,400Wh Deep-Cycle Power for 24V Trolling Motors',
                'Over 2,000 Cycles with Enhanced Thermal Stability',
                'Increased Safety Features & Built-in Smart BMS',
                'Wide Temperature Range: -20°C to +65°C'
            ],
            'applications' => [
                '24V fishing boat trolling motors (Minn Kota, Garmin, MotorGuide)',
                'Suitable for RVs, camper vans, and backup power',
                'Perfect for solar power systems and off-grid arrays',
                'Marine electronics, fish finders, and commercial DC setups'
            ]
        ],
        5 => [
            'id' => 5,
            'handle' => 'lithium-phosphate-12v-100ah-1-200wh-battery',
            'name' => 'Lithium Phosphate 12V 100Ah 1,200Wh Battery',
            'title' => 'Lithium Phosphate 12V 100Ah 1,200Wh Battery',
            'category' => 'Lithium Phosphate',
            'collections' => ['marine', 'fishing-boat', 'rv', 'solar', 'off-grid'],
            'desc' => 'Dependable 12V 100Ah 1,200Wh deep-cycle battery with 4000+ cycles, 4S cell structure, and fire-separation lining for boats, RVs, and solar.',
            'best_for' => 'Marine electronics, campers, solar and backup energy.',
            'lead_desc' => 'Introducing the <strong class="text-slate-900 font-bold">Lithium Phosphate 12V 100Ah 1,200Wh</strong> battery – a high-performance, reliable, and safe energy solution for marine trolling motors, RVs, and solar power.',
            'full_desc' => [
                'Wide Temperature Tolerance: Introducing the Lithium Phosphate 12V 100Ah 1,200Wh battery – a high-performance, reliable, and safe energy storage solution designed for a variety of demanding applications, including solar power systems, RVs, and backup energy storage. Performs well with a discharge temperature range of -20°C to +65°C and charging range of 0°C to +65°C.',
                'Long-lasting Performance: The 100Ah capacity and 1,200Wh energy storage deliver steady power over longer periods of time, making it perfect for off-grid applications, marine trolling motors, and other high-demand energy requirements. With its 4S cell structure, it ensures efficient energy distribution and long-term durability.',
                'Eco-friendly and cost-effective: Unlike standard lead-acid batteries, LiFePO4 has a longer lifespan, lowering replacement costs and reducing environmental impact. This battery can be recharged over 4,000 times, giving it a more cost-effective long-term energy source.',
                'Enhanced Safety and Durability: LiFePO4 technology has built-in thermal stability, which reduces hazards of overheating, fire, and thermal runaway. It also has a fire-separation lining, providing the best level of protection. Waterproof and vibration-proof design makes it ideal for outdoor applications from boats to solar installations.'
            ],
            'price' => '$251.85',
            'price_num' => 251.85,
            'original_price' => '$400.94',
            'old_price' => 400.94,
            'rating' => 4.9,
            'image' => '/assets/img/deepcycle.webp',
            'gallery' => [
                '/assets/img/deepcycle.webp',
            ],
            'in_stock' => true,
            'link' => '/product-detail.php?id=5',
            'specs' => [
                'Product' => 'Lithium Phosphate 12V 100Ah 1,200Wh Battery',
                'Volts' => '12V',
                'AH' => '100Ah',
                'WH' => '1,200Wh (1,250Wh Max)',
                'Cells' => '4S Cells',
                'Cycle Life' => '4,000+ Deep Cycles',
                'Charge Temperature (Celsius)' => '0℃ ~ +65℃',
                'Discharge Temperature (Celsius)' => '-20℃ ~ +65℃',
                'Dimension (Inches)' => '13 X 8 X 12',
                'Chemistry' => 'LiFePO4 (Grade A EV Cells)',
                'Safety' => 'Fire-separation lining & built-in thermal stability',
            ],
            'features' => [
                '1,200Wh capacity for dependable electricity for Boat, fishing trolling motor and backup power.',
                'Long-lasting battery life with exceptional thermal stability and top-notch safety features.',
                'Rechargeable over 4,000 times for long-term eco-friendly performance.',
                'Built-in thermal stability and fire-separation lining reduce risks of overheating or thermal runaway.',
                'Waterproof and vibration-proof design ideal for outdoor, marine, and mobile setups.'
            ],
            'highlights' => [
                '1,200Wh Dependable Deep-Cycle Energy',
                '4,000+ Cycles with Steady 12V Voltage Output',
                'Fire-Separation Lining for Top-Notch Safety',
                'Waterproof, Lightweight & Vibration-Proof'
            ],
            'applications' => [
                'Suitable for Boat, fishing trolling motor and backup power',
                'RVs, travel trailers, and camper van living',
                'Solar power systems and off-grid battery banks',
                'Portable power setups and marine onboard electronics'
            ]
        ],
    ];
}

if (!function_exists('get_product_by_id')) {
    function get_product_by_id($id) {
        global $all_products;
        $id = (int)$id;
        return $all_products[$id] ?? $all_products[1];
    }
}
