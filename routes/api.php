<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Order;

Route::post('/update-order-status', function (Request $request) {
    $orderId = $request->input('order_id');
    $transactionStatus = $request->input('transaction_status');
    
    $order = Order::find($orderId);
    
    if (!$order) {
        return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
    }
    
    // Update order status based on transaction status
    if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
        $order->update([
            'payment_status' => 'paid',
            'status' => 'processing',
        ]);
        
        return response()->json(['status' => 'success', 'message' => 'Order updated successfully']);
    }
    
    return response()->json(['status' => 'pending', 'message' => 'Payment pending']);
});
