<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->latest()->paginate(10);
        return view('buyer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === auth()->id(), 403);
        $order->load('items.product');
        return view('buyer.orders.show', compact('order'));
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:delivery,collection'],
            'payment_method' => ['required', 'in:cash,paid'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $cart = session('cart', []);
        abort_if(empty($cart), 400, 'Keranjang kosong.');

        $order = DB::transaction(function () use ($cart, $data) {
            $total = 0;
            $order = Order::create([
                'order_code' => Order::generateCode(),
                'user_id' => auth()->id(),
                'type' => $data['type'],
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
                'note' => $data['note'] ?? null,
                'total' => 0,
            ]);

            foreach ($cart as $productId => $qty) {
                $product = Product::lockForUpdate()->find($productId);
                if (!$product || $qty < 1) continue;

                $qty = min($qty, $product->stock);
                if ($qty < 1) continue;

                $subtotal = $product->price * $qty;
                $total += $subtotal;

                $order->items()->create([
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'qty' => $qty,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);

                $product->adjustStock(-$qty, 'order', auth()->id(), "Pesanan {$order->order_code}");
            }

            $order->update(['total' => $total]);

            return $order;
        });

        session()->forget('cart');

        return redirect()->route('buyer.orders.show', $order)->with('success', 'Pesanan berhasil dibuat.');
    }
}
