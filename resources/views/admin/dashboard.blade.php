@extends('layouts.admin')
@section('title', 'Live Orders')

@section('content')
<h1 class="text-xl font-bold mb-5">Live Orders</h1>

<div class="grid grid-cols-3 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center text-xl">🧾</div>
        <div>
            <div class="text-2xl font-bold">{{ $stats['orders_today'] }}</div>
            <div class="text-sm text-slate-500">Pesanan Hari Ini</div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl">⏳</div>
        <div>
            <div class="text-2xl font-bold">{{ $stats['pending'] }}</div>
            <div class="text-sm text-slate-500">Menunggu Diproses</div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center text-xl">🚚</div>
        <div>
            <div class="text-2xl font-bold">{{ $stats['dispatch'] }}</div>
            <div class="text-sm text-slate-500">Dalam Pengiriman</div>
        </div>
    </div>
</div>

@if($lowStock->count())
<div class="bg-rose-50 border border-rose-100 rounded-2xl p-4 mb-8 text-sm text-rose-700">
    ⚠️ Stok menipis: {{ $lowStock->pluck('name')->join(', ') }}.
    <a href="{{ route('admin.stock.index') }}" class="underline font-medium">Kelola stok</a>
</div>
@endif

<div class="bg-white rounded-2xl p-5">
    <div class="flex items-center justify-between mb-4">
        <h2 class="font-bold">Pesanan Terbaru</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-rose-600 font-medium">Lihat semua →</a>
    </div>
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="py-2 font-medium">Kode</th>
                <th class="font-medium">Pembeli</th>
                <th class="font-medium">Pembayaran</th>
                <th class="font-medium">Tipe</th>
                <th class="font-medium">Status</th>
                <th class="font-medium text-right">Total</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr class="border-b border-slate-50">
                <td class="py-3 font-medium">{{ $order->order_code }}</td>
                <td>{{ $order->user->name }}</td>
                <td class="capitalize">{{ $order->payment_method }}</td>
                <td class="capitalize">{{ $order->type }}</td>
                <td>
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $order->status === 'selesai' ? 'bg-emerald-100 text-emerald-700' :
                           ($order->status === 'dibatalkan' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </td>
                <td class="text-right font-medium">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="py-6 text-center text-slate-400">Belum ada pesanan.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
