<?php
/**
 * Cleanergy Admin Backend Service
 * Integrates PHP Website with Cleanergy Admin Backend (Prisma / Next.js)
 * Live Base: https://mcp-admin-7pwd.vercel.app
 */

require_once __DIR__ . '/../config/env.php';

class AdminBackendService {
    private string $baseUrl;

    // Direct mapping from CLEANERGY product code & catalog ID to Admin Backend Database ID
    public const PRODUCT_CODE_MAP = [
        'CLEANERGY-01' => 'cmuzcw90g0000no7kud73tjpa',
        'CLEANERGY-02' => 'cmv0uehki0000m87kb7ydvm79',
        'CLEANERGY-03' => 'cmv0wbvgv0002m87k5k3ypjin',
        'CLEANERGY-04' => 'cmv0wd1d60003m87kzkg6usd5',
        'CLEANERGY-05' => 'cmv0we7n00004m87kb80rl0hz',
    ];

    public const CATALOG_ID_MAP = [
        1 => 'cmuzcw90g0000no7kud73tjpa',
        2 => 'cmv0uehki0000m87kb7ydvm79',
        3 => 'cmv0wbvgv0002m87k5k3ypjin',
        4 => 'cmv0wd1d60003m87kzkg6usd5',
        5 => 'cmv0we7n00004m87kb80rl0hz',
    ];

    public function __construct(?string $baseUrl = null) {
        $url = $baseUrl ?? env('CLEANERGY_ADMIN_URL', 'https://mcp-admin-7pwd.vercel.app');
        $this->baseUrl = rtrim($url, '/');
    }

    public function getBaseUrl(): string {
        return $this->baseUrl;
    }

    /**
     * Resolve product code (e.g. CLEANERGY-01) or local numeric ID (1-5) to backend DB ID
     */
    public static function resolveBackendId($input): string {
        $str = trim((string)$input);

        // Check if it's already a cuid (e.g. cmv...)
        if (preg_match('/^c[a-z0-9]{20,}$/i', $str)) {
            return $str;
        }

        // Check product code (e.g. CLEANERGY-01)
        $codeUpper = strtoupper($str);
        if (isset(self::PRODUCT_CODE_MAP[$codeUpper])) {
            return self::PRODUCT_CODE_MAP[$codeUpper];
        }

        // Check numeric ID (1, 2, 3, 4, 5)
        $num = (int)$str;
        if (isset(self::CATALOG_ID_MAP[$num])) {
            return self::CATALOG_ID_MAP[$num];
        }

        return $str;
    }

    /**
     * API 1: Add Item to Cart
     * POST /api/cart
     * Body: { "productId": "...", "quantity": 1 }
     */
    public function addToCart($productCodeOrId, int $quantity = 1): array {
        $resolvedId = self::resolveBackendId($productCodeOrId);
        $url = "{$this->baseUrl}/api/cart";

        $response = $this->request('POST', $url, [
            'productId' => $resolvedId,
            'quantity'  => max(1, $quantity)
        ]);

        return $response;
    }

    /**
     * API 2: Create Stripe Checkout Session
     * POST /api/stripe/checkout
     * Body: { "cartId": "...", "source": "WEB" }
     */
    public function createCheckoutSession(string $cartId, string $source = 'WEB'): array {
        $url = "{$this->baseUrl}/api/stripe/checkout";

        $response = $this->request('POST', $url, [
            'cartId' => $cartId,
            'source' => $source
        ]);

        return $response;
    }

    /**
     * Full One-Step Purchase Flow:
     * 1. Add item to backend Cart
     * 2. Create Stripe Checkout Session with source = "WEB"
     * 3. Return Stripe redirect URL
     */
    public function initiateWebPurchase($productCodeOrId, int $quantity = 1): array {
        $cartResult = $this->addToCart($productCodeOrId, $quantity);

        if (empty($cartResult['success']) || empty($cartResult['cart']['id'])) {
            $msg = $cartResult['message'] ?? $cartResult['error'] ?? 'Unable to create cart in Admin Backend';
            throw new RuntimeException("Cart Error: {$msg}");
        }

        $cartId = $cartResult['cart']['id'];

        $checkoutResult = $this->createCheckoutSession($cartId, 'WEB');

        if (empty($checkoutResult['success']) || empty($checkoutResult['url'])) {
            $msg = $checkoutResult['error'] ?? $checkoutResult['message'] ?? 'Unable to generate Stripe checkout session';
            throw new RuntimeException("Checkout Error: {$msg}");
        }

        return [
            'success'  => true,
            'orderId'  => $checkoutResult['orderId'] ?? null,
            'url'      => $checkoutResult['url'],
            'cartId'   => $cartId,
        ];
    }

    /**
     * API 3: Order Verification API
     * GET /api/orders/verify?orderId={orderId}&session_id={session_id}
     */
    public function verifyOrder(string $orderId, string $sessionId): array {
        $query = http_build_query([
            'orderId'    => $orderId,
            'session_id' => $sessionId
        ]);
        $url = "{$this->baseUrl}/api/orders/verify?{$query}";

        return $this->request('GET', $url);
    }

    /**
     * cURL Helper
     */
    private function request(string $method, string $url, ?array $data = null): array {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $headers = [
            'Accept: application/json',
            'User-Agent: CleanergyWebsite-PHP/1.0',
        ];

        if (strtoupper($method) === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            $headers[] = 'Content-Type: application/json';
            $jsonBody = json_encode($data ?? []);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $rawResponse = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($rawResponse === false || !empty($curlError)) {
            return [
                'success' => false,
                'error'   => "Backend Network Error: {$curlError}",
                'status'  => $httpCode
            ];
        }

        $decoded = json_decode($rawResponse, true);
        if (!is_array($decoded)) {
            return [
                'success' => false,
                'error'   => "Invalid JSON response from Admin Backend (HTTP {$httpCode}): " . substr($rawResponse, 0, 200),
                'status'  => $httpCode
            ];
        }

        return $decoded;
    }
}

