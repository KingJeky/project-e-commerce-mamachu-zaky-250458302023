<?php

require __DIR__ . '/vendor/autoload.php';

// Load Laravel  
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get order 15
$order = App\Models\Order::find(15);

echo "Order #" . $order->id . "\n";
echo "================\n";
echo "Snap Token: " . $order->snap_token . "\n";
echo "Payment Status: " . $order->payment_status . "\n";
echo "Created: " . $order->created_at . "\n\n";

// Try to decode the snap token to see transaction details
echo "Attempting to check if snap token was properly created...\n\n";

// Configure Midtrans
\Midtrans\Config::$serverKey = config('midtrans.server_key');
\Midtrans\Config::$isProduction = false;

// The snap_token in database is actually the token itself, not transaction ID
// Let's try to manually create a transaction and see what happens

echo "Testing: Creating a new snap token for this order...\n";

$params = [
    'transaction_details' => [
        '

order_id' => 'ORDER-' . $order->id . '-' . time(), // Add prefix and timestamp
        'gross_amount' => (int) $order->grand_total,
    ],
    'customer_details' => [
        'first_name' => 'Test User',
        'email' => 'test@example.com',
    ],
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($params);
    echo "New Snap Token Generated: " . $snapToken . "\n";
    echo "Order ID used: ORDER-" . $order->id . "-" . time() . "\n\n";
    
    // Now try to get status with the new order ID
    echo "Trying to get status with new order ID...\n";
    $status = \Midtrans\Transaction::status('ORDER-' . $order->id . '-' . time());
    echo json_encode($status, JSON_PRETTY_PRINT);
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
