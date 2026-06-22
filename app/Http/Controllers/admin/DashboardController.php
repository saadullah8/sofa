<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lowStockLimit = 5;

        $data=[
            'heading'=>'Dashboard',
            'title'=>'Dashboard',
            'active'=>'Dashboard',
            'totalOrders' => Order::count(),
            'paidOrders' => Order::where('payment_status', 'paid')->count(),
            'pendingOrders' => Order::where('payment_status', '!=', 'paid')->count(),
            'totalRevenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'lowStockCount' => Product::where('stock', '<=', $lowStockLimit)->count(),
            'totalReviews' => Review::count(),
            'totalMessages' => Contact::count(),
            'recentOrders' => Order::latest()->take(6)->get(),
            'lowStockProducts' => Product::where('stock', '<=', $lowStockLimit)
                ->orderBy('stock')
                ->take(8)
                ->get(),
            'topProducts' => OrderItem::selectRaw('product_name, SUM(quantity) as sold_qty, SUM(line_total) as sold_total')
                ->whereHas('order', function ($query) {
                    $query->where('payment_status', 'paid');
                })
                ->groupBy('product_name')
                ->orderByDesc('sold_qty')
                ->take(5)
                ->get(),
        ];
    return view('admin.dashboard.dashboard',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
