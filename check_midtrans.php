<?php

require __DIR__ . '/vendor/autoload.php';

// Load Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Configure Midtrans
\Midtrans\Config::$serverKey = config('midtrans.server_key');
\Midtrans\Config::$isProduction = config('midtrans.is_production');

// Check order 15
try {
    echo "Checking Midtrans status for Order ID: 15\n";
    echo "=====================================\n\n";
    
    $status = \Midtrans\Transaction::status('15');
    
    echo "Transaction Status: " . $status->transaction_status . "\n";
    echo "Payment Type: " . ($status->payment_type ?? 'N/A') . "\n";
    echo "Fraud Status: " . ($status->fraud_status ?? 'N/A') . "\n";
    echo "Status Code: " . ($status->status_code ?? 'N/A') . "\n";
    echo "Gross Amount: " . ($status->gross_amount ?? 'N/A') . "\n";
    echo "\n";
    echo "Full Response:\n";
    echo json_encode($status, JSON_PRETTY_PRINT);
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
