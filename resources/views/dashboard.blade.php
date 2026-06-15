<x-app-layout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-2">Selamat Datang di Sistem Kopi-Tech! 👋</h3>
        <p class="text-gray-600 text-sm">Hak akses Anda saat ini adalah sebagai <span class="font-bold text-amber-600">Administrator</span>. Gunakan menu di sebelah kiri untuk mengelola operasi kafe.</p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="p-6 bg-amber-50 rounded-xl border border-amber-200">
                <p class="text-xs text-amber-700 font-bold uppercase tracking-wider">Total Transaksi Hari Ini</p>
                <p class="text-2xl font-black text-slate-800 mt-1">Rp 0</p>
            </div>
            <div class="p-6 bg-blue-50 rounded-xl border border-blue-200">
                <p class="text-xs text-blue-700 font-bold uppercase tracking-wider">Pesanan Diproses</p>
                <p class="text-2xl font-black text-slate-800 mt-1">0 Pesanan</p>
            </div>
            <div class="p-6 bg-green-50 rounded-xl border border-green-200">
                <p class="text-xs text-green-700 font-bold uppercase tracking-wider">Menu Terlaris</p>
                <p class="text-2xl font-black text-slate-800 mt-1">-</p>
            </div>
        </div>
    </div>
</x-app-layout>