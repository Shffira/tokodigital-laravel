<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Cart is stored in session as [product_id => qty]

    public function index()
    {
        $cart = session('cart', []);
        $items = [];
        $total = 0;

        foreach ($cart as $productId => $qty) {
            $product = Product::find($productId);
            if (!$product) continue;
            $subtotal = $product->price * $qty;
            $total += $subtotal;
            $items[] = ['product' => $product, 'qty' => $qty, 'subtotal' => $subtotal];
        }

        return view('buyer.cart.index', compact('items', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $qty = max(1, (int) $request->input('qty', 1));
        $cart = session('cart', []);
        $cart[$product->id] = min($product->stock, ($cart[$product->id] ?? 0) + $qty);
        session(['cart' => $cart]);

        return back()->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $qty = (int) $request->input('qty', 1);
        $cart = session('cart', []);

        if ($qty <= 0) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = min($product->stock, $qty);
        }

        session(['cart' => $cart]);
        return back();
    }

    public function remove(Product $product)
    {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}
