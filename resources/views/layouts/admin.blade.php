<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - TokoDigital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                }
            }
        }
    </script>
    <style>
        body { font-feature-settings: "tnum" 1; }
        .tabular { font-variant-numeric: tabular-nums; }
    </style>
</head>
<body class="bg-[#FAF9F5] text-[#1C2321] antialiased">
<div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 shrink-0 bg-white border-r border-slate-200/70 flex flex-col justify-between py-7 px-5">
        <div>
            <div class="flex items-center gap-2.5 px-1 mb-9">
                <div class="w-8 h-8 rounded-lg bg-teal-700 flex items-center justify-center text-white">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <span class="font-bold text-[15px] tracking-tight">TokoDigital</span>
            </div>

            <nav class="space-y-0.5">
                @php
                    $nav = [
                        ['admin.dashboard', 'Live Orders', '<path d="M9 11H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h4m0-11v11m0-11h6m-6 11h6m0-11h4a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-4m0-11V4a2 2 0 0 0-2-2H11a2 2 0 0 0-2 2v7"/>'],
                        ['admin.orders.index', 'Order History', '<rect x="3" y="7" width="18" height="14" rx="2"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/>'],
                        ['admin.products.index', 'Produk', '<path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/>'],
                        ['admin.categories.index', 'Kategori', '<path d="M20 7h-3a2 2 0 0 1-1.4-.6l-1-1A2 2 0 0 0 13.2 4H10a2 2 0 0 0-2 2v1"/><path d="M4 7h16a1 1 0 0 1 1 1v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a1 1 0 0 1 1-1Z"/>'],
                        ['admin.stock.index', 'Stok', '<path d="M3 3v18h18"/><path d="M7 15l4-6 4 4 5-8"/>'],
                    ];
                @endphp
                @foreach($nav as [$route, $label, $iconPath])
                    <a href="{{ route($route) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-[14px] font-medium border-l-2 transition-colors
                              {{ request()->routeIs($route.'*')
                                 ? 'bg-teal-50 text-teal-800 border-teal-700'
                                 : 'text-slate-500 border-transparent hover:bg-slate-50 hover:text-slate-700' }}">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">{!! $iconPath !!}</svg>
                        {{ $label }}
                    </a>
                @endforeach
            </nav>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-[14px] font-medium text-slate-500 hover:bg-slate-50 hover:text-slate-700">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                Keluar
            </button>
        </form>
    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col min-w-0">
        <header class="bg-white border-b border-slate-200/70 px-8 py-4 flex items-center justify-between">
            <div class="relative w-80">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                <input type="text" placeholder="Cari pesanan, produk..." class="w-full rounded-xl border border-slate-200 pl-9 pr-4 py-2 text-[13.5px] focus:outline-none focus:ring-2 focus:ring-teal-100 focus:border-teal-300">
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right leading-tight">
                    <div class="text-[13.5px] font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-[11.5px] text-slate-400">Pedagang</div>
                </div>
                <div class="w-9 h-9 rounded-full bg-teal-700 flex items-center justify-center font-semibold text-white text-[13px]">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="p-8 flex-1">
            @if (session('success'))
                <div class="mb-5 flex items-center gap-2 rounded-xl bg-teal-50 border border-teal-100 text-teal-800 px-4 py-3 text-[13.5px]">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
