<?php
// config/payway.php
return [
    'api_url' => env('ABA_PAYWAY_API_URL', 'https://checkout-sandbox.payway.com.kh/api/payment-gateway/v1/payments/purchase'),
    'api_key' => env('ABA_PAYWAY_API_KEY', '7290d28610b645f071b3cda939a19f476e9193e1'),
    'merchant_id' => env('ABA_PAYWAY_MERCHANT_ID', 'ec463541'),
];
