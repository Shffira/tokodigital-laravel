<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('category')
            ->when($request->search, fn ($q) => $q->where('name', 'like', "%{$request->search}%")
                ->orWhere('sku', 'like', "%{$request->search}%"))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', ['product' => new Product(), 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['sku'] = $data['sku'] ?: strtoupper(Str::random(8));

        $imagePath = $this->storeImage($request);
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        $product = Product::create($data);

        if ($product->stock > 0) {
            $product->stockLogs()->create([
                'user_id' => auth()->id(),
                'type' => 'in',
                'qty' => $product->stock,
                'stock_after' => $product->stock,
                'note' => 'Stok awal produk',
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validateData($request, $product->id);
        $data['sku'] = $data['sku'] ?: $product->sku;

        $imagePath = $this->storeImage($request);
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        $oldStock = $product->stock;
        $product->update($data);

        if ($product->stock != $oldStock) {
            $product->stockLogs()->create([
                'user_id' => auth()->id(),
                'type' => 'adjustment',
                'qty' => $product->stock - $oldStock,
                'stock_after' => $product->stock,
                'note' => 'Penyesuaian manual saat edit produk',
            ]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'sku' => ['nullable', 'string', 'max:50', 'unique:products,sku' . ($ignoreId ? ",$ignoreId" : '')],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]) + ['is_active' => $request->boolean('is_active', true)];
    }

    private function storeImage(Request $request): ?string
    {
        if ($request->hasFile('image')) {
            return $request->file('image')->store('products', 'public');
        }
        return null;
    }
}
