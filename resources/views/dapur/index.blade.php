<x-app-layout>
    <div class="py-4">
        <div class="flex justify-between items-center mb-6 bg-slate-900 p-4 rounded-xl text-white shadow-sm">
            <div>
                <h2 class="text-xl font-black text-amber-500 tracking-wide">👨‍🍳 MONITOR ANTREAN DAPUR</h2>
                <p class="text-xs text-slate-400 mt-0.5">Daftar menu yang harus segera dimasak berdasarkan urutan waktu masuk.</p>
            </div>
            <div class="text-right text-sm font-semibold">
                Total Antrean: <span class="text-amber-500 font-black text-lg">{{ $orders->count() }}</span> Tiket
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($orders as $order)
            <div class="bg-white rounded-xl shadow-md border-t-4 border-amber-500 flex flex-col justify-between overflow-hidden">
                
                <div class="p-4 bg-slate-50 border-b border-gray-100 flex justify-between items-center">
                    <div>
                        <span class="text-xs font-bold text-gray-400 block">NOMOR MEJA</span>
                        <h4 class="text-xl font-black text-slate-800">Meja #{{ $order->nomor_meja }}</h4>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] bg-amber-100 text-amber-800 font-bold px-2 py-0.5 rounded-full block w-max ml-auto mb-1 animate-pulse">Diproses</span>
                        <span class="text-xs text-gray-500 font-mono">{{ $order->created_at->format('H:i') }} Wita</span>
                    </div>
                </div>

                <div class="p-4 flex-1">
                    <ul class="divide-y divide-gray-100">
                        @foreach($order->detailPesanans as $detail)
                        <li class="py-2.5 flex justify-between items-start">
                            <div class="min-w-0">
                                <p class="font-bold text-slate-800 text-sm break-words">{{ $detail->menu->nama_menu }}</p>
                                @if($detail->catatan)
                                    <p class="text-xs text-red-500 italic mt-0.5">📝 {{ $detail->catatan }}</p>
                                @endif
                            </div>
                            <span class="text-sm font-black text-slate-900 bg-gray-100 px-2 py-1 rounded border border-gray-200 shrink-0">
                                x{{ $detail->jumlah }}
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    <form action="{{ route('dapur.selesai', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-3 rounded-xl shadow-sm transition tracking-wider text-sm flex justify-center items-center gap-2">
                            🍳 Selesai Masak
                        </button>
                    </form>
                </div>

            </div>
            @empty
            <div class="col-span-full bg-white p-12 rounded-xl text-center shadow-sm border border-gray-100">
                <div class="text-5xl mb-3">🧼</div>
                <h4 class="text-lg font-bold text-slate-700">Dapur Bersih & Santai</h4>
                <p class="text-gray-400 text-sm mt-1">Belum ada pesanan masuk yang perlu dimasak saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>