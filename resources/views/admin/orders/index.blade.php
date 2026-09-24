@extends('layouts.admin')
@section('title', 'Riwayat Pesanan')

@section('content')
<h1 class="text-xl font-bold mb-5">Riwayat Pesanan</h1>

<form method="GET" class="mb-4 flex gap-3">
    <select name="status" onchange="this.form.submit()" class="rounded-xl border border-slate-200 px-4 py-2 text-sm">
        <option value="">Semua Status</option>
        @foreach(['pending','diproses','on_the_way','ready','selesai','dibatalkan'] as $s)
            <option value="{{ $s }}" @selected(request('status') === $s)>{{ str_replace('_',' ', $s) }}</option>
        @endforeach
    </select>
</form>

<div class="bg-white rounded-2xl p-5">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="py-2 font-medium">Kode</th>
                <th class="font-medium">Pembeli</th>
                <th class="font-medium">Tanggal</th>
                <th class="font-medium">Status</th>
                <th class="font-medium text-right">Total</th>
                <th class="font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr class="border-b border-slate-50">
                <td class="py-3 font-medium">{{ $order->order_code }}</td>
                <td>{{ $order->user->name }}</td>
                <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                <td class="capitalize">{{ str_replace('_',' ', $order->status) }}</td>
                <td class="text-right">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                <td class="text-right">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 font-medium">Detail</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="py-6 text-center text-slate-400">Belum ada pesanan.</td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $orders->links() }}</div>
</div>
@endsection
