<?php

namespace App\Livewire\Features\Admin;

use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

class Dashboard extends Component
{
    #[Layout('components.layouts.admin')]
    public function render()
    {
        $users_count = User::where('role', 'user')->count();
        $products_count = Product::count();
        $brands_count = Brand::count();
        $orders_count = Order::count();

        // Ambil 5 order terbaru
        $latest_orders = Order::with('user')->latest()->take(5)->get();

        // === WEEKLY ORDER CHART ===
        $days = [];
        $order_counts = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $days[] = $date->format('D'); // Example: Mon, Tue
            $order_counts[] = Order::whereDate('created_at', $date)->count();
        }

        return view('livewire.features.admin.dashboard', [
            'users_count'     => $users_count,
            'products_count'  => $products_count,
            'brands_count'    => $brands_count,
            'orders_count'    => $orders_count,
            'latest_orders'   => $latest_orders,
            'chart_days'      => json_encode($days),
            'chart_counts'    => json_encode($order_counts),
        ]);
    }
}
