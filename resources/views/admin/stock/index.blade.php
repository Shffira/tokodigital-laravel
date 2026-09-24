@extends('layouts.admin')
@section('title', 'Stok')

@section('content')
<h1 class="text-xl font-bold mb-5">Catat Perubahan Stok</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl p-6">
        <h2 class="font-bold mb-4 text-sm">Formulir Stok</h2>
        <form method="POST" action="{{ route('admin.stock.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium">Produk</label>
                <select name="product_id" required class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }} (stok: {{ $p->stock }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-medium">Jenis</label>
                <select name="type" required class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
                    <option value="in">Stok Masuk</option>
                    <option value="out">Stok Keluar</option>
                    <option value="adjustment">Penyesuaian</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-medium">Jumlah</label>
                <input type="number" name="qty" min="1" required class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium">Catatan</label>
                <input type="text" name="note" class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
            </div>
            <button class="w-full bg-rose-600 text-white rounded-xl py-2.5 text-sm font-medium hover:bg-rose-700">Simpan</button>
        </form>
    </div>

    <div class="col-span-2 bg-white rounded-2xl p-6">
        <h2 class="font-bold mb-4 text-sm">Riwayat Stok</h2>
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 border-b border-slate-100">
                    <th class="py-2 font-medium">Produk</th>
                    <th class="font-medium">Jenis</th>
                    <th class="font-medium text-right">Qty</th>
                    <th class="font-medium text-right">Sisa Stok</th>
                    <th class="font-medium">Oleh</th>
                    <th class="font-medium">Tanggal</th>
                </tr>
            </thead>
            <tbody>
            @forelse($logs as $log)
                <tr class="border-b border-slate-50">
                    <td class="py-3">{{ $log->product->name ?? '-' }}</td>
                    <td class="capitalize">{{ $log->type }}</td>
                    <td class="text-right {{ $log->qty < 0 ? 'text-rose-600' : 'text-emerald-600' }}">{{ $log->qty > 0 ? '+' : '' }}{{ $log->qty }}</td>
                    <td class="text-right">{{ $log->stock_after }}</td>
                    <td>{{ $log->user->name ?? 'Sistem' }}</td>
                    <td>{{ $log->created_at->format('d M H:i') }}</td>
                </tr>
            @empty
                <tr><td colspan="6" class="py-6 text-center text-slate-400">Belum ada riwayat stok.</td></tr>
            @endforelse
            </tbody>
        </table>
        <div class="mt-4">{{ $logs->links() }}</div>
    </div>
</div>
@endsection
