<?php
/**
 * Direct Buy Now -> Cleanergy Admin Backend & Stripe Redirector
 * Zero intermediate page.
 * Flow:
 * 1. Creates cart in Admin Backend (POST /api/cart)
 * 2. Creates Stripe Checkout Session with source = "WEB" (POST /api/stripe/checkout)
 * 3. Immediately redirects (HTTP 302) to Stripe's secure hosted checkout page
 */

require_once __DIR__ . '/config/env.php';
require_once __DIR__ . '/data/products.php';
require_once __DIR__ . '/services/RateLimitService.php';
require_once __DIR__ . '/services/AdminBackendService.php';
require_once __DIR__ . '/services/StripeService.php';
require_once __DIR__ . '/services/OrderService.php';

$productCode = trim($_GET['code'] ?? '');
if (!empty($productCode)) {
    $product = get_product_by_code($productCode);
} else {
    $productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
    $product = get_product_by_id($productId);
}

if (!$product) {
    header('Location: /shop.php');
    exit;
}

$quantity = isset($_GET['qty']) ? max(1, (int)$_GET['qty']) : 1;

try {
    // Rate limit
    $clientIp = RateLimitService::getClientIp();
    $rateLimiter = new RateLimitService();
    $rateLimit = $rateLimiter->check($clientIp, 20, 60);

    if (!$rateLimit['success']) {
        die("Too many requests. Please try again shortly.");
    }

    // PRIMARY PATH: Cleanergy Admin Backend (API 1: /api/cart + API 2: /api/stripe/checkout with source: "WEB")
    try {
        $adminService = new AdminBackendService();
        $target = $product['product_code'] ?? $product['id'] ?? 'CLEANERGY-01';
        $purchase = $adminService->initiateWebPurchase($target, $quantity);

        if (!empty($purchase['url'])) {
            header("Location: " . $purchase['url']);
            exit;
        }
    } catch (Exception $adminEx) {
        error_log("Cleanergy Admin Backend purchase error, falling back to direct Stripe: " . $adminEx->getMessage());
    }

    // FALLBACK PATH: Direct Local Stripe Service (Resilience fallback)
    $rawPrice = (float)($product['price_num'] ?? 0);
    $unitPriceCents = (int)round($rawPrice * 100);
    $subtotalAmount = $unitPriceCents * $quantity;

    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
               ($_SERVER['SERVER_PORT'] ?? 80) == 443 ||
               (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    $detectedProtocol = $isHttps ? 'https' : 'http';
    $detectedHost = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
    $fallbackUrl = "{$detectedProtocol}://{$detectedHost}";

    $baseUrl = env('MCP_BASE_URL', $fallbackUrl);
    $baseUrl = rtrim($baseUrl, '/');

    $imageUrl = StripeService::resolvePublicImageUrl($product['image'] ?? '');

    $items = [
        [
            'productId'   => $product['id'],
            'productName' => $product['title'],
            'imageUrl'    => $imageUrl,
            'unitPrice'   => $unitPriceCents,
            'quantity'    => $quantity,
        ]
    ];

    $orderService = new OrderService();
    $stripeService = new StripeService();

    $order = $orderService->createPendingOrder([
        'currency'       => 'usd',
        'subtotalAmount' => $subtotalAmount,
        'items'          => $items,
        'customer'       => []
    ]);

    $orderId = $order['id'];
    $successUrl = "{$baseUrl}/checkout-success.php?orderId={$orderId}&session_id={CHECKOUT_SESSION_ID}";
    $cancelUrl  = "{$baseUrl}/order-cancel.php?orderId={$orderId}&status=cancelled";

    $session = $stripeService->createCheckoutSession([
        'items'       => $items,
        'currency'    => 'usd',
        'success_url' => $successUrl,
        'cancel_url'  => $cancelUrl,
        'metadata'    => [
            'orderId'      => $orderId,
            'productId'    => (string)$product['id'],
            'productCode'  => $product['product_code'] ?? 'CLEANERGY-01',
            'source'       => 'WEB'
        ]
    ]);

    $orderService->recordCheckoutSession($orderId, $session['id'], $session['url']);

    header("Location: " . $session['url']);
    exit;

} catch (Exception $e) {
    die("Unable to initiate checkout: " . htmlspecialchars($e->getMessage()));
}
