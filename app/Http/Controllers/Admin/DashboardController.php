<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders_today' => Order::whereDate('created_at', today())->count(),
            'pending' => Order::where('status', 'pending')->count(),
            'dispatch' => Order::whereIn('status', ['on_the_way', 'diproses'])->count(),
        ];

        $lowStock = Product::where('stock', '<=', 5)->orderBy('stock')->take(5)->get();

        $orders = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'lowStock', 'orders'));
    }
}
