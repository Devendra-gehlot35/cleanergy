<?php
/**
 * Direct & Secure Stripe Service
 * Communicates with Stripe REST API v1 using PHP cURL with TLS 1.2+.
 */

class StripeService {
    private string $secretKey;
    private string $publishableKey;
    private string $webhookSecret;
    private string $apiBase = 'https://api.stripe.com/v1';

    public function __construct() {
        $config = require __DIR__ . '/../config/stripe.php';
        $this->secretKey      = $config['secret_key'] ?? '';
        $this->publishableKey = $config['publishable_key'] ?? '';
        $this->webhookSecret  = $config['webhook_secret'] ?? '';

        if (empty($this->secretKey)) {
            throw new RuntimeException('Stripe secret key is missing in .env');
        }
    }

    public function getPublishableKey(): string {
        return $this->publishableKey;
    }

    /**
     * Resolve public HTTPS image URL for Stripe
     * Stripe cloud servers cannot download from localhost. When testing locally,
     * this maps local asset paths to public live CDN so Stripe can display the image.
     */
    public static function resolvePublicImageUrl(?string $imagePath): string {
        if (empty($imagePath)) {
            return '';
        }

        // If it's already an external HTTPS URL (and not localhost)
        if (str_starts_with($imagePath, 'https://') &&
            !str_contains($imagePath, 'localhost') &&
            !str_contains($imagePath, '127.0.0.1')) {
            return $imagePath;
        }

        // Check if application has a live public domain or image base URL configured
        require_once dirname(__DIR__) . '/config/env.php';

        $imageBase = env('STRIPE_IMAGE_BASE_URL', '');
        if (!empty($imageBase) && str_starts_with($imageBase, 'https://')) {
            return rtrim($imageBase, '/') . '/' . ltrim($imagePath, '/');
        }

        $baseUrl = env('MCP_BASE_URL', '');
        if (!empty($baseUrl) &&
            str_starts_with($baseUrl, 'https://') &&
            !str_contains($baseUrl, 'localhost') &&
            !str_contains($baseUrl, '127.0.0.1')) {
            return rtrim($baseUrl, '/') . '/' . ltrim($imagePath, '/');
        }

        // Reliable fallback for localhost & testing:
        // GitHub raw CDN URL from the project's repository so Stripe can always fetch and display the product image
        $cleanPath = ltrim($imagePath, '/');
        return 'https://raw.githubusercontent.com/Devendra-gehlot35/cleanenergy/main/' . $cleanPath;
    }

    /**
     * Create a Stripe Checkout Session with full Customer & Address Collection
     * Matching user's exact specification:
     * - phone_number_collection: enabled
     * - billing_address_collection: required
     * - shipping_address_collection: US, CA
     *
     * @param array $data [
     *   'items' => array of items,
     *   'currency' => 'usd',
     *   'customer_email' => string (optional prefill),
     *   'success_url' => string,
     *   'cancel_url' => string,
     *   'metadata' => array
     * ]
     * @return array Stripe Checkout Session response
     */
    public function createCheckoutSession(array $data): array {
        $currency = strtolower($data['currency'] ?? 'usd');
        $items = $data['items'] ?? [];

        $payload = [
            'mode' => 'payment',
            // Collect contact & address details at Stripe Checkout (Exact match to specification)
            'phone_number_collection[enabled]' => 'true',
            'billing_address_collection' => 'required',
            'shipping_address_collection[allowed_countries][0]' => 'US',
            'shipping_address_collection[allowed_countries][1]' => 'CA',
            'success_url' => $data['success_url'],
            'cancel_url' => $data['cancel_url'],
        ];

        // Line items
        foreach ($items as $idx => $item) {
            $unitAmount = (int)$item['unitPrice'];
            $qty = max(1, (int)$item['quantity']);

            $payload["line_items[{$idx}][price_data][currency]"] = $currency;
            $payload["line_items[{$idx}][price_data][unit_amount]"] = (string)$unitAmount;
            $payload["line_items[{$idx}][price_data][product_data][name]"] = $item['productName'] ?? 'Cleanergy Battery';
            $payload["line_items[{$idx}][quantity]"] = (string)$qty;

            $imgUrl = self::resolvePublicImageUrl($item['imageUrl'] ?? '');
            if (!empty($imgUrl)) {
                $payload["line_items[{$idx}][price_data][product_data][images][0]"] = $imgUrl;
            }
        }

        if (!empty($data['customer_email'])) {
            $payload['customer_email'] = $data['customer_email'];
        }

        if (!empty($data['client_reference_id'])) {
            $payload['client_reference_id'] = $data['client_reference_id'];
        }

        // Attach custom metadata (orderId, productId, etc.)
        if (!empty($data['metadata']) && is_array($data['metadata'])) {
            foreach ($data['metadata'] as $metaKey => $metaVal) {
                $payload["metadata[{$metaKey}]"] = substr((string)$metaVal, 0, 500);
            }
        }

        return $this->request('POST', '/checkout/sessions', $payload);
    }

    /**
     * Retrieve an existing Checkout Session from Stripe
     */
    public function retrieveCheckoutSession(string $sessionId): array {
        if (empty($sessionId) || !preg_match('/^cs_(test|live)_[a-zA-Z0-9]+$/', $sessionId)) {
            throw new InvalidArgumentException('Invalid Stripe session ID format.');
        }

        return $this->request('GET', '/checkout/sessions/' . urlencode($sessionId) . '?expand[]=payment_intent&expand[]=line_items');
    }

    /**
     * Verify Stripe Webhook Signature (HMAC SHA256)
     */
    public function verifyWebhookSignature(string $payload, string $sigHeader, int $tolerance = 300): bool {
        if (empty($this->webhookSecret) || empty($sigHeader)) {
            return false;
        }

        $items = explode(',', $sigHeader);
        $timestamp = null;
        $signatures = [];

        foreach ($items as $item) {
            $parts = explode('=', trim($item), 2);
            if (count($parts) === 2) {
                if ($parts[0] === 't') {
                    $timestamp = (int)$parts[1];
                } elseif ($parts[0] === 'v1') {
                    $signatures[] = $parts[1];
                }
            }
        }

        if ($timestamp === null || empty($signatures)) {
            return false;
        }

        if (abs(time() - $timestamp) > $tolerance) {
            return false;
        }

        $signedPayload = "{$timestamp}.{$payload}";
        $expectedSignature = hash_hmac('sha256', $signedPayload, $this->webhookSecret);

        foreach ($signatures as $sig) {
            if (hash_equals($expectedSignature, $sig)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Internal cURL Request Handler
     */
    private function request(string $method, string $endpoint, array $params = []): array {
        $url = $this->apiBase . $endpoint;
        $ch = curl_init();

        $headers = [
            'Authorization: Bearer ' . $this->secretKey,
            'Stripe-Version: 2024-06-20',
        ];

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        } else {
            if (!empty($params)) {
                $url .= '?' . http_build_query($params);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        $responseBody = curl_exec($ch);
        $curlErrno    = curl_errno($ch);
        $curlError    = curl_error($ch);
        $httpCode     = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($curlErrno !== 0) {
            throw new RuntimeException("Stripe Network Error: {$curlError} (code: {$curlErrno})");
        }

        $decoded = json_decode($responseBody, true);
        if (!is_array($decoded)) {
            throw new RuntimeException("Invalid response from Stripe: HTTP {$httpCode}");
        }

        if ($httpCode >= 400 || isset($decoded['error'])) {
            $msg = $decoded['error']['message'] ?? 'Stripe API error';
            $code = $decoded['error']['code'] ?? $httpCode;
            throw new RuntimeException("Stripe Error ({$code}): {$msg}");
        }

        return $decoded;
    }
}
