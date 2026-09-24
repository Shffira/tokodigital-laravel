@extends('layouts.admin')
@section('title', 'Detail Pesanan')

@section('content')
<h1 class="text-xl font-bold mb-5">Pesanan {{ $order->order_code }}</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2 bg-white rounded-2xl p-6">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-400 border-b border-slate-100">
                    <th class="py-2 font-medium">Produk</th>
                    <th class="font-medium text-right">Qty</th>
                    <th class="font-medium text-right">Harga</th>
                    <th class="font-medium text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                <tr class="border-b border-slate-50">
                    <td class="py-3">{{ $item->product_name }}</td>
                    <td class="text-right">{{ $item->qty }}</td>
                    <td class="text-right">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="pt-4 text-right font-bold">Total</td>
                    <td class="pt-4 text-right font-bold">Rp{{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="bg-white rounded-2xl p-6 space-y-4">
        <div>
            <div class="text-xs text-slate-400">Pembeli</div>
            <div class="font-medium">{{ $order->user->name }}</div>
            <div class="text-sm text-slate-500">{{ $order->user->phone }}</div>
        </div>
        <div>
            <div class="text-xs text-slate-400">Tipe & Pembayaran</div>
            <div class="capitalize font-medium">{{ $order->type }} · {{ $order->payment_method }}</div>
        </div>
        @if($order->note)
        <div>
            <div class="text-xs text-slate-400">Catatan</div>
            <div class="text-sm">{{ $order->note }}</div>
        </div>
        @endif
        <form method="POST" action="{{ route('admin.orders.status', $order) }}">
            @csrf @method('PATCH')
            <label class="text-xs text-slate-400">Ubah Status</label>
            <select name="status" onchange="this.form.submit()" class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
                @foreach(['pending','diproses','on_the_way','ready','selesai','dibatalkan'] as $s)
                    <option value="{{ $s }}" @selected($order->status === $s)>{{ str_replace('_',' ', $s) }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
@endsection
