<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Management Kafe</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-slate-900 text-white flex flex-col justify-between hidden md:flex shrink-0">
            <div>
                <div class="h-16 flex items-center justify-center border-b border-slate-800 px-6">
                    <h1 class="text-xl font-bold tracking-wider text-amber-500">☕ Kopi-Tech</h1>
                </div>

                <nav class="mt-6 px-4 space-y-1">
    @if(in_array(auth()->user()->role, ['kasir', 'admin']))
    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg bg-slate-800 text-amber-500">
        <span class="mr-3">📊</span> Sistem POS / Kasir
    </a>
    @endif

    @if(auth()->user()->role == 'admin')
    <a href="{{ route('menus.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <span class="mr-3">🍔</span> Manajemen Menu
    </a>
    @endif

    @if(in_array(auth()->user()->role, ['dapur', 'admin']))
    <a href="{{ route('dapur.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition">
        <span class="mr-3">👨‍🍳</span> Monitor Dapur
    </a>
    @endif
</nav>
            </div>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center justify-between mb-2 px-2">
                    <div class="text-xs text-slate-400">
                        <p class="font-semibold text-slate-200">{{ Auth::user()->name }}</p>
                        <p class="italic">@<span>{{ Auth::user()->email }}</span></p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-xs text-red-400 hover:text-red-300 font-medium py-2 px-2 rounded hover:bg-slate-800 transition">
                        🚪 Keluar Aplikasi
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex flex-col flex-1 min-w-0 overflow-y-auto bg-gray-100">
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 shrink-0">
                <button class="text-gray-500 md:hidden focus:outline-none">🍔</button>
                <div class="text-sm font-medium text-gray-700">
                    Hari ini: <span class="font-bold text-slate-800">{{ date('d M Y') }}</span>
                </div>
            </header>

            <main class="p-6">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>