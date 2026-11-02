<?php
/**
 * Stripe Payment Gateway Configuration
 */

require_once __DIR__ . '/env.php';

return [
    // API Keys loaded from .env
    'publishable_key' => env('STRIPE_PUBLISHABLE_KEY', ''),
    'secret_key'      => env('STRIPE_SECRET_KEY', ''),
    'webhook_secret'  => env('STRIPE_WEBHOOK_SECRET', ''),

    // Settings
    'currency'        => 'usd',
    'app_name'        => 'Cleanergy Battery',
    'support_phone'   => '+1 (734) 787-5246',
    'support_email'   => 'support@cleanergybattery.com',

    // Security & Environment
    'is_live'         => str_starts_with(env('STRIPE_SECRET_KEY', ''), 'sk_live_'),
];

