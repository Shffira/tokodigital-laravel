@extends('layouts.admin')
@section('title', 'Live Orders')

@section('content')
<div class="flex items-baseline justify-between mb-6">
    <div>
        <h1 class="text-[22px] font-bold tracking-tight">Live Orders</h1>
        <p class="text-[13.5px] text-slate-400 mt-0.5">{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>
</div>

<div class="grid grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl border border-slate-200/70 pl-5 pr-5 py-4 border-l-4 border-l-teal-600">
        <div class="flex items-center justify-between">
            <span class="text-[13px] text-slate-500 font-medium">Pesanan Hari Ini</span>
            <div class="w-8 h-8 rounded-lg bg-teal-50 flex items-center justify-center text-teal-700">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold tabular mt-3">{{ $stats['orders_today'] }}</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/70 pl-5 pr-5 py-4 border-l-4 border-l-amber-500">
        <div class="flex items-center justify-between">
            <span class="text-[13px] text-slate-500 font-medium">Menunggu Diproses</span>
            <div class="w-8 h-8 rounded-lg bg-amber-50 flex items-center justify-center text-amber-600">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold tabular mt-3">{{ $stats['pending'] }}</div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/70 pl-5 pr-5 py-4 border-l-4 border-l-indigo-500">
        <div class="flex items-center justify-between">
            <span class="text-[13px] text-slate-500 font-medium">Dalam Pengiriman</span>
            <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center text-indigo-600">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><path d="M16 8h4l3 3v5h-7V8Z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
        </div>
        <div class="text-3xl font-bold tabular mt-3">{{ $stats['dispatch'] }}</div>
    </div>
</div>

@if($lowStock->count())
<div class="flex items-center justify-between gap-4 rounded-2xl border border-amber-200 bg-amber-50/60 pl-4 pr-4 py-3.5 mb-6">
    <div class="flex items-center gap-3">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-amber-600 shrink-0"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <span class="text-[13.5px] text-amber-900">
            <span class="font-semibold">Stok menipis:</span> {{ $lowStock->pluck('name')->join(', ') }}
        </span>
    </div>
    <a href="{{ route('admin.stock.index') }}" class="shrink-0 text-[12.5px] font-semibold text-amber-900 bg-white border border-amber-200 rounded-lg px-3 py-1.5 hover:bg-amber-100/60">
        Kelola stok →
    </a>
</div>
@endif

<div class="bg-white rounded-2xl border border-slate-200/70">
    <div class="flex items-center justify-between px-6 pt-5 pb-4">
        <h2 class="font-bold text-[15px]">Pesanan Terbaru</h2>
        <a href="{{ route('admin.orders.index') }}" class="text-[13px] font-semibold text-teal-700 hover:text-teal-800">Lihat semua →</a>
    </div>
    <table class="w-full text-[13.5px]">
        <thead>
            <tr class="text-left text-slate-400 border-y border-slate-100">
                <th class="py-2.5 px-6 font-medium text-[12px] uppercase tracking-wide">Kode</th>
                <th class="font-medium text-[12px] uppercase tracking-wide">Pembeli</th>
                <th class="font-medium text-[12px] uppercase tracking-wide">Pembayaran</th>
                <th class="font-medium text-[12px] uppercase tracking-wide">Tipe</th>
                <th class="font-medium text-[12px] uppercase tracking-wide">Status</th>
                <th class="font-medium text-[12px] uppercase tracking-wide text-right px-6">Total</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr class="border-b border-slate-50 last:border-0">
                <td class="py-3.5 px-6 font-semibold">{{ $order->order_code }}</td>
                <td>{{ $order->user->name }}</td>
                <td class="capitalize text-slate-500">{{ $order->payment_method }}</td>
                <td class="capitalize text-slate-500">{{ $order->type }}</td>
                <td>
                    @php
                        $statusStyles = [
                            'pending' => 'bg-amber-50 text-amber-700',
                            'diproses' => 'bg-indigo-50 text-indigo-700',
                            'on_the_way' => 'bg-indigo-50 text-indigo-700',
                            'ready' => 'bg-teal-50 text-teal-700',
                            'selesai' => 'bg-emerald-50 text-emerald-700',
                            'dibatalkan' => 'bg-rose-50 text-rose-700',
                        ];
                    @endphp
                    <span class="px-2.5 py-1 rounded-md text-[12px] font-semibold {{ $statusStyles[$order->status] ?? 'bg-slate-100 text-slate-600' }}">
                        {{ str_replace('_', ' ', $order->status) }}
                    </span>
                </td>
                <td class="text-right px-6 font-semibold tabular">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
            </tr>
        @empty
            <tr><td colspan="6" class="py-10 text-center text-slate-400">Belum ada pesanan.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="h-2"></div>
</div>
@endsection
