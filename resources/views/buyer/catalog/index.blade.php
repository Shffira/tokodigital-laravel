@extends('layouts.buyer')
@section('title', 'Katalog')

@section('content')
<h1 class="text-xl font-bold mb-5">Katalog Produk</h1>

<form method="GET" class="flex gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
           class="flex-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
    <select name="category" onchange="this.form.submit()" class="rounded-xl border border-slate-200 px-4 py-2 text-sm">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button class="bg-rose-600 text-white rounded-xl px-4 py-2 text-sm font-medium">Cari</button>
</form>

<div class="grid grid-cols-4 gap-5">
    @forelse($products as $product)
        <div class="bg-white rounded-2xl p-4">
            <div class="w-full aspect-square bg-slate-100 rounded-xl mb-3 flex items-center justify-center overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-3xl">🛒</span>
                @endif
            </div>
            <div class="text-xs text-slate-400">{{ $product->category->name ?? '-' }}</div>
            <div class="font-semibold text-sm">{{ $product->name }}</div>
            <div class="text-rose-600 font-bold mt-1">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
            <div class="text-xs text-slate-400 mb-3">Stok: {{ $product->stock }}</div>
            <form method="POST" action="{{ route('buyer.cart.add', $product) }}">
                @csrf
                <input type="hidden" name="qty" value="1">
                <button class="w-full bg-rose-600 text-white rounded-xl py-2 text-xs font-medium hover:bg-rose-700 disabled:bg-slate-200"
                        @disabled($product->stock < 1)>
                    {{ $product->stock < 1 ? 'Stok Habis' : '+ Keranjang' }}
                </button>
            </form>
        </div>
    @empty
        <div class="col-span-4 text-center text-slate-400 py-10">Produk tidak ditemukan.</div>
    @endforelse
</div>
<div class="mt-6">{{ $products->links() }}</div>
@endsection
