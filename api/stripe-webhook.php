<?php
/**
 * Stripe Webhook Endpoint
 * Asynchronously and securely captures 'checkout.session.completed' events.
 * Verifies HMAC SHA-256 signature to guarantee requests originate from Stripe.
 */

header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed.']);
    exit;
}

$payload = @file_get_contents('php://input');
$sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

if (empty($payload) || empty($sigHeader)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing payload or Stripe signature header.']);
    exit;
}

try {
    require_once __DIR__ . '/../services/StripeService.php';
    require_once __DIR__ . '/../services/OrderService.php';

    $stripe = new StripeService();
    $isValid = $stripe->verifyWebhookSignature($payload, $sigHeader);

    if (!$isValid) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid webhook signature.']);
        exit;
    }

    $event = json_decode($payload, true);
    if (!is_array($event) || empty($event['type'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Malformed event payload.']);
        exit;
    }

    $eventType = $event['type'];
    $dataObject = $event['data']['object'] ?? [];

    if ($eventType === 'checkout.session.completed') {
        $paymentStatus = $dataObject['payment_status'] ?? '';
        
        // Strict Security: Only record if payment is actually paid!
        if ($paymentStatus === 'paid') {
            $orderService = new OrderService();
            $orderService->recordPaidOrder($dataObject);
        }
    }

    http_response_code(200);
    echo json_encode(['received' => true]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Webhook processing failed: ' . $e->getMessage()]);
}

