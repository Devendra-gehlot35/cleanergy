<?php
/**
 * Order Success & Payment Verification Page
 * Strictly verifies the Stripe Checkout Session server-to-server.
 * Only confirms and records the order if payment_status === 'paid'.
 */

require_once __DIR__ . '/services/StripeService.php';
require_once __DIR__ . '/services/OrderService.php';
require_once __DIR__ . '/services/AdminBackendService.php';

$sessionId = trim($_GET['session_id'] ?? $_GET['sessionId'] ?? '');
$orderId   = trim($_GET['orderId'] ?? $_GET['order_id'] ?? '');
$isVerifiedPaid = false;
$errorMessage = null;
$order = null;

if (empty($sessionId) && empty($orderId)) {
    $errorMessage = 'No transaction session ID was provided. If you believe this is an error, please contact our support team.';
} else {
    try {
        // First try Cleanergy Admin Backend Verification (API 3)
        if (!empty($orderId) || !empty($sessionId)) {
            $backend = new AdminBackendService();
            $adminRes = $backend->verifyOrder($orderId, $sessionId);
            if (!empty($adminRes['success']) && ($adminRes['status'] ?? '') === 'PAID') {
                $isVerifiedPaid = true;
                $order = $adminRes['order'] ?? [];
            }
        }

        // If not verified yet and sessionId is available, verify directly with Stripe
        if (!$isVerifiedPaid && !empty($sessionId)) {
            $stripe = new StripeService();
            $session = $stripe->retrieveCheckoutSession($sessionId);

            $paymentStatus = $session['payment_status'] ?? 'unpaid';

            if ($paymentStatus !== 'paid') {
                $errorMessage = "Payment has not been completed (Status: '{$paymentStatus}'). No order has been placed and no charges were made.";
            } else {
                $orderService = new OrderService();
                if (!empty($orderId)) {
                    $order = $orderService->confirmPaidOrder($orderId, $session);
                } else {
                    $metaOrderId = $session['metadata']['orderId'] ?? '';
                    if (!empty($metaOrderId)) {
                        $order = $orderService->confirmPaidOrder($metaOrderId, $session);
                    } else {
                        $order = $orderService->getOrderBySessionId($sessionId);
                    }
                }
                $isVerifiedPaid = true;
            }
        }
    } catch (Exception $e) {
        $errorMessage = 'Payment verification failed: ' . htmlspecialchars($e->getMessage());
    }
}

// Normalized display variables
$displayOrderId = $order['id'] ?? $order['order_id'] ?? ('ord_' . substr(md5($sessionId), 0, 8));
$displayIntent  = $order['payment']['stripePaymentIntentId'] ?? $order['stripe_payment_intent'] ?? ($session['payment_intent']['id'] ?? $session['payment_intent'] ?? '');
$displayTitle   = $order['items'][0]['productName'] ?? $order['product_title'] ?? 'Cleanergy Battery System';
$displayQty     = $order['items'][0]['quantity'] ?? $order['quantity'] ?? 1;
$displayTotal   = isset($order['totalAmount']) ? ((float)$order['totalAmount'] / 100) : (float)($order['total_amount'] ?? 0);
$displayCurrency = strtoupper($order['currency'] ?? 'USD');

$customerName  = $order['customer']['name'] ?? trim(($order['customer']['first_name'] ?? '') . ' ' . ($order['customer']['last_name'] ?? ''));
if (empty($customerName)) {
    $customerName = $session['customer_details']['name'] ?? 'Valued Customer';
}
$customerEmail = $order['customer']['email'] ?? ($session['customer_details']['email'] ?? '');
$customerPhone = $order['customer']['phone'] ?? ($session['customer_details']['phone'] ?? '');

$shippingAddr = $order['shippingAddress'] ?? null;
if (!$shippingAddr && !empty($session['shipping_details']['address'])) {
    $shippingAddr = [
        'recipient'   => $session['shipping_details']['name'] ?? '',
        'line1'       => $session['shipping_details']['address']['line1'] ?? '',
        'line2'       => $session['shipping_details']['address']['line2'] ?? '',
        'city'        => $session['shipping_details']['address']['city'] ?? '',
        'state'       => $session['shipping_details']['address']['state'] ?? '',
        'postal_code' => $session['shipping_details']['address']['postal_code'] ?? '',
        'country'     => $session['shipping_details']['address']['country'] ?? 'US',
    ];
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isVerifiedPaid ? 'Payment Confirmed & Order Placed' : 'Payment Status' ?> | Cleanergy Battery</title>
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

    <!-- Main Content Container -->
    <main class="flex-1 pt-24 sm:pt-32 pb-16 lg:pb-24">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <?php if ($isVerifiedPaid): ?>
                <!-- ==============================================
                     SUCCESS STATE: ORDER VERIFIED & CONFIRMED
                =============================================== -->
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden">
                    
                    <!-- Top Green Header Banner -->
                    <div class="bg-gradient-to-r from-emerald-600 to-[#239B52] p-8 sm:p-10 text-white text-center relative">
                        <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur-md text-white flex items-center justify-center mx-auto mb-4 border-2 border-white/40 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </div>
                        <span class="inline-block px-3.5 py-1 rounded-full bg-white/25 text-white text-xs font-bold uppercase tracking-wider mb-2">
                            Payment Received & Verified
                        </span>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight">
                            Order Confirmed!
                        </h1>
                        <p class="text-white/90 text-sm sm:text-base mt-2 max-w-lg mx-auto">
                            Thank you for your order. Your payment was verified through Stripe and your battery system has been queued for warehouse fulfillment.
                        </p>
                    </div>

                    <!-- Receipt & Order Details Body -->
                    <div class="p-6 sm:p-8 lg:p-10 space-y-6">
                        
                        <!-- Order & Payment Reference Numbers -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 rounded-2xl p-4 sm:p-5 border border-slate-100">
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Order ID:</span>
                                <span class="text-base sm:text-lg font-black text-slate-900 font-mono"><?= htmlspecialchars($displayOrderId) ?></span>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">Stripe Transaction:</span>
                                <span class="text-xs sm:text-sm font-semibold text-slate-600 font-mono break-all"><?= htmlspecialchars($displayIntent ?: $sessionId) ?></span>
                            </div>
                        </div>

                        <!-- Product Purchased Summary -->
                        <div class="border-t border-slate-100 pt-5">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Item Details</h3>
                            <div class="flex items-center justify-between py-2">
                                <div>
                                    <h4 class="text-base font-bold text-slate-900"><?= htmlspecialchars($displayTitle) ?></h4>
                                    <span class="text-xs text-slate-500">Qty: <?= (int)$displayQty ?> • 10-Yr Warranty Included</span>
                                </div>
                                <span class="text-lg font-extrabold text-[#239B52]">
                                    $<?= number_format($displayTotal, 2) ?> <?= htmlspecialchars($displayCurrency) ?>
                                </span>
                            </div>
                        </div>

                        <!-- Customer & Shipping Destination -->
                        <div class="border-t border-slate-100 pt-5 grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Customer Contact</h3>
                                <p class="text-sm font-bold text-slate-800">
                                    <?= htmlspecialchars($customerName) ?>
                                </p>
                                <?php if (!empty($customerEmail)): ?>
                                    <p class="text-xs text-slate-600 mt-0.5"><?= htmlspecialchars($customerEmail) ?></p>
                                <?php endif; ?>
                                <?php if (!empty($customerPhone)): ?>
                                    <p class="text-xs text-slate-600"><?= htmlspecialchars($customerPhone) ?></p>
                                <?php endif; ?>
                            </div>

                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-2">Delivery Address (from Stripe)</h3>
                                <?php if ($shippingAddr): ?>
                                    <p class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                                        <?= htmlspecialchars($shippingAddr['line1'] ?? '') ?><br>
                                        <?php if (!empty($shippingAddr['line2'])): ?>
                                            <?= htmlspecialchars($shippingAddr['line2']) ?><br>
                                        <?php endif; ?>
                                        <?= htmlspecialchars($shippingAddr['city'] ?? '') ?>, <?= htmlspecialchars($shippingAddr['state'] ?? '') ?> <?= htmlspecialchars($shippingAddr['postal_code'] ?? '') ?><br>
                                        <?= htmlspecialchars($shippingAddr['country'] ?? 'US') ?>
                                    </p>
                                <?php else: ?>
                                    <p class="text-xs text-slate-500 italic">Address verified on Stripe checkout receipt.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Dispatch Info Box -->
                        <div class="bg-[#EDFAFC] border border-[#a2d2df] rounded-2xl p-4 sm:p-5 flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-white border border-[#a2d2df] flex items-center justify-center shrink-0 text-[#12b3d6]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.948c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75"/>
                                </svg>
                            </div>
                            <div class="text-xs sm:text-sm text-slate-700 leading-relaxed">
                                <span class="font-bold text-slate-900 block mb-0.5">Fulfillment Status</span>
                                Dispatched from <strong class="text-slate-800">4750 Venture Drive, Ann Arbor, MI 48108</strong>. Freight carrier will contact you before delivery to coordinate liftgate drop-off.
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-2 flex flex-col sm:flex-row gap-3">
                            <a href="/shop.php" class="flex-1 py-3.5 px-6 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-sm text-center transition-colors">
                                Continue Shopping
                            </a>
                            <a href="/" class="flex-1 py-3.5 px-6 rounded-full bg-[#239B52] hover:bg-[#1e8244] text-white font-bold text-sm text-center shadow-md transition-all">
                                Return to Homepage
                            </a>
                        </div>

                    </div>
                </div>

            <?php else: ?>
                <!-- ==============================================
                     FAILED / UNVERIFIED STATE: NO ORDER PLACED
                =============================================== -->
                <div class="bg-white rounded-3xl border border-rose-200 shadow-xl overflow-hidden p-6 sm:p-10 text-center">
                    <div class="w-16 h-16 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>

                    <span class="inline-block px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-bold uppercase tracking-wider mb-2">
                        Order Not Placed
                    </span>

                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mb-3">
                        Payment Was Not Completed
                    </h1>

                    <p class="text-slate-600 text-sm sm:text-base max-w-md mx-auto mb-6 leading-relaxed">
                        <?= htmlspecialchars($errorMessage ?: 'Your payment could not be verified. No order has been placed and no card was charged.') ?>
                    </p>

                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 text-xs sm:text-sm text-amber-800 max-w-md mx-auto mb-8 text-left">
                        <strong>Security Protection:</strong> Orders are only confirmed after successful payment verification. If you clicked back or cancelled checkout, your session was aborted safely.
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center gap-3">
                        <a href="/shop.php" class="py-3 px-6 rounded-full bg-[#12b3d6] hover:bg-[#0ea5e9] text-white font-bold text-sm transition-colors shadow-sm">
                            Browse Batteries
                        </a>
                        <a href="/contact.php" class="py-3 px-6 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-sm transition-colors">
                            Contact Support
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <?php
    // Include Standard Footer
    include __DIR__ . '/components/footer.php';
    ?>

</body>
</html>
