<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        $data = [
            'heading' => 'Orders',
            'title' => 'View Orders',
            'active' => 'order',
            'orders' => $orders,
        ];

        return view('admin.order.index', $data);
    }

    public function show(string $id)
    {
        $order = Order::with('items')->findOrFail($id);

        $data = [
            'heading' => 'Order Details',
            'title' => 'Order Details',
            'active' => 'order',
            'order' => $order,
        ];

        return view('admin.order.detail', $data);
    }
}
