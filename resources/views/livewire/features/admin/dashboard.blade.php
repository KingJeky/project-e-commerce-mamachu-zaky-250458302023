<div class="min-h-screen bg-gradient-to-br from-orange-50 via-red-50 to-yellow-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-heading font-bold text-pop-dark mb-2">
                Dashboard <span class="text-pop-primary">Admin</span>
            </h1>
            <p class="text-gray-600 text-lg">Selamat datang kembali! Berikut ringkasan aktivitas toko Anda.</p>
        </div>

        <!-- ==== STAT CARDS ==== -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Users Card -->
            <div
                class="group bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 relative overflow-hidden border-2 border-transparent hover:border-blue-400">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 z-0"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-users text-white text-2xl"></i>
                        </div>
                        <div class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">
                            Total
                        </div>
                    </div>
                    <h3 class="text-gray-500 font-semibold text-sm uppercase mb-2">Users</h3>
                    <p class="text-4xl font-black text-gray-800">{{ $users_count }}</p>
                </div>
            </div>

            <!-- Products Card -->
            <div
                class="group bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 relative overflow-hidden border-2 border-transparent hover:border-purple-400">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-bl-full -mr-8 -mt-8 z-0"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-box text-white text-2xl"></i>
                        </div>
                        <div class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-xs font-bold">
                            Total
                        </div>
                    </div>
                    <h3 class="text-gray-500 font-semibold text-sm uppercase mb-2">Products</h3>
                    <p class="text-4xl font-black text-gray-800">{{ $products_count }}</p>
                </div>
            </div>

            <!-- Orders Card -->
            <div
                class="group bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-2xl transition-all duration-300 relative overflow-hidden border-2 border-transparent hover:border-green-400">
                <!-- Decorative element -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -mr-8 -mt-8 z-0"></div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-shopping-cart text-white text-2xl"></i>
                        </div>
                        <div class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold">
                            Total
                        </div>
                    </div>
                    <h3 class="text-gray-500 font-semibold text-sm uppercase mb-2">Orders</h3>
                    <p class="text-4xl font-black text-gray-800">{{ $orders_count }}</p>
                </div>
            </div>

        </div>

        <!-- ==== WEEKLY ORDERS CHART ==== -->
        <div class="mb-8">
            <div
                class="bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-shadow duration-300 relative overflow-hidden">
                <!-- Decorative element -->
                <div
                    class="absolute top-0 left-0 w-40 h-40 bg-gradient-to-br from-pop-secondary/20 to-pop-primary/10 rounded-full -ml-20 -mt-20 blur-3xl">
                </div>

                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-2xl font-heading font-bold text-pop-dark mb-1">Weekly Orders</h2>
                            <p class="text-gray-500 text-sm">Grafik pesanan 7 hari terakhir</p>
                        </div>
                        <div class="bg-pop-primary/10 text-pop-primary px-4 py-2 rounded-full text-sm font-bold">
                            <i class="fa-solid fa-chart-line mr-2"></i>Tren
                        </div>
                    </div>
                    <div id="weekly-orders-chart" class="mt-4"></div>
                </div>
            </div>
        </div>

        <!-- ==== RECENT ORDERS TABLE ==== -->
        <div>
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-heading font-bold text-pop-dark mb-1">Recent Orders</h2>
                        <p class="text-gray-500 text-sm">Pesanan terbaru dari pelanggan</p>
                    </div>
                    <div class="bg-orange-100 text-orange-600 px-4 py-2 rounded-full text-sm font-bold">
                        <i class="fa-solid fa-clock mr-2"></i>Latest
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Order ID</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Customer</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Status</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Total</th>
                                <th class="text-left py-4 px-4 text-sm font-bold text-gray-600 uppercase">Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($latest_orders as $order)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <span class="font-bold text-pop-dark">#{{ $order->id }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="font-semibold text-gray-700">{{ $order->user->name }}</span>
                                    </td>
                                    <td class="py-4 px-4">
                                        @php
                                            $statusConfig = [
                                                'new' => ['color' => 'blue', 'label' => 'New'],
                                                'processing' => ['color' => 'purple', 'label' => 'Processing'],
                                                'shipped' => ['color' => 'yellow', 'label' => 'Shipped'],
                                                'delivered' => ['color' => 'green', 'label' => 'Delivered'],
                                                'completed' => ['color' => 'green', 'label' => 'Completed'],
                                                'cancelled' => ['color' => 'red', 'label' => 'Cancelled'],
                                            ];
                                            $status =
                                                $statusConfig[strtolower($order->status ?? 'new')] ??
                                                $statusConfig['new'];
                                        @endphp
                                        <span
                                            class="bg-{{ $status['color'] }}-100 text-{{ $status['color'] }}-600 px-3 py-1 rounded-full text-xs font-bold inline-flex items-center">
                                            <i class="fa-solid fa-circle mr-1"></i>
                                            {{ $status['label'] }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4">
                                        <span class="font-bold text-pop-primary">
                                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 text-gray-600">
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fa-solid fa-inbox text-gray-300 text-5xl mb-4"></i>
                                            <p class="text-gray-500 font-semibold">Belum ada pesanan terbaru</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

<!-- ==== CHART SCRIPT ==== -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var weeklyOrdersChart = new ApexCharts(
            document.querySelector("#weekly-orders-chart"), {
                series: [{
                    name: 'Orders',
                    data: {!! $chart_counts !!}
                }],
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'inherit'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 3,
                    curve: 'smooth'
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                colors: ['#FF6B6B'],
                xaxis: {
                    categories: {!! $chart_days !!},
                    labels: {
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontWeight: 600
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#6B7280',
                            fontSize: '12px',
                            fontWeight: 600
                        }
                    }
                },
                grid: {
                    strokeDashArray: 4,
                    borderColor: '#E5E7EB'
                },
                tooltip: {
                    theme: 'light',
                    style: {
                        fontSize: '14px',
                        fontFamily: 'inherit'
                    },
                    y: {
                        formatter: function(value) {
                            return value + ' orders';
                        }
                    }
                },
                responsive: [{
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 280
                        }
                    }
                }]
            }
        );

        weeklyOrdersChart.render();
    });
</script>
