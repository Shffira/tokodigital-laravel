<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockLog;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('name')->get();
        $logs = StockLog::with(['product', 'user'])->latest()->paginate(20);
        return view('admin.stock.index', compact('products', 'logs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:in,out,adjustment'],
            'qty' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:255'],
        ]);

        $product = Product::findOrFail($data['product_id']);
        $qty = $data['type'] === 'out' ? -abs($data['qty']) : abs($data['qty']);

        $product->adjustStock($qty, $data['type'], auth()->id(), $data['note'] ?? null);

        return back()->with('success', 'Stok berhasil dicatat.');
    }
}
