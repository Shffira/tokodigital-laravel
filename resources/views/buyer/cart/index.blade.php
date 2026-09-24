@extends('layouts.buyer')
@section('title', 'Keranjang')

@section('content')
<h1 class="text-xl font-bold mb-5">Keranjang Belanja</h1>

<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2 bg-white rounded-2xl p-6">
        @forelse($items as $row)
            <div class="flex items-center justify-between py-3 border-b border-slate-50">
                <div>
                    <div class="font-medium text-sm">{{ $row['product']->name }}</div>
                    <div class="text-xs text-slate-400">Rp{{ number_format($row['product']->price, 0, ',', '.') }} / item</div>
                </div>
                <div class="flex items-center gap-3">
                    <form method="POST" action="{{ route('buyer.cart.update', $row['product']) }}" class="flex items-center gap-2">
                        @csrf @method('PATCH')
                        <input type="number" name="qty" value="{{ $row['qty'] }}" min="0" max="{{ $row['product']->stock }}"
                               class="w-16 rounded-lg border border-slate-200 px-2 py-1 text-sm" onchange="this.form.submit()">
                    </form>
                    <div class="font-medium text-sm w-24 text-right">Rp{{ number_format($row['subtotal'], 0, ',', '.') }}</div>
                    <form method="POST" action="{{ route('buyer.cart.remove', $row['product']) }}">
                        @csrf @method('DELETE')
                        <button class="text-rose-600 text-xs font-medium">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="text-center text-slate-400 py-10">Keranjang masih kosong.</div>
        @endforelse
    </div>

    <div class="bg-white rounded-2xl p-6 h-fit">
        <div class="flex justify-between text-sm mb-4">
            <span class="text-slate-500">Total</span>
            <span class="font-bold text-lg">Rp{{ number_format($total, 0, ',', '.') }}</span>
        </div>
        @if(count($items))
        <form method="POST" action="{{ route('buyer.checkout') }}" class="space-y-3">
            @csrf
            <div>
                <label class="text-xs text-slate-400">Tipe</label>
                <select name="type" class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
                    <option value="delivery">Delivery</option>
                    <option value="collection">Ambil Sendiri</option>
                </select>
            </div>
            <div>
                <label class="text-xs text-slate-400">Pembayaran</label>
                <select name="payment_method" class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
                    <option value="cash">Cash</option>
                    <option value="paid">Sudah Dibayar</option>
                </select>
            </div>
            <div>
                <label class="text-xs text-slate-400">Catatan (opsional)</label>
                <input type="text" name="note" class="w-full mt-1 rounded-xl border border-slate-200 px-4 py-2 text-sm">
            </div>
            <button class="w-full bg-rose-600 text-white rounded-xl py-2.5 text-sm font-medium hover:bg-rose-700">Checkout</button>
        </form>
        @endif
    </div>
</div>
@endsection
