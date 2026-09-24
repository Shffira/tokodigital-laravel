@extends('layouts.buyer')
@section('title', 'Detail Pesanan')

@section('content')
<h1 class="text-xl font-bold mb-5">Pesanan {{ $order->order_code }}</h1>

<div class="bg-white rounded-2xl p-6">
    <div class="mb-4 text-sm text-slate-500 capitalize">Status: <span class="font-medium text-slate-800">{{ str_replace('_',' ', $order->status) }}</span></div>
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
@endsection
