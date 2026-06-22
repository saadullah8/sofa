@extends('layout.admin')

@section('style')
    <style>
        .dashboard-card {
            border: 0;
            border-radius: 6px;
            box-shadow: 0 6px 18px rgba(31, 45, 61, 0.08);
        }

        .dashboard-card .metric-label {
            color: #6c757d;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .dashboard-card .metric-value {
            color: #252525;
            font-size: 28px;
            font-weight: 700;
            line-height: 1.1;
            margin: 0;
        }

        .metric-icon {
            align-items: center;
            border-radius: 6px;
            color: #fff;
            display: flex;
            height: 42px;
            justify-content: center;
            width: 42px;
        }

        .metric-blue { background: #2b7cff; }
        .metric-green { background: #2e9f68; }
        .metric-amber { background: #d89b1d; }
        .metric-red { background: #d94b4b; }
        .metric-slate { background: #495568; }
        .metric-teal { background: #178f86; }

        .section-title {
            color: #252525;
            font-size: 17px;
            font-weight: 700;
            margin: 0;
        }

        .quick-action {
            border: 1px solid #dfe3e8;
            border-radius: 6px;
            color: #252525;
            display: block;
            font-weight: 600;
            padding: 12px 14px;
        }

        .quick-action:hover {
            background: #f7f9fb;
            color: #252525;
            text-decoration: none;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Total Orders</div>
                        <p class="metric-value">{{ $totalOrders }}</p>
                    </div>
                    <div class="metric-icon metric-blue"><i class="fas fa-shopping-cart"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Paid Revenue</div>
                        <p class="metric-value">${{ number_format($totalRevenue, 2) }}</p>
                    </div>
                    <div class="metric-icon metric-green"><i class="fas fa-dollar-sign"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Pending Orders</div>
                        <p class="metric-value">{{ $pendingOrders }}</p>
                    </div>
                    <div class="metric-icon metric-amber"><i class="fas fa-clock"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Stock Alerts</div>
                        <p class="metric-value">{{ $lowStockCount }}</p>
                    </div>
                    <div class="metric-icon metric-red"><i class="fas fa-exclamation-triangle"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Products</div>
                        <p class="metric-value">{{ $totalProducts }}</p>
                    </div>
                    <div class="metric-icon metric-slate"><i class="fas fa-box"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Categories</div>
                        <p class="metric-value">{{ $totalCategories }}</p>
                    </div>
                    <div class="metric-icon metric-teal"><i class="fas fa-tags"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Reviews</div>
                        <p class="metric-value">{{ $totalReviews }}</p>
                    </div>
                    <div class="metric-icon metric-blue"><i class="fas fa-star"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="metric-label">Messages</div>
                        <p class="metric-value">{{ $totalMessages }}</p>
                    </div>
                    <div class="metric-icon metric-green"><i class="fas fa-envelope"></i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="section-title">Recent Orders</h5>
                    <a href="{{ route('order.index') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="section-title">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a class="quick-action mb-2" href="{{ route('order.index') }}"><i class="fas fa-shopping-cart mr-2"></i>Manage Orders</a>
                    <a class="quick-action mb-2" href="{{ route('product.index') }}"><i class="fas fa-box mr-2"></i>Manage Products</a>
                    <a class="quick-action mb-2" href="{{ route('contact.index') }}"><i class="fas fa-envelope mr-2"></i>View Messages</a>
                    <a class="quick-action" href="{{ route('review.index') }}"><i class="fas fa-star mr-2"></i>View Reviews</a>
                </div>
            </div>

            <div class="card dashboard-card">
                <div class="card-header">
                    <h5 class="section-title">Top Products</h5>
                </div>
                <div class="card-body">
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

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card dashboard-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="section-title">Low Stock Products</h5>
                    <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary">Products</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
    </div>
@endsection
