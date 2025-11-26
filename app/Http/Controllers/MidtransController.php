<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function callback(Request $request)
    {
        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;

            // Find order
            $order = Order::where('id', $orderId)->first();

            if (!$order) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found'
                ], 404);
            }

            // Handle payment status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing'
                    ]);
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing'
                ]);
            } elseif ($transactionStatus == 'pending') {
                $order->update([
                    'payment_status' => 'pending'
                ]);
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->update([
                    'payment_status' => 'failed'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Notification processed'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function checkStatus($orderId)
    {
        try {
            // Find order
            $order = Order::where('id', $orderId)
                ->where('user_id', auth()->id())
                ->first();

            if (!$order) {
                \Log::warning("Midtrans checkStatus: Order not found", ['order_id' => $orderId, 'user_id' => auth()->id()]);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Order not found'
                ], 404);
            }

            \Log::info("Midtrans checkStatus: Checking payment status", [
                'order_id' => $orderId,
                'current_payment_status' => $order->payment_status,
                'current_order_status' => $order->status
            ]);

            // Get status from Midtrans
            $status = \Midtrans\Transaction::status($orderId);

            $transactionStatus = $status->transaction_status;
            $fraudStatus = isset($status->fraud_status) ? $status->fraud_status : null;

            \Log::info("Midtrans API Response", [
                'order_id' => $orderId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $status->payment_type ?? null,
                'gross_amount' => $status->gross_amount ?? null,
                'status_code' => $status->status_code ?? null
            ]);

            $oldPaymentStatus = $order->payment_status;
            $oldOrderStatus = $order->status;

            // Update order status based on transaction status
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'accept') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'processing'
                    ]);
                    \Log::info("Midtrans: Payment captured and accepted", ['order_id' => $orderId]);
                }
            } elseif ($transactionStatus == 'settlement') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing'
                ]);
                \Log::info("Midtrans: Payment settled", ['order_id' => $orderId]);
            } elseif ($transactionStatus == 'pending') {
                $order->update([
                    'payment_status' => 'pending'
                ]);
                \Log::info("Midtrans: Payment pending", ['order_id' => $orderId]);
            } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                $order->update([
                    'payment_status' => 'failed'
                ]);
                \Log::warning("Midtrans: Payment failed/cancelled", [
                    'order_id' => $orderId,
                    'transaction_status' => $transactionStatus
                ]);
            }

            $updatedOrder = $order->fresh();

            \Log::info("Midtrans checkStatus: Order updated", [
                'order_id' => $orderId,
                'old_payment_status' => $oldPaymentStatus,
                'new_payment_status' => $updatedOrder->payment_status,
                'old_order_status' => $oldOrderStatus,
                'new_order_status' => $updatedOrder->status
            ]);

            return response()->json([
                'status' => 'success',
                'payment_status' => $updatedOrder->payment_status,
                'order_status' => $updatedOrder->status,
                'transaction_status' => $transactionStatus,
                'debug_info' => [
                    'fraud_status' => $fraudStatus,
                    'payment_type' => $status->payment_type ?? null,
                    'status_changed' => $oldPaymentStatus !== $updatedOrder->payment_status
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error("Midtrans checkStatus: Exception occurred", [
                'order_id' => $orderId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'debug' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }
}
