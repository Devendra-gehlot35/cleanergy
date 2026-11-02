<?php
/**
 * API: Create Stripe Checkout Session
 * Integrates with Cleanergy Admin Backend APIs:
 * - API 1: POST https://mcp-admin-7pwd.vercel.app/api/cart
 * - API 2: POST https://mcp-admin-7pwd.vercel.app/api/stripe/checkout with { "cartId": "...", "source": "WEB" }
 */

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Method not allowed. POST required.']);
    exit;
}

try {
    require_once __DIR__ . '/../config/env.php';
    require_once __DIR__ . '/../data/products.php';
    require_once __DIR__ . '/../services/RateLimitService.php';
    require_once __DIR__ . '/../services/AdminBackendService.php';
    require_once __DIR__ . '/../services/StripeService.php';
    require_once __DIR__ . '/../services/OrderService.php';

    // 1. Rate limit
    $clientIp = RateLimitService::getClientIp();
    $rateLimiter = new RateLimitService();
    $rateLimit = $rateLimiter->check($clientIp, 15, 60);

    if (!$rateLimit['success']) {
        http_response_code(429);
        echo json_encode([
            'success'     => false,
            'error'       => $rateLimit['error'] ?? 'Too many checkout requests.',
            'retry_after' => $rateLimit['retry_after'] ?? 60
        ]);
        exit;
    }

    // 2. Parse input JSON or Form POST
    $input = $_POST;
    if (empty($input)) {
        $raw = @file_get_contents('php://input');
        $input = json_decode((string)$raw, true) ?? [];
    }

    $productCode = trim($input['product_code'] ?? $input['productCode'] ?? '');
    $productId   = isset($input['product_id']) ? (int)$input['product_id'] : (int)($input['productId'] ?? 0);
    $quantity    = isset($input['quantity']) ? max(1, (int)$input['quantity']) : 1;

    $product = null;
    if (!empty($productCode)) {
        $product = get_product_by_code($productCode);
    }
    if (!$product && $productId > 0) {
        $product = get_product_by_id($productId);
    }
    if (!$product) {
        // Default to product 1
        $product = get_product_by_id(1);
    }

    $targetIdentifier = $product['product_code'] ?? $product['id'] ?? 'CLEANERGY-01';

    // 3. PRIMARY PATH: Call Cleanergy Admin Backend APIs
    try {
        $adminService = new AdminBackendService();
        $purchase = $adminService->initiateWebPurchase($targetIdentifier, $quantity);

        if (!empty($purchase['url'])) {
            echo json_encode([
                'success' => true,
                'orderId' => $purchase['orderId'] ?? null,
                'cartId'  => $purchase['cartId'] ?? null,
                'url'     => $purchase['url'],
                'source'  => 'WEB'
            ]);
            exit;
        }
    } catch (Exception $adminEx) {
        error_log("Admin Backend purchase initiation error: " . $adminEx->getMessage());
    }

    // 4. FALLBACK PATH: Direct Stripe checkout
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
            'orderId'     => $orderId,
            'productCode' => $product['product_code'] ?? 'CLEANERGY-01',
            'source'      => 'WEB'
        ]
    ]);

    $orderService->recordCheckoutSession($orderId, $session['id'], $session['url']);

    echo json_encode([
        'success' => true,
        'orderId' => $orderId,
        'url'     => $session['url'],
        'source'  => 'WEB'
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error'   => 'Unable to create checkout session: ' . $e->getMessage()
    ]);
}
