@extends('layouts.admin')
@section('title', $product->exists ? 'Edit Produk' : 'Tambah Produk')

@section('content')
<h1 class="text-xl font-bold mb-5">{{ $product->exists ? 'Edit Produk' : 'Tambah Produk' }}</h1>

<div class="bg-white rounded-2xl p-6 max-w-2xl">
    <form method="POST"
          action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}"
          enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if($product->exists) @method('PUT') @endif

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
            </div>
            <div>
                <label class="text-sm font-medium">SKU (kosongkan untuk otomatis)</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}"
                       class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
            </div>
        </div>

        <div>
            <label class="text-sm font-medium">Kategori</label>
            <select name="category_id" class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
                <option value="">- Tanpa kategori -</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $product->category_id) == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm font-medium">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm font-medium">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0"
                       class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
            </div>
            <div>
                <label class="text-sm font-medium">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0"
                       class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
            </div>
        </div>

        <div>
            <label class="text-sm font-medium">Gambar Produk</label>
            <input type="file" name="image" accept="image/*" class="w-full mt-1 text-sm">
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" class="w-20 h-20 object-cover rounded-lg mt-2">
            @endif
        </div>

        <label class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
            Produk aktif (tampil di katalog pembeli)
        </label>

        <div class="flex gap-3 pt-2">
            <button class="bg-rose-600 text-white rounded-xl px-5 py-2.5 text-sm font-medium hover:bg-rose-700">Simpan</button>
            <a href="{{ route('admin.products.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-500">Batal</a>
        </div>
    </form>
</div>
@endsection
