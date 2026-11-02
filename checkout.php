<?php
/**
 * Checkout Router / Forwarder
 * Routes Stripe callbacks (/checkout?orderId=...&session_id=...) to checkout-success.php or order-cancel.php
 */

$status = $_GET['status'] ?? '';
$orderId = $_GET['orderId'] ?? $_GET['order_id'] ?? '';
$sessionId = $_GET['session_id'] ?? $_GET['sessionId'] ?? '';

if ($status === 'cancelled') {
    $cancelUrl = '/order-cancel.php?' . http_build_query([
        'orderId' => $orderId,
        'status'  => 'cancelled'
    ]);
    header("Location: {$cancelUrl}");
    exit;
}

if (!empty($sessionId) || !empty($orderId)) {
    $successUrl = '/checkout-success.php?' . http_build_query([
        'orderId'    => $orderId,
        'session_id' => $sessionId
    ]);
    header("Location: {$successUrl}");
    exit;
}

// Fallback to shop
header('Location: /shop.php');
exit;

