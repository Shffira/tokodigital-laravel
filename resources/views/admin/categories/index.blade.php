@extends('layouts.admin')
@section('title', 'Kategori')

@section('content')
<h1 class="text-xl font-bold mb-5">Kategori</h1>

<div class="bg-white rounded-2xl p-6 max-w-lg mb-6">
    <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-3">
        @csrf
        <input type="text" name="name" placeholder="Nama kategori baru" required
               class="flex-1 rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
        <button class="bg-rose-600 text-white rounded-xl px-4 py-2 text-sm font-medium hover:bg-rose-700">Tambah</button>
    </form>
</div>

<div class="bg-white rounded-2xl p-5 max-w-lg">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="py-2 font-medium">Nama</th>
                <th class="font-medium text-right">Jumlah Produk</th>
                <th class="font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categories as $cat)
            <tr class="border-b border-slate-50">
                <td class="py-3">
                    <form method="POST" action="{{ route('admin.categories.update', $cat) }}" class="flex gap-2 items-center">
                        @csrf @method('PUT')
                        <input type="text" name="name" value="{{ $cat->name }}"
                               class="rounded-lg border border-slate-200 px-2 py-1 text-sm">
                        <button class="text-blue-600 text-xs font-medium">Simpan</button>
                    </form>
                </td>
                <td class="text-right">{{ $cat->products_count }}</td>
                <td class="text-right">
                    <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 text-xs font-medium">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3" class="py-6 text-center text-slate-400">Belum ada kategori.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $categories->links() }}</div>
</div>
@endsection
