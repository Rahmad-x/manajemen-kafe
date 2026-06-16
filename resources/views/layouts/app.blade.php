<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Management Kafe</title>

    <!-- Kompilasi Utama CSS Tailwind & JS Alpine -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50" x-data="{ mobileMenu: false }">
    
    <!-- PEMBUNGKUS UTAMA (Wajib Flex Row agar Sidebar di kiri, Konten di kanan) -->
    <div class="flex h-screen overflow-hidden relative w-full">
        
        <!-- BACKDROP MOBILE -->
        <div x-show="mobileMenu" @click="mobileMenu = false" x-transition 
            class="fixed inset-0 z-40 bg-slate-900/50 md:hidden"></div>
        
        <!-- 1. SIDEBAR NAVIGASI (KIRI - MENTOK KE ATAS LAYAR) -->
        <aside :class="mobileMenu ? 'translate-x-0' : '-translate-x-full'" 
            class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white flex flex-col justify-between transform md:transform-none md:static md:flex transition duration-200 ease-in-out shrink-0">
            <div>
                <div class="h-16 flex items-center justify-between border-b border-slate-800 px-6">
                    <h1 class="text-xl font-bold tracking-wider text-amber-500">☕ Kopi-Tech</h1>
                    <button @click="mobileMenu = false" class="text-slate-400 hover:text-white md:hidden font-bold text-sm">✕</button>
                </div>

                <nav class="mt-6 px-4 space-y-1">
                    @if(in_array(auth()->user()->role, ['kasir', 'admin']))
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ Request::routeIs('dashboard') ? 'bg-slate-800 text-amber-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
                        <span class="mr-3">📊</span> Sistem POS / Kasir
                    </a>
                    @endif

                    @if(auth()->user()->role == 'admin')
                    <a href="{{ route('menus.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ Request::routeIs('menus.*') ? 'bg-slate-800 text-amber-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
                        <span class="mr-3">🍔</span> Manajemen Menu
                    </a>
                    @endif

                    @if(in_array(auth()->user()->role, ['dapur', 'admin']))
                    <a href="{{ route('dapur.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ Request::routeIs('dapur.index') ? 'bg-slate-800 text-amber-500' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }} transition">
                        <span class="mr-3">👨‍🍳</span> Monitor Dapur
                    </a>
                    @endif
                </nav>
            </div>

            <div class="p-4 border-t border-slate-800 hidden md:block">
                <div class="text-xs text-slate-400 px-2">
                    <p class="font-semibold text-slate-200 truncate">{{ Auth::user()->name }}</p>
                    <p class="italic text-[10px]">@<span>{{ Auth::user()->username }}</span></p>
                </div>
            </div>
        </aside>

        <!-- 2. AREA KONTEN UTAMA (KANAN) -->
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden bg-gray-100">
            
            <!-- HEADER BAR (Sekarang posisinya mengalah setelah Sidebar) -->
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 shrink-0 z-30">
                <!-- UPDATE: Menggunakan block md:hidden agar mati total di PC/Laptop -->
                <button @click="mobileMenu = !mobileMenu" class="block md:hidden text-xl p-2 -ml-2 rounded-lg hover:bg-gray-100 text-gray-600 focus:outline-none">
                    🍔
                </button>
                
                <div class="text-sm font-medium text-gray-700 hidden sm:block">
                    Hari ini: <span class="font-bold text-slate-800">{{ date('d M Y') }}</span>
                </div>

                <div class="flex items-center gap-3 ml-auto md:ml-0">
                    <span class="text-xs font-bold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-lg">
                        👤 {{ Auth::user()->name }} (<span class="text-amber-600 font-black">{{ strtoupper(Auth::user()->role) }}</span>)
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-red-600 hover:text-white font-bold bg-red-50 hover:bg-red-600 px-3 py-1.5 rounded-lg border border-red-200 transition duration-150">
                            🚪 Keluar
                        </button>
                    </form>
                </div>
            </header>

            <!-- ISI VIEW HALAMAN -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>
</html>