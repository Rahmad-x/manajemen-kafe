<x-app-layout>
    <div class="h-full flex flex-col">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
            <div>
                <h3 class="text-xl font-black text-slate-800 flex items-center gap-2">
                    👨‍🍳 Monitor Antrean Dapur
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Daftar pesanan lunas dari kasir yang wajib segera dimasak.</p>
            </div>
            
            <div class="flex items-center gap-2 self-start sm:self-center">
                <span class="text-xs font-bold text-slate-500 bg-slate-50 px-3 py-1.5 rounded-xl border border-gray-100 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                    Total Antrean: <span class="text-slate-800 font-black">{{ count($orders) }} Nota</span>
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold shadow-sm flex items-center gap-2">
                🎉 {{ session('success') }}
            </div>
        @endif

        <div class="flex-1 overflow-y-auto grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 pb-6">
            @forelse($orders as $order)
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between overflow-hidden hover:border-amber-300 hover:shadow-md transition duration-200 group">
                
                <div class="bg-slate-900 text-white p-4 flex justify-between items-center group-hover:bg-amber-500 transition duration-200">
                    <div>
                        <span class="text-[10px] text-slate-400 group-hover:text-amber-950 font-bold block tracking-wider uppercase">PELANGGAN</span>
                        <h4 class="font-black text-lg group-hover:text-slate-950">MEJA #{{ $order->nomor_meja }}</h4>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] text-slate-400 group-hover:text-amber-950 block font-mono">WAKTU PESAN</span>
                        <span class="text-xs font-bold font-mono group-hover:text-slate-950">{{ $order->created_at->format('H:i') }} WIB</span>
                    </div>
                </div>

                <div class="p-4 flex-1 divide-y divide-gray-100">
                    @foreach($order->detailPesanans as $detail)
                    <div class="py-3 first:pt-0 last:pb-0">
                        <div class="flex justify-between items-start gap-4">
                            <div class="min-w-0">
                                <h5 class="font-bold text-sm text-slate-800 truncate">{{ $detail->menu->nama_menu }}</h5>
                                
                                @if($detail->catatan)
                                <p class="text-[11px] text-red-600 bg-red-50 px-2 py-0.5 rounded-md mt-1 inline-block font-medium border border-red-100">
                                    📝 {{ $detail->catatan }}
                                </p>
                                @endif
                            </div>
                            <span class="text-sm font-black text-amber-500 bg-amber-50 px-2.5 py-1 rounded-lg shrink-0 border border-amber-100">
                                x{{ $detail->jumlah }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100 shrink-0">
                    <form action="{{ route('dapur.selesai', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-3 rounded-xl text-xs tracking-wider shadow-sm transition duration-150 flex items-center justify-center gap-1.5">
                            🍳 KOKI SELESAI MASAK
                        </button>
                    </form>
                </div>

            </div>
            @empty
            <div class="col-span-full bg-white rounded-2xl border border-dashed border-gray-300 py-16 text-center flex flex-col items-center justify-center shadow-sm">
                <span class="text-5xl mb-3 animate-bounce">🧼</span>
                <h4 class="font-black text-slate-700 text-sm">Dapur Bersih & Santai</h4>
                <p class="text-xs text-gray-400 mt-1 max-w-xs">Belum ada antrean resep masakan masuk. Semua pelanggan sudah terlayani dengan kenyang!</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>