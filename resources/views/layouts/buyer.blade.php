<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Belanja') - TokoDigital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6f5fb] text-slate-800">
<header class="bg-white border-b border-slate-100 px-8 py-4 flex items-center justify-between">
    <a href="{{ route('buyer.catalog') }}" class="font-bold text-lg text-rose-600 flex items-center gap-2">🛍️ TokoDigital</a>
    <nav class="flex items-center gap-6 text-sm font-medium text-slate-600">
        <a href="{{ route('buyer.catalog') }}" class="{{ request()->routeIs('buyer.catalog') ? 'text-rose-600' : '' }}">Katalog</a>
        <a href="{{ route('buyer.orders.index') }}" class="{{ request()->routeIs('buyer.orders.*') ? 'text-rose-600' : '' }}">Pesanan Saya</a>
        <a href="{{ route('buyer.cart.index') }}" class="relative {{ request()->routeIs('buyer.cart.*') ? 'text-rose-600' : '' }}">
            🛒 Keranjang
            @if(count(session('cart', [])) > 0)
                <span class="absolute -top-2 -right-3 bg-rose-600 text-white text-[10px] rounded-full w-4 h-4 flex items-center justify-center">{{ count(session('cart', [])) }}</span>
            @endif
        </a>
        <span class="text-slate-400">|</span>
        <span>{{ auth()->user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-slate-500 hover:text-rose-600">Keluar</button>
        </form>
    </nav>
</header>
<main class="max-w-6xl mx-auto p-8">
    @if (session('success'))
        <div class="mb-4 rounded-xl bg-emerald-50 text-emerald-700 px-4 py-3 text-sm">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
