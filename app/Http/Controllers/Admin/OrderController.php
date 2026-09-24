<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'items'])
            ->when($request->status, fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,diproses,on_the_way,ready,selesai,dibatalkan'],
        ]);

        // If cancelling an order, restock the items.
        if ($data['status'] === 'dibatalkan' && $order->status !== 'dibatalkan') {
            foreach ($order->items as $item) {
                if ($item->product) {
                    $item->product->adjustStock($item->qty, 'in', auth()->id(), "Pembatalan pesanan {$order->order_code}");
                }
            }
        }

        $order->update(['status' => $data['status']]);

        return back()->with('success', 'Status pesanan diperbarui.');
    }
}
