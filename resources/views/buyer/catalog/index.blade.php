@extends('layouts.buyer')
@section('title', 'Katalog')

@section('content')
<div class="mb-6">
    <h1 class="text-[22px] font-bold tracking-tight">Katalog Produk</h1>
    <p class="text-[13.5px] text-slate-400 mt-0.5">{{ $products->total() }} produk tersedia</p>
</div>

<form method="GET" class="flex gap-3 mb-7">
    <div class="relative flex-1">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
               class="w-full rounded-xl border border-slate-200 pl-9 pr-4 py-2.5 text-[13.5px] focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-300">
    </div>
    <select name="category" onchange="this.form.submit()"
            class="rounded-xl border border-slate-200 px-4 py-2.5 text-[13.5px] focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-300">
        <option value="">Semua Kategori</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
        @endforeach
    </select>
    <button class="bg-teal-700 text-white rounded-xl px-5 py-2.5 text-[13.5px] font-semibold hover:bg-teal-800">Cari</button>
</form>

<div class="grid grid-cols-4 gap-5">
    @forelse($products as $product)
        <div class="bg-white rounded-2xl border border-slate-200/70 overflow-hidden flex flex-col">
            <div class="w-full aspect-square bg-slate-50 flex items-center justify-center p-6">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain">
                @else
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="text-slate-300"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 2-1.58l1.65-7.42H5.12"/></svg>
                @endif
            </div>
            <div class="p-4 flex flex-col flex-1">
                <div class="text-[11.5px] uppercase tracking-wide text-slate-400 font-medium">{{ $product->category->name ?? '-' }}</div>
                <div class="font-semibold text-[14.5px] mt-0.5 leading-snug">{{ $product->name }}</div>
                <div class="text-teal-700 font-bold text-[16px] mt-2 tabular">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                <div class="text-[12px] text-slate-400 mb-3">Stok: {{ $product->stock }}</div>
                <form method="POST" action="{{ route('buyer.cart.add', $product) }}" class="mt-auto">
                    @csrf
                    <input type="hidden" name="qty" value="1">
                    <button class="w-full rounded-xl py-2.5 text-[13px] font-semibold transition-colors
                                   {{ $product->stock < 1
                                      ? 'bg-slate-100 text-slate-400 cursor-not-allowed'
                                      : 'bg-teal-700 text-white hover:bg-teal-800' }}"
                            @disabled($product->stock < 1)>
                        {{ $product->stock < 1 ? 'Stok Habis' : '+ Keranjang' }}
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-4 text-center text-slate-400 py-16">Produk tidak ditemukan.</div>
    @endforelse
</div>

<div class="mt-7">{{ $products->links() }}</div>
@endsection
