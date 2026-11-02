<?php
/**
 * Cleanergy Checkout Success & Order Verification Page
 * Calls Cleanergy Admin Backend API 3:
 * GET https://mcp-admin-7pwd.vercel.app/api/orders/verify?orderId={orderId}&session_id={session_id}
 * Strictly verifies status === 'PAID'.
 */

require_once __DIR__ . '/config/env.php';
require_once __DIR__ . '/services/AdminBackendService.php';

$orderId   = trim($_GET['orderId'] ?? $_GET['order_id'] ?? '');
$sessionId = trim($_GET['session_id'] ?? $_GET['sessionId'] ?? '');
$statusParam = trim($_GET['status'] ?? '');

$isPaid = false;
$order = null;
$errorMessage = null;

// If user was cancelled
if ($statusParam === 'cancelled') {
    $errorMessage = 'Payment was cancelled. No order was placed and no funds were charged.';
} elseif (empty($orderId) && empty($sessionId)) {
    $errorMessage = 'Missing Order ID or Stripe Session ID. If you believe this is an error, please reach out to our support.';
} else {
    try {
        $backend = new AdminBackendService();
        $res = $backend->verifyOrder($orderId, $sessionId);

        if (!empty($res['success']) && ($res['status'] ?? '') === 'PAID') {
            $isPaid = true;
            $order = $res['order'] ?? [];
        } else {
            $currentStatus = $res['status'] ?? 'UNVERIFIED';
            $errorMessage = "Payment status is currently '{$currentStatus}'. Order is not confirmed until payment is successfully received.";
            $order = $res['order'] ?? null;
        }
    } catch (Exception $e) {
        $errorMessage = 'Could not verify payment with Admin Backend: ' . htmlspecialchars($e->getMessage());
    }
}

// Format display data
$displayOrderId = $order['id'] ?? $orderId ?: 'N/A';
$totalAmountCents = (int)($order['totalAmount'] ?? $order['subtotalAmount'] ?? 0);
$displayTotal = $totalAmountCents > 0 ? number_format($totalAmountCents / 100, 2) : '0.00';
$currency = strtoupper($order['currency'] ?? 'USD');
$items = $order['items'] ?? [];
$source = $order['source'] ?? 'WEB';
$createdAt = !empty($order['createdAt']) ? date('M d, Y h:i A', strtotime($order['createdAt'])) : date('M d, Y h:i A');
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isPaid ? 'Payment Confirmed & Order Placed' : 'Payment Status' ?> | Cleanergy Battery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dist/output.css?v=<?= filemtime(__DIR__ . '/dist/output.css') ?>">
</head>
<body class="bg-[#F8FAFC] font-['Plus_Jakarta_Sans',sans-serif] text-slate-900 min-h-screen flex flex-col justify-between overflow-x-hidden max-w-full">

    <?php include __DIR__ . '/components/navbar.php'; ?>

    <main class="flex-grow pt-28 pb-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            <?php if ($isPaid): ?>
                <!-- SUCCESS CARD -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                    <!-- Top Status Banner -->
                    <div class="bg-gradient-to-r from-emerald-600 to-[#239B52] px-6 py-8 sm:px-10 text-white text-center">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-xs">
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="inline-block px-3 py-1 bg-white/25 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                            Payment Verified by Stripe & Admin
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Order Confirmed!</h1>
                        <p class="text-emerald-100 text-sm sm:text-base mt-1 max-w-md mx-auto">
                            Thank you for your purchase. Your order has been placed in our admin system with source tag <strong class="text-white">WEB</strong>.
                        </p>
                    </div>

                    <!-- Receipt Details -->
                    <div class="p-6 sm:p-10 space-y-6">

                        <!-- Meta Row -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pb-6 border-b border-slate-100 text-xs sm:text-sm">
                            <div>
                                <span class="text-slate-400 block text-xs uppercase font-medium">Order ID</span>
                                <span class="font-bold text-slate-800 break-all"><?= htmlspecialchars($displayOrderId) ?></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs uppercase font-medium">Order Date</span>
                                <span class="font-bold text-slate-800"><?= htmlspecialchars($createdAt) ?></span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs uppercase font-medium">Order Source</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-50 text-blue-700">
                                    <?= htmlspecialchars($source) ?> (Website)
                                </span>
                            </div>
                            <div>
                                <span class="text-slate-400 block text-xs uppercase font-medium">Payment Status</span>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-emerald-50 text-[#239B52]">
                                    ✓ PAID
                                </span>
                            </div>
                        </div>

                        <!-- Purchased Items -->
                        <div>
                            <h2 class="text-base font-bold text-slate-800 mb-4">Purchased Product(s)</h2>
                            <div class="space-y-3">
                                <?php if (!empty($items)): ?>
                                    <?php foreach ($items as $item): 
                                        $itemName = $item['productName'] ?? 'Cleanergy Battery';
                                        $itemQty = (int)($item['quantity'] ?? 1);
                                        $itemPrice = ((float)($item['unitPrice'] ?? 0)) / 100;
                                        $itemImage = $item['imageUrl'] ?? '/assets/img/sodiumIon.png';
                                    ?>
                                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl border border-slate-100">
                                            <div class="flex items-center gap-4">
                                                <img src="<?= htmlspecialchars($itemImage) ?>" 
                                                     alt="<?= htmlspecialchars($itemName) ?>"
                                                     class="w-16 h-16 object-contain rounded-xl bg-white p-1 border border-slate-200">
                                                <div>
                                                    <h3 class="font-bold text-slate-900 text-sm sm:text-base"><?= htmlspecialchars($itemName) ?></h3>
                                                    <p class="text-xs text-slate-500 mt-0.5">Quantity: <strong class="text-slate-700"><?= $itemQty ?></strong></p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <span class="font-extrabold text-slate-900 text-base sm:text-lg">
                                                    $<?= number_format($itemPrice * $itemQty, 2) ?>
                                                </span>
                                                <span class="text-xs text-slate-400 block">$<?= number_format($itemPrice, 2) ?> each</span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex justify-between items-center">
                                        <span class="font-semibold text-slate-800">Cleanergy High-Performance Battery</span>
                                        <span class="font-bold text-slate-900">$<?= $displayTotal ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Summary Row -->
                        <div class="p-4 bg-emerald-50/50 rounded-2xl border border-emerald-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-emerald-800">Total Paid via Stripe</span>
                                <p class="text-xs text-emerald-600">Includes all taxes, secure transaction & standard shipping</p>
                            </div>
                            <div class="text-right">
                                <span class="text-2xl sm:text-3xl font-black text-slate-900">$<?= $displayTotal ?></span>
                                <span class="text-xs text-slate-500 font-bold ml-1"><?= $currency ?></span>
                            </div>
                        </div>

                        <!-- Info / Next Steps -->
                        <div class="rounded-2xl p-4 bg-slate-50 border border-slate-200 text-xs text-slate-600 space-y-1">
                            <p class="font-bold text-slate-800">What happens next?</p>
                            <p>1. Your shipping and contact details have been securely collected by Stripe and saved in our Cleanergy Admin system.</p>
                            <p>2. Our logistics team is preparing your battery package with certified safety packaging.</p>
                            <p>3. You will receive shipping confirmation and carrier tracking updates directly.</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-4 flex flex-col sm:flex-row gap-3">
                            <a href="/shop.php" 
                               class="flex-1 py-3.5 px-6 rounded-full bg-[#239B52] hover:bg-[#1e8244] text-white text-center font-bold text-sm shadow-sm transition-colors">
                                Explore More Batteries
                            </a>
                            <a href="/" 
                               class="py-3.5 px-6 rounded-full border border-slate-300 hover:bg-slate-100 text-slate-700 text-center font-bold text-sm transition-colors">
                                Back to Home
                            </a>
                        </div>

                    </div>
                </div>

            <?php else: ?>
                <!-- PAYMENT INCOMPLETE / CANCELLED / FAILED CARD -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden text-center p-8 sm:p-12">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center mx-auto mb-5 border border-rose-100">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>

                    <span class="inline-block px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-bold uppercase tracking-wider mb-2">
                        Order Not Confirmed
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-2">
                        Payment Not Completed
                    </h1>
                    <p class="text-slate-600 text-sm sm:text-base max-w-md mx-auto mb-6">
                        <?= htmlspecialchars($errorMessage ?: 'The checkout session was not completed or was cancelled. No order has been placed in the database and no money was charged.') ?>
                    </p>

                    <div class="max-w-md mx-auto p-4 bg-slate-50 rounded-2xl border border-slate-200 text-left text-xs text-slate-600 mb-6 space-y-1">
                        <p class="font-bold text-slate-800">Security Guarantee:</p>
                        <p>• Cleanergy orders are ONLY confirmed when verified as PAID.</p>
                        <p>• If you hit the back button or closed the Stripe payment tab, your cart was safely preserved.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-center gap-3 max-w-sm mx-auto">
                        <a href="/shop.php" 
                           class="py-3 px-6 rounded-full bg-[#239B52] hover:bg-[#1e8244] text-white font-bold text-sm shadow-sm transition-colors">
                            Return to Shop
                        </a>
                        <a href="/index.php#contact" 
                           class="py-3 px-6 rounded-full border border-slate-300 hover:bg-slate-100 text-slate-700 font-bold text-sm transition-colors">
                            Contact Support
                        </a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </main>

    <?php include __DIR__ . '/components/footer.php'; ?>

</body>
</html>

