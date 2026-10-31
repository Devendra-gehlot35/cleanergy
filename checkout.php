<?php
// Centralized Product Catalog
require_once __DIR__ . '/data/products.php';

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$product = get_product_by_id($productId);
$initialQty = isset($_GET['qty']) ? max(1, (int)$_GET['qty']) : 1;

// Base numeric price
$unitPrice = isset($product['price_num']) ? (float)$product['price_num'] : 251.95;
$originalUnitPrice = isset($product['old_price']) ? (float)$product['old_price'] : 801.89;
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now - <?= htmlspecialchars($product['title']) ?> | Cleanergy Battery</title>
    <meta name="description" content="Order <?= htmlspecialchars($product['title']) ?> directly with verified shipping address and zero upfront payment required.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&family=Playfair+Display:ital,wght@1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/dist/output.css') ?>">
</head>
<body class="bg-[#F8FAFC] font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/components/navbar.php';
    ?>

    <!-- Main Container -->
    <main class="flex-1 pt-24 sm:pt-32 pb-16 lg:pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- ==========================================
                 TOP ADDRESS & DISPATCH INFORMATION BANNER
            =========================================== -->
            <div class="mb-8 rounded-2xl sm:rounded-3xl bg-white border border-slate-200/80 shadow-sm p-4 sm:p-6 lg:p-7">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 sm:gap-6">
                    
                    <!-- Left: Dispatch Hub & Address -->
                    <div class="flex items-start gap-3.5 sm:gap-4">
                        <div class="w-11 h-11 sm:w-13 sm:h-13 rounded-2xl bg-[#EDFAFC] border border-[#a2d2df]/60 flex items-center justify-center shrink-0 text-[#12b3d6]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap mb-1">
                                <span class="text-xs font-bold uppercase tracking-wider text-[#12b3d6] bg-[#d7f3fb]/60 px-2.5 py-0.5 rounded-full">
                                    Official Fulfillment Center
                                </span>
                                <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Open & Dispatching Today
                                </span>
                            </div>
                            <h2 class="text-base sm:text-lg font-bold text-slate-900 leading-tight">
                                Cleanergy Battery Headquarters & Main Warehouse
                            </h2>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 flex flex-wrap items-center gap-x-2 gap-y-1">
                                <span class="font-medium text-slate-800">4750 Venture Drive, Suite 400, Ann Arbor, MI 48108, USA</span>
                                <span class="hidden sm:inline text-slate-300">•</span>
                                <a href="tel:+17347875246" class="text-[#0e7490] hover:underline font-semibold flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                                    </svg>
                                    +1 (734) 787-5246
                                </a>
                                <span class="hidden sm:inline text-slate-300">•</span>
                                <a href="mailto:support@cleanergybattery.com" class="text-slate-600 hover:text-cyan-600">
                                    support@cleanergybattery.com
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Right: Quick Guarantees Badges -->
                    <div class="flex items-center gap-3 self-start lg:self-center border-t lg:border-t-0 pt-3 lg:pt-0 border-slate-100 text-xs text-slate-600">
                        <div class="flex items-center gap-1.5 font-semibold text-slate-700 bg-slate-50 px-3 py-2 rounded-xl border border-slate-100">
                            <svg class="w-4 h-4 text-[#239B52]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Free Freight Shipping
                        </div>
                        <div class="flex items-center gap-1.5 font-semibold text-slate-700 bg-slate-50 px-3 py-2 rounded-xl border border-slate-100">
                            <svg class="w-4 h-4 text-[#239B52]" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            10-Yr Warranty
                        </div>
                    </div>

                </div>
            </div>

            <!-- Back to Shop / Details Link -->
            <div class="mb-6 flex items-center justify-between">
                <a href="<?= htmlspecialchars($product['link'] ?? '/shop.php') ?>" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-cyan-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                    </svg>
                    <span>Back to <?= htmlspecialchars($product['title']) ?></span>
                </a>
                <span class="text-xs font-semibold text-slate-500">Step 1 of 1: Order Details</span>
            </div>

            <!-- ==========================================
                 MAIN CHECKOUT FORM & SUMMARY GRID
            =========================================== -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
                
                <!-- LEFT COLUMN: Address & Customer Inputs (7 Cols) -->
                <div class="lg:col-span-7 flex flex-col gap-6">
                    
                    <form id="checkout-form" onsubmit="handlePlaceOrder(event)" class="space-y-6">
                        
                        <!-- 1. Customer Information Card -->
                        <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm p-5 sm:p-7">
                            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                                <span class="w-7 h-7 rounded-full bg-[#d7f3fb] text-[#0e7490] font-bold text-xs flex items-center justify-center">1</span>
                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Customer Information</h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        First Name <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" id="first_name" name="first_name" required placeholder="John"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Last Name <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" id="last_name" name="last_name" required placeholder="Smith"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                </div>

                                <div>
                                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Email Address <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email" required placeholder="john.smith@example.com"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                    <p class="text-[11px] text-slate-500 mt-1">We'll send order invoice & freight tracking link here.</p>
                                </div>

                                <div>
                                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Phone Number <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="tel" id="phone" name="phone" required placeholder="+1 (734) 555-0199"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                    <p class="text-[11px] text-slate-500 mt-1">Required for freight carrier delivery appointment.</p>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Shipping & Delivery Address Card -->
                        <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm p-5 sm:p-7">
                            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                                <span class="w-7 h-7 rounded-full bg-[#d7f3fb] text-[#0e7490] font-bold text-xs flex items-center justify-center">2</span>
                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Delivery & Shipping Address</h3>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="street_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Street Address <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" id="street_address" name="street_address" required placeholder="e.g. 123 Harbor View Road"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                </div>

                                <div>
                                    <label for="apartment" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Apartment, Suite, Unit, Slip # <span class="text-slate-400 font-normal">(Optional)</span>
                                    </label>
                                    <input type="text" id="apartment" name="apartment" placeholder="e.g. Marina Dock B, Slip #14 or Suite 200"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <label for="city" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                            City <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text" id="city" name="city" required placeholder="Miami"
                                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                    </div>

                                    <div>
                                        <label for="state" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                            State / Province <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text" id="state" name="state" required placeholder="Florida (FL)"
                                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                    </div>

                                    <div>
                                        <label for="zip" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                            ZIP / Postal Code <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text" id="zip" name="zip" required placeholder="33101"
                                               class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all">
                                    </div>
                                </div>

                                <div>
                                    <label for="country" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Country <span class="text-rose-500">*</span>
                                    </label>
                                    <select id="country" name="country" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all bg-white">
                                        <option value="United States" selected>United States (USA)</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Other">Other International Destination</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Battery Application & Special Delivery Instructions -->
                        <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm p-5 sm:p-7">
                            <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                                <span class="w-7 h-7 rounded-full bg-[#d7f3fb] text-[#0e7490] font-bold text-xs flex items-center justify-center">3</span>
                                <h3 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Application & Delivery Notes</h3>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label for="application_type" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Where will you use this battery? <span class="text-slate-400 font-normal">(Helps us configure proper BMS settings)</span>
                                    </label>
                                    <select id="application_type" name="application_type" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all bg-white">
                                        <option value="Marine Boat / Yacht">Marine Boat / Yacht</option>
                                        <option value="Fishing Boat (Trolling Motor)">Fishing Boat (Trolling Motor)</option>
                                        <option value="RV / Motorhome / Camper">RV / Motorhome / Camper</option>
                                        <option value="Golf Cart (Club Car / EZ-GO / Yamaha)">Golf Cart (Club Car / EZ-GO / Yamaha)</option>
                                        <option value="Solar Energy Storage">Solar Energy Storage</option>
                                        <option value="Home Backup Power">Home Backup Power</option>
                                        <option value="Off-Grid Cabin / Site">Off-Grid Cabin / Site</option>
                                        <option value="Commercial / Other">Commercial / Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="delivery_notes" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                        Delivery Instructions / Gate Code / Liftgate Needs <span class="text-slate-400 font-normal">(Optional)</span>
                                    </label>
                                    <textarea id="delivery_notes" name="delivery_notes" rows="3" placeholder="e.g. Residential driveway, liftgate truck required, or gate code #4921."
                                              class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-900 text-sm focus:border-[#12b3d6] focus:ring-2 focus:ring-[#12b3d6]/20 outline-none transition-all resize-none"></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Zero Payment Notice & Confirmation Card -->
                        <div class="bg-[#EDFAFC] border border-[#a2d2df] rounded-2xl sm:rounded-3xl p-5 sm:p-7">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-white border border-[#a2d2df] flex items-center justify-center shrink-0 text-[#12b3d6]">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm sm:text-base font-bold text-slate-900">
                                        Zero Upfront Payment Required Today
                                    </h4>
                                    <p class="text-xs sm:text-sm text-slate-700 mt-1 leading-relaxed">
                                        By clicking <strong class="text-slate-900">Place Order</strong>, you register your order with our Ann Arbor fulfillment center. Our logistics team will verify stock, check the shipping address, and contact you directly with final delivery confirmation.
                                    </p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="mt-6 pt-5 border-t border-[#a2d2df]/60 flex flex-col sm:flex-row items-center gap-3">
                                <button type="submit" id="place-order-btn"
                                        class="w-full sm:flex-1 py-4 px-8 rounded-full text-white font-extrabold text-base sm:text-lg bg-[#239B52] hover:bg-[#1e8244] shadow-lg shadow-emerald-600/25 transition-all text-center cursor-pointer active:scale-98">
                                    Place Order / Confirm Details
                                </button>
                                <span class="text-xs text-slate-500 font-medium text-center sm:text-left">
                                    🔒 256-Bit SSL Encrypted & Confidential
                                </span>
                            </div>
                        </div>

                    </form>

                </div>

                <!-- RIGHT COLUMN: Order Summary & Live Price Calculation (5 Cols) -->
                <div class="lg:col-span-5 flex flex-col gap-6 lg:sticky lg:top-24">
                    
                    <!-- Selected Product Box -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm p-5 sm:p-7">
                        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
                            <h3 class="text-base sm:text-lg font-extrabold text-slate-900 tracking-tight">Order Summary</h3>
                            <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">
                                In Stock
                            </span>
                        </div>

                        <!-- Product Mini Card -->
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-slate-50 border border-slate-100 p-2 shrink-0 flex items-center justify-center overflow-hidden">
                                <img id="order-product-img" 
                                     src="<?= htmlspecialchars($product['image']) ?>" 
                                     alt="<?= htmlspecialchars($product['title']) ?>" 
                                     class="w-full h-full object-contain">
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="inline-block text-[10px] font-bold tracking-wider text-[#12b3d6] uppercase mb-1">
                                    <?= htmlspecialchars($product['category'] ?? 'Deep Cycle Battery') ?>
                                </span>
                                <h4 class="text-sm sm:text-base font-bold text-slate-900 leading-snug line-clamp-2">
                                    <?= htmlspecialchars($product['title']) ?>
                                </h4>
                                
                                <div class="flex items-baseline gap-2 mt-2">
                                    <span class="text-base sm:text-lg font-black text-[#239B52]" id="unit-price-display">
                                        $<?= number_format($unitPrice, 2) ?>
                                    </span>
                                    <span class="text-xs text-slate-400 line-through">
                                        $<?= number_format($originalUnitPrice, 2) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Quantity Selector Control -->
                        <div class="flex items-center justify-between p-3.5 rounded-2xl bg-slate-50 border border-slate-100 mb-6">
                            <span class="text-xs sm:text-sm font-bold text-slate-700">Select Quantity:</span>
                            
                            <div class="inline-flex items-center gap-3 bg-white border border-slate-200 rounded-full px-3 py-1.5 shadow-2xs">
                                <button type="button" onclick="changeOrderQty(-1)" aria-label="Decrease quantity"
                                        class="w-7 h-7 rounded-full text-slate-600 hover:text-slate-900 hover:bg-slate-100 flex items-center justify-center font-bold text-base cursor-pointer">
                                    −
                                </button>
                                <span id="checkout-qty" class="text-sm font-black text-slate-900 w-6 text-center"><?= $initialQty ?></span>
                                <button type="button" onclick="changeOrderQty(1)" aria-label="Increase quantity"
                                        class="w-7 h-7 rounded-full text-slate-600 hover:text-slate-900 hover:bg-slate-100 flex items-center justify-center font-bold text-base cursor-pointer">
                                    +
                                </button>
                            </div>
                        </div>

                        <!-- Price Breakdown Rows -->
                        <div class="space-y-3 text-sm border-t border-slate-100 pt-5">
                            <div class="flex justify-between text-slate-600">
                                <span>Subtotal (<span id="summary-qty-label"><?= $initialQty ?></span> item<span id="summary-qty-plural"><?= $initialQty > 1 ? 's' : '' ?></span>)</span>
                                <span class="font-bold text-slate-900" id="summary-subtotal">$<?= number_format($unitPrice * $initialQty, 2) ?></span>
                            </div>

                            <div class="flex justify-between text-slate-600">
                                <span class="flex items-center gap-1.5">
                                    Freight Shipping
                                    <span class="text-[10px] bg-emerald-50 text-emerald-700 font-bold px-1.5 py-0.5 rounded">Special Promo</span>
                                </span>
                                <span class="font-bold text-emerald-600">FREE</span>
                            </div>

                            <div class="flex justify-between text-slate-600">
                                <span>Estimated Sales Tax</span>
                                <span class="font-bold text-slate-900">$0.00</span>
                            </div>

                            <div class="flex justify-between text-slate-600">
                                <span>BMS Protection Package</span>
                                <span class="font-bold text-emerald-600">Included</span>
                            </div>

                            <!-- Total -->
                            <div class="flex justify-between items-baseline pt-4 border-t border-slate-200">
                                <div>
                                    <span class="text-base font-extrabold text-slate-900 block">Total Due:</span>
                                    <span class="text-[11px] text-slate-500">Payable after delivery schedule verification</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-2xl sm:text-3xl font-black text-[#239B52]" id="summary-total">
                                        $<?= number_format($unitPrice * $initialQty, 2) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Trust Points Card -->
                    <div class="bg-white rounded-2xl sm:rounded-3xl border border-slate-200/80 shadow-sm p-5 sm:p-6 space-y-3.5">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Why Buy Directly from Cleanergy:</h4>
                        
                        <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-700">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                ✓
                            </div>
                            <span>10-Year Manufacturer Warranty on all cells & BMS</span>
                        </div>

                        <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-700">
                            <div class="w-8 h-8 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                                ✓
                            </div>
                            <span>Free Freight Delivery with Liftgate Support (USA & Canada)</span>
                        </div>

                        <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-700">
                            <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                ✓
                            </div>
                            <span>30-Day Money-Back Guarantee if not 100% satisfied</span>
                        </div>

                        <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-700">
                            <div class="w-8 h-8 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                                ✓
                            </div>
                            <span>Direct technical support from our engineers in Michigan</span>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

    <!-- ==========================================
         ORDER SUCCESS CONFIRMATION MODAL
    =========================================== -->
    <div id="order-success-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4 bg-slate-950/75 backdrop-blur-sm transition-all duration-300">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 text-center shadow-2xl border border-slate-100 transform transition-all">
            
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
            </div>

            <span class="inline-block px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-wider mb-2">
                Order Request Received
            </span>

            <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mb-2">
                Thank You for Your Order!
            </h3>

            <p class="text-slate-600 text-sm mb-5 leading-relaxed">
                Your order for <strong class="text-slate-900" id="modal-product-name"><?= htmlspecialchars($product['title']) ?></strong> (Qty: <span id="modal-qty">1</span>) has been forwarded to our Ann Arbor fulfillment center.
            </p>

            <div class="bg-slate-50 rounded-2xl p-4 text-left text-xs sm:text-sm text-slate-700 space-y-2 mb-6 border border-slate-100">
                <div class="flex justify-between">
                    <span class="text-slate-500">Order Reference:</span>
                    <span class="font-bold font-mono text-slate-900" id="modal-order-id">#CLN-<?= rand(10000, 99999) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Delivery Address:</span>
                    <span class="font-semibold text-slate-900 text-right truncate max-w-[220px]" id="modal-delivery-addr">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Total Price:</span>
                    <span class="font-black text-[#239B52]" id="modal-total-price">$<?= number_format($unitPrice * $initialQty, 2) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Payment Status:</span>
                    <span class="font-semibold text-cyan-700">No payment charged yet</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <a href="/shop.php" class="flex-1 py-3 px-5 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 text-sm font-bold transition-all text-center">
                    Continue Shopping
                </a>
                <a href="/" class="flex-1 py-3 px-5 rounded-full bg-[#239B52] hover:bg-[#1e8244] text-white text-sm font-bold shadow-md transition-all text-center">
                    Return to Home
                </a>
            </div>

        </div>
    </div>

    <?php
    // Include Standard Footer
    include __DIR__ . '/components/footer.php';
    ?>

    <!-- ==========================================
         LIVE JAVASCRIPT LOGIC
    =========================================== -->
    <script>
        const unitPrice = <?= json_encode($unitPrice) ?>;
        let currentQty = <?= json_encode($initialQty) ?>;

        function updatePricing() {
            const qtyDisplay = document.getElementById('checkout-qty');
            const summaryQtyLabel = document.getElementById('summary-qty-label');
            const summaryQtyPlural = document.getElementById('summary-qty-plural');
            const summarySubtotal = document.getElementById('summary-subtotal');
            const summaryTotal = document.getElementById('summary-total');

            if (qtyDisplay) qtyDisplay.innerText = currentQty;
            if (summaryQtyLabel) summaryQtyLabel.innerText = currentQty;
            if (summaryQtyPlural) summaryQtyPlural.innerText = currentQty > 1 ? 's' : '';

            const total = (unitPrice * currentQty).toFixed(2);
            const formattedTotal = '$' + Number(total).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });

            if (summarySubtotal) summarySubtotal.innerText = formattedTotal;
            if (summaryTotal) summaryTotal.innerText = formattedTotal;
        }

        function changeOrderQty(delta) {
            currentQty = Math.max(1, currentQty + delta);
            updatePricing();
        }

        function handlePlaceOrder(e) {
            e.preventDefault();
            const btn = document.getElementById('place-order-btn');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = `<span class="inline-block animate-spin mr-2">⟳</span> Submitting Details...`;
            }

            const street = document.getElementById('street_address')?.value || '';
            const city = document.getElementById('city')?.value || '';
            const state = document.getElementById('state')?.value || '';
            const zip = document.getElementById('zip')?.value || '';
            const fullAddress = `${street}, ${city}, ${state} ${zip}`;

            setTimeout(() => {
                const modal = document.getElementById('order-success-modal');
                const modalQty = document.getElementById('modal-qty');
                const modalAddr = document.getElementById('modal-delivery-addr');
                const modalTotalPrice = document.getElementById('modal-total-price');

                if (modalQty) modalQty.innerText = currentQty;
                if (modalAddr) modalAddr.innerText = fullAddress;
                if (modalTotalPrice) {
                    const total = (unitPrice * currentQty).toFixed(2);
                    modalTotalPrice.innerText = '$' + Number(total).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                }

                if (modal) {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }
            }, 600);
        }
    </script>

</body>
</html>

