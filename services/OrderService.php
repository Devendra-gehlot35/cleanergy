<?php
/**
 * Clean & Secure Order Management Service
 * Replicates the Prisma schema & transaction lifecycle from reference implementation:
 * - Creates PENDING order with PENDING payment
 * - Checks 15-minute unexpired duplicate pending sessions
 * - Confirms order ONLY when payment_status is 'paid'
 * - Fails/Cancels order if checkout is aborted or back button is clicked
 * - Syncs with optional External API if configured in .env
 */

class OrderService {
    private string $storageFile;

    public function __construct() {
        $storageDir = dirname(__DIR__) . '/storage/orders';
        if (!is_dir($storageDir)) {
            @mkdir($storageDir, 0755, true);
        }
        $this->storageFile = $storageDir . '/orders.json';

        if (!file_exists($this->storageFile)) {
            @file_put_contents($this->storageFile, json_encode([], JSON_PRETTY_PRINT));
        }
    }

    /**
     * Create a PENDING order before redirecting to Stripe (Exact match to Prisma create)
     */
    public function createPendingOrder(array $data): array {
        $orderId = 'ord_' . date('ymd') . '_' . bin2hex(random_bytes(4));
        $now = date('c');

        $subtotal = (int)$data['subtotalAmount'];
        $currency = strtolower($data['currency'] ?? 'usd');

        $order = [
            'id'             => $orderId,
            'status'         => 'PENDING',
            'currency'       => $currency,
            'subtotalAmount' => $subtotal,
            'totalAmount'    => $subtotal,
            'items'          => $data['items'] ?? [],
            'customer' => [
                'name'  => $data['customer']['name'] ?? '',
                'email' => $data['customer']['email'] ?? '',
                'phone' => $data['customer']['phone'] ?? '',
            ],
            'shippingAddress' => null,
            'billingAddress'  => null,
            'payment' => [
                'amount'                  => $subtotal,
                'currency'                => $currency,
                'status'                  => 'PENDING',
                'stripeCheckoutSessionId' => null,
                'stripePaymentIntentId'   => null,
            ],
            'createdAt'      => $now,
            'updatedAt'      => $now,
        ];

        $this->saveOrderAtomic($order);
        return $order;
    }

    /**
     * Find recent unexpired pending order within 15 minutes (Exact match to reference code)
     */
    public function findRecentPendingOrder(int $productId, int $subtotalAmount, int $minutesAgo = 15): ?array {
        $orders = $this->readOrders();
        $cutoff = time() - ($minutesAgo * 60);

        foreach (array_reverse($orders) as $order) {
            if (($order['status'] ?? '') === 'PENDING' &&
                (int)($order['totalAmount'] ?? 0) === $subtotalAmount &&
                strtotime($order['createdAt'] ?? '0') >= $cutoff) {

                // Check if product matches
                $orderProductId = (int)($order['items'][0]['productId'] ?? 0);
                if ($orderProductId === $productId) {
                    return $order;
                }
            }
        }

        return null;
    }

    /**
     * Attach Stripe Checkout Session ID to Pending Order
     */
    public function updateStripeSessionId(string $orderId, string $sessionId): void {
        $this->updateOrderAtomic($orderId, function (&$order) use ($sessionId) {
            $order['payment']['stripeCheckoutSessionId'] = $sessionId;
            $order['updatedAt'] = date('c');
        });
    }

    /**
     * Strictly confirm paid order upon verified Stripe session
     */
    public function confirmPaidOrder(string $orderId, array $sessionData): array {
        $paymentStatus = $sessionData['payment_status'] ?? '';
        if ($paymentStatus !== 'paid') {
            throw new RuntimeException("Cannot confirm order: Stripe payment_status is '{$paymentStatus}', not 'paid'.");
        }

        $updatedOrder = null;

        $this->updateOrderAtomic($orderId, function (&$order) use ($sessionData, &$updatedOrder) {
            $customerDetails = $sessionData['customer_details'] ?? [];
            $shippingDetails = $sessionData['shipping_details'] ?? [];
            $paymentIntent   = $sessionData['payment_intent'] ?? null;

            $intentId = is_array($paymentIntent) ? ($paymentIntent['id'] ?? '') : (string)($paymentIntent ?? '');

            $order['status'] = 'CONFIRMED';
            $order['payment']['status'] = 'PAID';
            $order['payment']['stripePaymentIntentId'] = $intentId;
            $order['payment']['stripeCheckoutSessionId'] = $sessionData['id'] ?? $order['payment']['stripeCheckoutSessionId'];

            // Customer Info collected by Stripe
            $order['customer'] = [
                'name'  => $customerDetails['name'] ?? $order['customer']['name'] ?? '',
                'email' => $customerDetails['email'] ?? $order['customer']['email'] ?? '',
                'phone' => $customerDetails['phone'] ?? $order['customer']['phone'] ?? '',
            ];

            // Shipping Address collected by Stripe
            if (!empty($shippingDetails['address'])) {
                $addr = $shippingDetails['address'];
                $order['shippingAddress'] = [
                    'recipient'   => $shippingDetails['name'] ?? '',
                    'line1'       => $addr['line1'] ?? '',
                    'line2'       => $addr['line2'] ?? '',
                    'city'        => $addr['city'] ?? '',
                    'state'       => $addr['state'] ?? '',
                    'postal_code' => $addr['postal_code'] ?? '',
                    'country'     => $addr['country'] ?? '',
                ];
            }

            // Billing Address collected by Stripe
            if (!empty($customerDetails['address'])) {
                $bAddr = $customerDetails['address'];
                $order['billingAddress'] = [
                    'line1'       => $bAddr['line1'] ?? '',
                    'line2'       => $bAddr['line2'] ?? '',
                    'city'        => $bAddr['city'] ?? '',
                    'state'       => $bAddr['state'] ?? '',
                    'postal_code' => $bAddr['postal_code'] ?? '',
                    'country'     => $bAddr['country'] ?? '',
                ];
            }

            $order['updatedAt'] = date('c');
            $updatedOrder = $order;
        });

        if ($updatedOrder) {
            // Optional External API Sync
            $this->syncWithExternalApi($updatedOrder);
            return $updatedOrder;
        }

        throw new RuntimeException("Order '{$orderId}' not found for confirmation.");
    }

    /**
     * Mark order as CANCELLED (e.g. user hit back button or cancelled)
     */
    public function cancelOrder(string $orderId, string $reason = 'cancelled_by_user'): ?array {
        $cancelledOrder = null;
        $this->updateOrderAtomic($orderId, function (&$order) use ($reason, &$cancelledOrder) {
            // Only cancel if still pending
            if ($order['status'] === 'PENDING') {
                $order['status'] = 'CANCELLED';
                $order['payment']['status'] = 'CANCELLED';
                $order['cancel_reason'] = $reason;
                $order['updatedAt'] = date('c');
            }
            $cancelledOrder = $order;
        });
        return $cancelledOrder;
    }

    /**
     * Mark order as FAILED
     */
    public function failOrder(string $orderId, string $reason = 'payment_failed'): ?array {
        $failedOrder = null;
        $this->updateOrderAtomic($orderId, function (&$order) use ($reason, &$failedOrder) {
            if ($order['status'] === 'PENDING') {
                $order['status'] = 'FAILED';
                $order['payment']['status'] = 'FAILED';
                $order['failure_reason'] = $reason;
                $order['updatedAt'] = date('c');
            }
            $failedOrder = $order;
        });
        return $failedOrder;
    }

    /**
     * Retrieve Order by ID
     */
    public function getOrderById(string $orderId): ?array {
        $orders = $this->readOrders();
        foreach ($orders as $order) {
            if (($order['id'] ?? '') === $orderId) {
                return $order;
            }
        }
        return null;
    }

    /**
     * Retrieve Order by Stripe Session ID
     */
    public function getOrderBySessionId(string $sessionId): ?array {
        $orders = $this->readOrders();
        foreach ($orders as $order) {
            if (($order['payment']['stripeCheckoutSessionId'] ?? '') === $sessionId) {
                return $order;
            }
        }
        return null;
    }

    /**
     * Sync Confirmed Order with External API if configured in .env
     */
    private function syncWithExternalApi(array $order): void {
        require_once dirname(__DIR__) . '/config/env.php';
        $apiUrl = env('EXTERNAL_ORDER_API_URL');
        if (empty($apiUrl)) {
            return;
        }

        // Send POST request with JSON payload
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($order));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-Source: Cleanergy-Store'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Fast non-blocking timeout
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        @curl_exec($ch);
        @curl_close($ch);
    }

    /**
     * Atomic order save using exclusive file locking
     */
    private function saveOrderAtomic(array $order): void {
        $fp = fopen($this->storageFile, 'c+');
        if (!$fp) return;

        if (flock($fp, LOCK_EX)) {
            $contents = '';
            while (!feof($fp)) {
                $contents .= fread($fp, 8192);
            }
            $orders = json_decode($contents, true);
            if (!is_array($orders)) {
                $orders = [];
            }
            $orders[] = $order;

            ftruncate($fp, 0);
            rewind($fp);
            fwrite($fp, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            fflush($fp);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

    /**
     * Atomic order update using exclusive file locking
     */
    private function updateOrderAtomic(string $orderId, callable $callback): void {
        $fp = fopen($this->storageFile, 'c+');
        if (!$fp) return;

        if (flock($fp, LOCK_EX)) {
            $contents = '';
            while (!feof($fp)) {
                $contents .= fread($fp, 8192);
            }
            $orders = json_decode($contents, true);
            if (is_array($orders)) {
                foreach ($orders as &$order) {
                    if (($order['id'] ?? '') === $orderId) {
                        $callback($order);
                        break;
                    }
                }
                unset($order);

                ftruncate($fp, 0);
                rewind($fp);
                fwrite($fp, json_encode($orders, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                fflush($fp);
            }
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }

    /**
     * Read all orders from JSON storage
     */
    public function readOrders(): array {
        if (!file_exists($this->storageFile)) {
            return [];
        }
        $json = @file_get_contents($this->storageFile);
        $data = json_decode($json, true);
        return is_array($data) ? $data : [];
    }
}
