@extends('layout.admin')

@section('style')
    <style>
        .admin-hero {
            align-items: center;
            background: #ffffff;
            border: 1px solid #e7ebf0;
            border-left: 4px solid #5969ff;
            border-radius: 6px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 22px;
            padding: 20px 22px;
        }

        .admin-hero h3 {
            color: #242934;
            font-size: 22px;
            font-weight: 700;
            margin: 0 0 6px;
        }

        .admin-hero p {
            color: #697386;
            margin: 0;
        }

        .metric-card,
        .panel-card {
            background: #ffffff;
            border: 1px solid #e7ebf0;
            border-radius: 6px;
            box-shadow: 0 8px 20px rgba(28, 39, 60, 0.05);
            margin-bottom: 22px;
        }

        .metric-card {
            min-height: 122px;
            padding: 18px;
        }

        .metric-top {
            align-items: center;
            display: flex;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .metric-label {
            color: #6b7280;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .metric-value {
            color: #1f2937;
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
            margin: 0;
        }

        .metric-note {
            color: #7b8494;
            font-size: 13px;
            margin-top: 8px;
        }

        .metric-icon {
            align-items: center;
            border-radius: 6px;
            color: #fff;
            display: flex;
            height: 38px;
            justify-content: center;
            width: 38px;
        }

        .bg-indigo { background: #5969ff; }
        .bg-emerald { background: #23a455; }
        .bg-amber { background: #d89b1d; }
        .bg-rose { background: #d9485f; }
        .bg-cyan { background: #168b95; }
        .bg-slate { background: #536173; }

        .panel-header {
            align-items: center;
            border-bottom: 1px solid #eef1f5;
            display: flex;
            justify-content: space-between;
            padding: 16px 18px;
        }

        .panel-title {
            color: #242934;
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }

        .panel-body {
            padding: 18px;
        }

        .chart-wrap {
            height: 310px;
            position: relative;
        }

        .chart-wrap-sm {
            height: 250px;
            position: relative;
        }

        .quick-link {
            align-items: center;
            border: 1px solid #e2e7ee;
            border-radius: 6px;
            color: #242934;
            display: flex;
            font-weight: 600;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 12px 14px;
        }

        .quick-link:hover {
            background: #f8fafc;
            color: #242934;
            text-decoration: none;
        }

        .status-dot {
            border-radius: 50%;
            display: inline-block;
            height: 8px;
            margin-right: 7px;
            width: 8px;
        }
    </style>
@endsection

@section('content')
    <div class="admin-hero">
        <div>
            <h3>Store Overview</h3>
            <p>Orders, sales, product stock, and customer activity at a glance.</p>
        </div>
        <a href="{{ route('order.index') }}" class="btn btn-primary">View Orders</a>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Total Orders</span>
                    <span class="metric-icon bg-indigo"><i class="fas fa-shopping-cart"></i></span>
                </div>
                <p class="metric-value">{{ $totalOrders }}</p>
                <div class="metric-note">{{ $paidOrders }} paid orders</div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Paid Revenue</span>
                    <span class="metric-icon bg-emerald"><i class="fas fa-dollar-sign"></i></span>
                </div>
                <p class="metric-value">${{ number_format($totalRevenue, 2) }}</p>
                <div class="metric-note">Confirmed Stripe payments</div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Pending Orders</span>
                    <span class="metric-icon bg-amber"><i class="fas fa-clock"></i></span>
                </div>
                <p class="metric-value">{{ $pendingOrders }}</p>
                <div class="metric-note">Needs payment confirmation</div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="metric-card">
                <div class="metric-top">
                    <span class="metric-label">Stock Alerts</span>
                    <span class="metric-icon bg-rose"><i class="fas fa-exclamation-triangle"></i></span>
                </div>
                <p class="metric-value">{{ $lowStockCount }}</p>
                <div class="metric-note">Products at 5 units or below</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12">
            <div class="panel-card">
                <div class="panel-header">
                    <h5 class="panel-title">Revenue and Orders</h5>
                    <span class="text-muted">Last 6 months</span>
                </div>
                <div class="panel-body">
                    <div class="chart-wrap">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12">
            <div class="panel-card">
                <div class="panel-header">
                    <h5 class="panel-title">Order Status</h5>
                </div>
                <div class="panel-body">
                    <div class="chart-wrap-sm">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12">
            <div class="panel-card">
                <div class="panel-header">
                    <h5 class="panel-title">Recent Orders</h5>
                    <a href="{{ route('order.index') }}" class="btn btn-sm btn-outline-primary">Open Orders</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentOrders as $order)
                                    <tr>
                                        <td><a href="{{ route('order.show', $order->id) }}">#{{ $order->id }}</a></td>
                                        <td>{{ $order->customer_name ?? 'Guest' }}</td>
                                        <td>{{ strtoupper($order->currency) }} {{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No orders yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel-card">
                <div class="panel-header">
                    <h5 class="panel-title">Low Stock Products</h5>
                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-outline-primary">Manage Stock</a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Alert</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lowStockProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <span class="badge badge-{{ $product->stock <= 0 ? 'danger' : 'warning' }}">
                                                {{ $product->stock <= 0 ? 'Out of stock' : 'Low stock' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No low stock products.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12">
            <div class="panel-card">
                <div class="panel-header">
                    <h5 class="panel-title">Reports</h5>
                </div>
                <div class="panel-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span><span class="status-dot bg-cyan"></span>Products</span>
                        <strong>{{ $totalProducts }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span><span class="status-dot bg-slate"></span>Categories</span>
                        <strong>{{ $totalCategories }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span><span class="status-dot bg-indigo"></span>Reviews</span>
                        <strong>{{ $totalReviews }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><span class="status-dot bg-emerald"></span>Messages</span>
                        <strong>{{ $totalMessages }}</strong>
                    </div>
                </div>
            </div>

            <div class="panel-card">
                <div class="panel-header">
                    <h5 class="panel-title">Quick Actions</h5>
                </div>
                <div class="panel-body">
                    <a class="quick-link" href="{{ route('order.index') }}"><span><i class="fas fa-shopping-cart mr-2"></i>Manage Orders</span><i class="fas fa-angle-right"></i></a>
                    <a class="quick-link" href="{{ route('product.index') }}"><span><i class="fas fa-box mr-2"></i>Manage Products</span><i class="fas fa-angle-right"></i></a>
                    <a class="quick-link" href="{{ route('contact.index') }}"><span><i class="fas fa-envelope mr-2"></i>View Messages</span><i class="fas fa-angle-right"></i></a>
                    <a class="quick-link" href="{{ route('review.index') }}"><span><i class="fas fa-star mr-2"></i>View Reviews</span><i class="fas fa-angle-right"></i></a>
                </div>
            </div>

            <div class="panel-card">
                <div class="panel-header">
                    <h5 class="panel-title">Top Products</h5>
                </div>
                <div class="panel-body">
                    @forelse ($topProducts as $product)
                        <div class="d-flex justify-content-between border-bottom py-2">
                            <span>{{ $product->product_name }}</span>
                            <strong>{{ $product->sold_qty }} sold</strong>
                        </div>
                    @empty
                        <p class="text-muted mb-0">No paid product sales yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/charts/charts-bundle/Chart.bundle.js') }}"></script>
    <script>
        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels),
                datasets: [{
                    type: 'line',
                    label: 'Revenue',
                    data: @json($monthlyRevenueData),
                    borderColor: '#23a455',
                    backgroundColor: 'rgba(35, 164, 85, 0.12)',
                    yAxisID: 'revenue',
                    lineTension: 0.25,
                    pointRadius: 3
                }, {
                    label: 'Orders',
                    data: @json($monthlyOrderData),
                    backgroundColor: '#5969ff',
                    borderColor: '#5969ff',
                    yAxisID: 'orders'
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: { position: 'bottom' },
                scales: {
                    yAxes: [{
                        id: 'revenue',
                        position: 'left',
                        ticks: { beginAtZero: true }
                    }, {
                        id: 'orders',
                        position: 'right',
                        gridLines: { drawOnChartArea: false },
                        ticks: { beginAtZero: true, precision: 0 }
                    }]
                }
            }
        });

        var statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: @json($orderStatusLabels),
                datasets: [{
                    data: @json($orderStatusData),
                    backgroundColor: ['#23a455', '#d89b1d', '#d9485f'],
                    borderWidth: 0
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: { position: 'bottom' },
                cutoutPercentage: 62
            }
        });
    </script>
@endsection
