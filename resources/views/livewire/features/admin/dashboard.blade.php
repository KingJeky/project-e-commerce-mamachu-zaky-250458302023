<div>
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <section class="row">
            <div class="col-12">

                <!-- ==== STAT CARDS ==== -->
                <div class="row">

                    <!-- Users -->
                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body px-4 py-4-5">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stats-icon blue mb-2">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted font-semibold">Users</h6>
                                        <h6 class="font-extrabold mb-0">{{ $users_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body px-4 py-4-5">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stats-icon purple mb-2">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted font-semibold">Products</h6>
                                        <h6 class="font-extrabold mb-0">{{ $products_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Orders -->
                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body px-4 py-4-5">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="stats-icon green mb-2">
                                        <i class="iconly-boldAdd-User"></i>
                                    </div>
                                    <div>
                                        <h6 class="text-muted font-semibold">Orders</h6>
                                        <h6 class="font-extrabold mb-0">{{ $orders_count }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ==== WEEKLY ORDERS CHART ==== -->
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Weekly Orders</h4>
                            </div>
                            <div class="card-body">
                                <div id="weekly-orders-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ==== RECENT ORDERS TABLE ==== -->
                <div class="row">
                    <div class="col-12 mb-3">
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent Orders</h4>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($latest_orders as $order)
                                                <tr>
                                                    <td class="text-bold-500">#{{ $order->id }}</td>
                                                    <td class="text-bold-500">{{ $order->user->name }}</td>
                                                    <td>
                                                        <span class="badge bg-light-{{
                                                            strtolower($order->status) == 'paid' ? 'success' :
                                                            (strtolower($order->status) == 'pending' ? 'warning' : 'danger')
                                                        }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-bold-500">
                                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                                    </td>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No recent orders.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</div>

<!-- ==== CHART SCRIPT ==== -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var weeklyOrdersChart = new ApexCharts(
        document.querySelector("#weekly-orders-chart"),
        {
            series: [{
                name: 'Orders',
                data: {!! $chart_counts !!}
            }],
            chart: {
                type: 'line',
                height: 320,
                toolbar: { show: false }
            },
            stroke: { width: 3 },
            colors: ['#435ebe'],
            xaxis: { categories: {!! $chart_days !!} },
            grid: { strokeDashArray: 4 },
            responsive: [
                {
                    breakpoint: 576,
                    options: { chart: { height: 250 } }
                }
            ]
        }
    );

    weeklyOrdersChart.render();
</script>
