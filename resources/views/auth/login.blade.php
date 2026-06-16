<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Kopi-Tech</title>

    <!-- Memastikan Aset Kompilasi Tailwind CSS Terpasang Sempurna -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased">
    
    <div class="flex min-h-screen">
        
        <!-- ========================================================== -->
        <!-- SISI KIRI: BRANDING PROMO PREMIUM (Hanya Muncul di PC/Laptop) -->
        <!-- ========================================================== -->
        <div class="hidden lg:flex w-1/2 bg-slate-900 items-center justify-center p-12 relative overflow-hidden">
            <!-- Dekorasi Efektif Lampu Neon Kopi -->
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
            
            <div class="max-w-md text-center z-10">
                <span class="text-7xl block mb-4 animate-bounce">☕</span>
                <h1 class="text-4xl font-black text-amber-500 tracking-wider uppercase mb-2">Kopi-Tech</h1>
                <p class="text-slate-400 text-sm font-medium leading-relaxed">Sistem POS Kassa Kasir, Manajemen Restoran, dan Monitor Antrean Dapur Terintegrasi Real-Time.</p>
                
                <div class="mt-12 pt-6 border-t border-slate-800/80 text-[11px] text-slate-500 font-mono tracking-widest uppercase">
                    Tugas Akhir Pemrograman Web II • Kelompok Rahmad
                </div>
            </div>
        </div>

        <!-- ========================================================== -->
        <!-- SISI KANAN: FORM CARD UTAMA LOGIN (RESPONSIF SMARTPHONE) -->
        <!-- ========================================================== -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-white">
            <div class="w-full max-w-md">
                
                <!-- Identitas Logo Khusus Tampilan HP -->
                <div class="text-center lg:text-left mb-8">
                    <span class="text-5xl lg:hidden block mb-3">☕</span>
                    <h2 class="text-2xl font-black text-slate-950 tracking-tight">Selamat Datang Kembali</h2>
                    <p class="text-xs text-gray-400 mt-1">Silakan ketik akun kassa kasir atau koki Anda untuk memproses transaksi.</p>
                </div>

                <!-- Notifikasi Flash Error Jika Username/Password Salah -->
                @if ($errors->any())
                    <div class="mb-5 p-3.5 bg-red-50 border border-red-200 text-red-700 rounded-xl text-xs font-bold shadow-sm">
                        <ul class="space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>⚠️ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Login (Menggunakan Atribut Username Sesuai Validasi Sistem) -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- 1. Input Lapisan Username -->
             <div class="mb-4">
                        <label for="username" class="block text-[11px] font-black text-slate-500 tracking-wider uppercase mb-1.5">Username atau Email Akun</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 text-xs">👤</span>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus placeholder="Masukkan username atau email Anda..."
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition duration-150">
                        </div>
                    </div>

                    <!-- 2. Input Lapisan Kata Sandi + Fitur Intip Mata -->
                    <div class="mb-5">
                        <div class="flex justify-between items-center mb-1.5">
                            <label for="password" class="block text-[11px] font-black text-slate-500 tracking-wider uppercase">Kata Sandi</label>
                            
                            <!-- BARU: FITUR TAUTAN RESET LUPA PASSWORD -->
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-amber-600 hover:text-amber-700 hover:underline transition">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>
                        
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 text-gray-400 text-xs">🔒</span>
                            <input type="password" id="password" name="password" required placeholder="••••••••"
                                class="w-full pl-10 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl text-xs font-bold text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition duration-150">
                            
                            <!-- BARU: TOMBOL SAKTI TOGGLE LIHAT PASSWORD LIVE -->
                            <button type="button" id="btn-toggle-password" class="absolute inset-y-0 right-0 flex items-center pr-4 text-sm text-gray-400 hover:text-slate-800 transition focus:outline-none" title="Tampilkan Kata Sandi">
                                👁️
                            </button>
                        </div>
                    </div>

                    <!-- 3. Kotak Centang Ingat Sesi -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-amber-500 border-gray-300 rounded focus:ring-amber-500/30 cursor-pointer">
                            <span class="ml-2 text-[11px] font-bold text-gray-500">Ingat Sesi Login Saya</span>
                        </label>
                    </div>

                    <!-- 4. Tombol Submit Utama Eksekusi Login -->
                    <button type="submit" class="w-full bg-slate-900 hover:bg-amber-500 hover:text-slate-950 text-white font-black py-3.5 rounded-xl text-xs tracking-widest shadow-md transition duration-150 uppercase">
                        🚀 MASUK KE SISTEM
                    </button>
                </form>
            </div>
        </div>

    </div>

    <!-- JAVASCRIPT INDEPENDEN UNTUK FITUR TAMPIL / SEMBUNYIKAN PASSWORD -->
    <script>
        const passwordField = document.getElementById('password');
        const toggleBtn = document.getElementById('btn-toggle-password');

        toggleBtn.addEventListener('click', function() {
            // Evaluasi tipe input password secara real-time
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                this.innerText = '🙈'; // Berubah jadi emoji tutup mata saat password kelihatan
                this.title = 'Sembunyikan Kata Sandi';
            } else {
                passwordField.type = 'password';
                this.innerText = '👁️'; // Berubah kembali jadi mata terbuka saat disembunyikan
                this.title = 'Tampilkan Kata Sandi';
            }
        });
    </script>
</body>
</html>