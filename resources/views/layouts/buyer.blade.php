<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Belanja') - TokoDigital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: { extend: { fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] } } }
        }
    </script>
    <style>.tabular { font-variant-numeric: tabular-nums; }</style>
</head>
<body class="bg-[#FAF9F5] text-[#1C2321] antialiased">
<header class="bg-white border-b border-slate-200/70 px-8 py-4 flex items-center justify-between sticky top-0 z-10">
    <a href="{{ route('buyer.catalog') }}" class="flex items-center gap-2.5">
        <div class="w-8 h-8 rounded-lg bg-teal-700 flex items-center justify-center text-white">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
        </div>
        <span class="font-bold text-[15px] tracking-tight">TokoDigital</span>
    </a>

    <nav class="flex items-center gap-1 text-[13.5px] font-medium">
        <a href="{{ route('buyer.catalog') }}"
           class="px-3 py-2 rounded-lg {{ request()->routeIs('buyer.catalog') ? 'text-teal-800 bg-teal-50' : 'text-slate-500 hover:bg-slate-50' }}">Katalog</a>
        <a href="{{ route('buyer.orders.index') }}"
           class="px-3 py-2 rounded-lg {{ request()->routeIs('buyer.orders.*') ? 'text-teal-800 bg-teal-50' : 'text-slate-500 hover:bg-slate-50' }}">Pesanan Saya</a>
        <a href="{{ route('buyer.cart.index') }}"
           class="relative flex items-center gap-1.5 px-3 py-2 rounded-lg {{ request()->routeIs('buyer.cart.*') ? 'text-teal-800 bg-teal-50' : 'text-slate-500 hover:bg-slate-50' }}">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 2-1.58l1.65-7.42H5.12"/></svg>
            Keranjang
            @if(count(session('cart', [])) > 0)
                <span class="w-4 h-4 rounded-full bg-teal-700 text-white text-[10px] font-bold flex items-center justify-center">{{ count(session('cart', [])) }}</span>
            @endif
        </a>

        <div class="w-px h-5 bg-slate-200 mx-2"></div>

        <div class="flex items-center gap-2 pl-1">
            <div class="w-7 h-7 rounded-full bg-teal-700 flex items-center justify-center font-semibold text-white text-[11.5px]">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="text-slate-600">{{ auth()->user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="ml-1">
            @csrf
            <button class="px-3 py-2 rounded-lg text-slate-400 hover:bg-slate-50 hover:text-slate-600">Keluar</button>
        </form>
    </nav>
</header>

<main class="max-w-6xl mx-auto px-8 py-8">
    @if (session('success'))
        <div class="mb-5 flex items-center gap-2 rounded-xl bg-teal-50 border border-teal-100 text-teal-800 px-4 py-3 text-[13.5px]">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @yield('content')
</main>
</body>
</html>
