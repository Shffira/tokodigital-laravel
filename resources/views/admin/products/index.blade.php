@extends('layouts.admin')
@section('title', 'Produk')

@section('content')
<div class="flex items-center justify-between mb-5">
    <h1 class="text-xl font-bold">Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-rose-600 text-white rounded-xl px-4 py-2 text-sm font-medium hover:bg-rose-700">+ Tambah Produk</a>
</div>

<form method="GET" class="mb-4">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/SKU produk..."
           class="w-80 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
</form>

<div class="bg-white rounded-2xl p-5">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="py-2 font-medium">SKU</th>
                <th class="font-medium">Nama</th>
                <th class="font-medium">Kategori</th>
                <th class="font-medium text-right">Harga</th>
                <th class="font-medium text-right">Stok</th>
                <th class="font-medium">Status</th>
                <th class="font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr class="border-b border-slate-50">
                <td class="py-3">{{ $product->sku }}</td>
                <td class="font-medium">{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td class="text-right">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="text-right {{ $product->stock <= 5 ? 'text-rose-600 font-semibold' : '' }}">{{ $product->stock }}</td>
                <td>
                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}">
                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="text-right space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 font-medium">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="py-6 text-center text-slate-400">Belum ada produk.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $products->links() }}</div>
</div>
@endsection
