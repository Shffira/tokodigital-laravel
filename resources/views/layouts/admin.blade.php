<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - TokoDigital</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f6f5fb] text-slate-800">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-slate-100 flex flex-col justify-between py-6 px-4">
        <div>
            <div class="flex items-center gap-2 px-2 mb-8">
                <span class="text-2xl">🛍️</span>
                <span class="font-bold text-lg text-rose-600">TokoDigital</span>
            </div>
            <nav class="space-y-1">
                @php
                    $nav = [
                        ['admin.dashboard', 'Live Orders', '🧾'],
                        ['admin.orders.index', 'Order History', '📦'],
                        ['admin.products.index', 'Produk', '🏷️'],
                        ['admin.categories.index', 'Kategori', '🗂️'],
                        ['admin.stock.index', 'Stok', '📊'],
                    ];
                @endphp
                @foreach($nav as [$route, $label, $icon])
                    <a href="{{ route($route) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs($route.'*') ? 'bg-rose-50 text-rose-600' : 'text-slate-500 hover:bg-slate-50' }}">
                        <span>{{ $icon }}</span> {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left px-3 py-2.5 rounded-xl text-sm font-medium text-slate-500 hover:bg-slate-50">🚪 Keluar</button>
        </form>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white border-b border-slate-100 px-8 py-4 flex items-center justify-between">
            <div class="w-80">
                <input type="text" placeholder="Cari..." class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-rose-200">
            </div>
            <div class="flex items-center gap-3">
                <span class="text-sm text-slate-500">{{ auth()->user()->name }}</span>
                <div class="w-9 h-9 rounded-full bg-rose-100 flex items-center justify-center font-semibold text-rose-600">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="p-8 flex-1">
            @if (session('success'))
                <div class="mb-4 rounded-xl bg-emerald-50 text-emerald-700 px-4 py-3 text-sm">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
