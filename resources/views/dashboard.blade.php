<x-app-layout>
    <div class="flex flex-col lg:flex-row gap-6 h-[calc(100vh-7rem)] overflow-hidden">
        
        <div class="flex-1 flex flex-col min-w-0 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-slate-800">Menu Kafe</h3>
                <p class="text-xs text-gray-400">Klik tanda + pada menu untuk memasukkan ke keranjang kasir.</p>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-800 rounded-lg text-xs font-medium">
                    🎉 {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-xs font-medium">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <div class="flex-1 overflow-y-auto grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 pr-1">
                @forelse($menus as $menu)
                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100 flex flex-col justify-between hover:shadow-sm transition group">
                    <div class="relative rounded-lg overflow-hidden bg-gray-200 aspect-square mb-2 flex items-center justify-center text-3xl">
                        {{ $menu->kategori == 'Minuman' ? '☕' : '🥐' }}
                    </div>
                    <div>
                        <h4 class="font-bold text-xs text-slate-800 line-clamp-1">{{ $menu->nama_menu }}</h4>
                        <span class="text-[10px] text-gray-400 block mt-0.5">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="mt-2 pt-2 border-t border-gray-200/60 flex justify-end">
                        <form action="{{ route('keranjang.tambah', $menu->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-8 h-8 bg-amber-500 hover:bg-amber-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm transition">
                                +
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-12 text-gray-400 italic text-sm">
                    📭 Belum ada menu yang tersedia.
                </div>
                @endforelse
            </div>

            <div class="mt-4 pt-4 border-t border-gray-100 shrink-0">
                <h4 class="text-xs font-black text-slate-700 tracking-wider uppercase mb-3 flex items-center gap-1.5">
                    ⏱️ Status Masakan Meja (Pantauan Kasir)
                </h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-3 max-h-40 overflow-y-auto pr-1">
                    @forelse($activeOrders as $order)
                    <div class="p-3 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-between transition">
                        <div>
                            <span class="text-[10px] font-bold text-gray-400 block">MEJA</span>
                            <span class="font-black text-slate-800 text-sm">#{{ $order->nomor_meja }}</span>
                            <span class="text-[10px] text-gray-500 font-mono block mt-0.5">Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="text-right">
                            <span class="text-[9px] bg-amber-100 text-amber-800 font-extrabold px-2 py-1 rounded-md shadow-sm border border-amber-200 block">
                                👨‍🍳 Sedang Dimasak
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-4 text-center text-xs text-gray-400 italic">
                        📭 Semua hidangan sudah selesai disajikan ke pelanggan.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="w-full lg:w-96 bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <h3 class="text-md font-bold text-slate-800 border-b border-gray-100 pb-3 flex items-center gap-2">
                    🛒 Keranjang Pesanan
                </h3>

                <div class="mt-4 overflow-y-auto max-h-[calc(100vh-24rem)] space-y-3 pr-1">
                    @php $total = 0; @endphp
                    
                    <form id="form-checkout" action="{{ route('pesanan.store') }}" method="POST">
                        @csrf
                        
                        @forelse($cart as $id => $item)
                        @php $total += $item['harga'] * $item['jumlah']; @endphp
                        <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 relative group/item">
                            <div class="flex justify-between items-start">
                                <div class="min-w-0">
                                    <h5 class="font-bold text-xs text-slate-800 truncate">{{ $item['nama_menu'] }}</h5>
                                    <span class="text-[10px] text-gray-400">@ Rp {{ number_format($item['harga'], 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('keranjang.hapus', $id) }}" class="text-gray-300 hover:text-red-500 text-xs transition">❌</a>
                            </div>

                            <input type="text" name="catatan_{{ $id }}" placeholder="Tambahkan catatan masakan..." 
                                class="w-full mt-2 px-2 py-1 bg-white border border-gray-200 rounded text-[11px] focus:ring-1 focus:ring-amber-500 focus:border-amber-500">

                            <div class="flex justify-between items-center mt-3 pt-2 border-t border-gray-200/40">
                                <span class="font-bold text-xs text-slate-800">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                                <div class="flex items-center gap-2 bg-white rounded-lg border border-gray-200 px-1 py-0.5">
                                    <a href="{{ route('keranjang.kurang', $id) }}" class="text-gray-500 hover:text-amber-600 font-bold px-1 text-xs">-</a>
                                    <span class="text-xs font-bold text-slate-800 min-w-[12px] text-center">{{ $item['jumlah'] }}</span>
                                    <a href="{{ route('keranjang.tambah', $id) }}" class="text-gray-500 hover:text-amber-600 font-bold px-1 text-xs" onclick="event.preventDefault(); this.closest('form').submit();">+</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 text-gray-300 italic text-xs">
                            Keranjang kosong.
                        </div>
                        @endforelse
                </div>
            </div>

            <div class="border-t border-gray-100 pt-4 mt-4 bg-white">
                
                <div class="mb-3">
                    <label for="nomor_meja" class="block text-xs font-bold text-slate-700 mb-1">Nomor Meja Pelanggan</label>
                    <input type="text" id="nomor_meja" name="nomor_meja" required placeholder="Contoh: 05 atau VIP-1" 
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs font-bold text-slate-800 focus:ring-amber-500 focus:border-amber-500 @error('nomor_meja') border-red-500 @enderror">
                </div>

                <div class="mb-3">
                    <label for="uang_bayar" class="block text-xs font-bold text-slate-700 mb-1">Uang Tunai Diterima (Rp)</label>
                    <input type="number" id="uang_bayar" name="uang_bayar" required placeholder="Masukkan nominal uang cash..." 
                        class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg text-xs font-black text-slate-800 focus:ring-amber-500 focus:border-amber-500">
                </div>

                <div class="space-y-1.5 bg-gray-50 p-3 rounded-xl border border-gray-100 mb-4 text-xs font-bold text-slate-600">
                    <div class="flex justify-between items-center">
                        <span>Total Bill:</span>
                        <span class="text-slate-900 font-black">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-1.5 border-t border-gray-200/60">
                        <span>Kembalian:</span>
                        <span id="label_kembalian" class="text-gray-400 font-extrabold">Rp 0</span>
                    </div>
                </div>

                @if(!empty($cart))
                    <button type="submit" id="btn-submit" disabled class="w-full bg-gray-200 text-gray-400 font-bold py-3 rounded-xl text-xs cursor-not-allowed tracking-wider transition duration-200">
                        🔒 MASUKKAN PEMBAYARAN LUNAS
                    </button>
                @else
                    <button type="button" disabled class="w-full bg-gray-100 text-gray-400 font-bold py-3 rounded-xl text-xs cursor-not-allowed">
                        KERANJANG KOSONG
                    </button>
                @endif
                </form> 
            </div>

        </div>
    </div>

    <script>
        document.getElementById('uang_bayar').addEventListener('input', function() {
            const totalHarga = {{ $total ?? 0 }};
            const uangBayar = parseInt(this.value) || 0;
            const kembalian = uangBayar - totalHarga;
            
            const labelKembalian = document.getElementById('label_kembalian');
            const btnSubmit = document.getElementById('btn-submit');

            if (uangBayar > 0 && kembalian >= 0) {
                labelKembalian.innerText = 'Rp ' + kembalian.toLocaleString('id-ID');
                labelKembalian.className = 'text-green-600 font-black text-sm';
                
                btnSubmit.disabled = false;
                btnSubmit.innerText = '🔔 BAYAR LUNAS & KIRIM KE DAPUR';
                btnSubmit.className = "w-full bg-green-600 hover:bg-green-700 text-white font-black py-3 rounded-xl text-xs shadow-sm transition tracking-wider cursor-pointer";
            } else {
                labelKembalian.innerText = uangBayar > 0 ? '❌ Uang Belum Cukup!' : 'Rp 0';
                labelKembalian.className = uangBayar > 0 ? 'text-red-500 font-bold' : 'text-gray-400 font-extrabold';
                
                if(btnSubmit) {
                    btnSubmit.disabled = true;
                    btnSubmit.innerText = '🔒 UANG PEMBAYARAN KURANG';
                    btnSubmit.className = "w-full bg-gray-200 text-gray-400 font-bold py-3 rounded-xl text-xs cursor-not-allowed tracking-wider";
                }
            }
        });
    </script>
</x-app-layout>