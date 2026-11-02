<?php
/**
 * Order Cancellation / Back Button Page
 * Displayed when a user clicks 'Back' or cancels on the Stripe Checkout page.
 * Strictly marks the order as CANCELLED and guarantees NO charge is processed.
 */

require_once __DIR__ . '/services/OrderService.php';

$orderId = trim($_GET['orderId'] ?? '');
if (!empty($orderId)) {
    try {
        $orderService = new OrderService();
        $orderService->cancelOrder($orderId, 'User clicked back or cancelled on Stripe checkout');
    } catch (Exception $e) {
        // Ignore error
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Cancelled | Cleanergy Battery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/dist/output.css') ?>">
</head>
<body class="bg-[#F8FAFC] font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php
    // Include Fixed Floating Navbar
    include __DIR__ . '/components/navbar.php';
    ?>

    <!-- Main Container -->
    <main class="flex-1 pt-24 sm:pt-32 pb-16 lg:pb-24">
        <div class="max-w-xl mx-auto px-4 sm:px-6">

            <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl p-6 sm:p-10 text-center">
                
                <!-- Cancel Icon -->
                <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center mx-auto mb-4 border border-slate-200">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </div>

                <span class="inline-block px-3.5 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-bold uppercase tracking-wider mb-2">
                    Checkout Cancelled
                </span>

                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mb-2">
                    No Order Was Placed
                </h1>

                <p class="text-slate-600 text-sm sm:text-base leading-relaxed mb-6">
                    You navigated back or cancelled during the Stripe payment step. Your card was not charged, and no order has been created.
                </p>

                <div class="bg-blue-50 border border-blue-200/70 rounded-2xl p-4 text-xs sm:text-sm text-blue-900 text-left mb-6 space-y-1">
                    <p class="font-bold flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-blue-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        Need Help With Your Battery Order?
                    </p>
                    <p class="text-blue-800 text-xs">
                        Call our battery application specialists at <a href="tel:+17347875246" class="font-bold underline">+1 (734) 787-5246</a> if you have questions regarding compatibility, sizing, or freight shipping.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="/shop.php" class="flex-1 py-3.5 px-6 rounded-full bg-[#239B52] hover:bg-[#1e8244] text-white font-bold text-sm text-center shadow-md transition-all">
                        Try Again / Shop
                    </a>
                    <a href="/" class="flex-1 py-3.5 px-6 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-sm text-center transition-colors">
                        Back to Home
                    </a>
                </div>

            </div>

        </div>
    </main>

    <?php
    // Include Standard Footer
    include __DIR__ . '/components/footer.php';
    ?>

</body>
</html>
