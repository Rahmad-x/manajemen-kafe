<x-app-layout>
    <div class="flex flex-col lg:flex-row gap-6 h-full lg:h-[calc(100vh-6.5rem)] overflow-y-auto lg:overflow-hidden pb-6 lg:pb-0">
        
        <div class="flex-1 flex flex-col min-w-0 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm h-full">
            
            <div class="mb-4 shrink-0">
                <h3 class="text-xl font-black text-slate-800 tracking-tight flex items-center gap-2">
                    🍔 Daftar Menu Kasir
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Pilih varian menu di bawah untuk dimasukkan ke keranjang belanja.</p>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold shadow-sm shrink-0">
                    🎉 {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-800 rounded-xl text-xs font-bold shadow-sm shrink-0">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <div class="flex-1 overflow-y-auto grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 pr-1 min-h-[300px] lg:min-h-0">
                @forelse($menus as $menu)
                <div class="bg-gray-50/60 p-3.5 rounded-2xl border border-gray-100 flex flex-col justify-between hover:bg-white hover:border-amber-300 hover:shadow-md transition duration-200 group">
                    <div class="relative rounded-xl overflow-hidden bg-gray-200 aspect-square mb-3 flex items-center justify-center text-4xl shadow-inner group-hover:scale-[1.02] transition duration-200">
                        {{ $menu->kategori == 'Minuman' ? '☕' : '🥐' }}
                    </div>
                    <div class="mb-3">
                        <span class="text-[9px] font-black tracking-wider uppercase px-2 py-0.5 rounded-md bg-white border border-gray-100 {{ $menu->kategori == 'Minuman' ? 'text-blue-600' : 'text-amber-700' }}">
                            {{ $menu->kategori }}
                        </span>
                        <h4 class="font-black text-xs text-slate-800 mt-2 line-clamp-2 min-h-[2rem]">{{ $menu->nama_menu }}</h4>
                        <span class="text-xs font-black text-slate-900 block mt-1">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="pt-2 border-t border-gray-100 flex justify-end">
                        <form action="{{ route('keranjang.tambah', $menu->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full py-1.5 bg-slate-900 hover:bg-amber-500 hover:text-slate-950 text-white font-bold rounded-xl text-xs shadow-sm transition duration-150 flex items-center justify-center gap-1">
                                <span class="text-sm">+</span> Tambah
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center py-16 text-gray-400 italic text-xs">
                    📭 Belum ada varian menu yang didaftarkan oleh Admin.
                </div>
                @endforelse
            </div>

            <div class="mt-4 pt-3 border-t border-gray-100 shrink-0">
                <h4 class="text-[10px] font-black text-slate-400 tracking-wider uppercase mb-2 flex items-center gap-1.5">
                    ⏱️ Info Antrean Dapur (Sedang Dimasak)
                </h4>
                
                <div class="flex flex-nowrap overflow-x-auto gap-3 pb-2 scrollbar-thin">
                    @forelse($activeOrders as $order)
                    <div class="flex items-center gap-3 bg-slate-50 border border-slate-200/80 p-2 rounded-xl min-w-[190px] shrink-0 shadow-sm">
                        <div class="bg-slate-900 text-white w-9 h-9 rounded-lg flex flex-col items-center justify-center shrink-0">
                            <span class="text-[8px] font-bold text-slate-400 leading-none">MEJA</span>
                            <span class="text-xs font-black leading-tight">#{{ $order->nomor_meja }}</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <span class="text-[10px] font-mono text-gray-500 block truncate">Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                            <span class="inline-flex items-center text-[9px] font-black text-amber-800 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-200 mt-0.5">
                                👨‍🍳 Cooking
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="py-2 text-left text-[11px] text-gray-400 italic">
                        📭 Seluruh pesanan kafe sudah selesai disajikan.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="w-full lg:w-[410px] bg-white p-5 rounded-2xl border border-gray-100 shadow-sm flex flex-col h-full shrink-0">
            
            <form id="form-checkout" action="{{ route('pesanan.store') }}" method="POST" class="h-full flex flex-col justify-between">
                @csrf
                
                <div class="flex flex-col flex-1 min-h-0">
                    <h3 class="text-md font-black text-slate-800 border-b border-gray-100 pb-3 flex items-center gap-2 shrink-0">
                        🛒 Keranjang Kasir
                    </h3>

                    <div class="mt-4 overflow-y-auto flex-1 space-y-3 pr-1 max-h-[320px] lg:max-h-none">
                        @php $total = 0; @endphp
                        
                        @forelse($cart as $id => $item)
                        @php $total += $item['harga'] * $item['jumlah']; @endphp
                        <div class="p-3 bg-slate-50/80 rounded-xl border border-gray-100 relative group">
                            <div class="flex justify-between items-start gap-2">
                                <div class="min-w-0">
                                    <h5 class="font-bold text-xs text-slate-800 truncate">{{ $item['nama_menu'] }}</h5>
                                    <span class="text-[10px] text-gray-400 font-medium">@ Rp {{ number_format($item['harga'], 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('keranjang.hapus', $id) }}" class="text-gray-300 hover:text-red-500 text-xs transition p-0.5" title="Hapus item">❌</a>
                            </div>

                            <input type="text" name="catatan_{{ $id }}" placeholder="Tambahkan catatan resep..." 
                                class="w-full mt-2 px-2.5 py-1 bg-white border border-gray-200 rounded-lg text-[11px] focus:ring-1 focus:ring-amber-500 focus:border-amber-500 text-slate-700">

                            <div class="flex justify-between items-center mt-3 pt-2 border-t border-gray-200/40">
                                <span class="font-black text-xs text-slate-800">Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</span>
                                <div class="flex items-center gap-2.5 bg-white rounded-xl border border-gray-200 px-2 py-1 shadow-sm">
                                    <a href="{{ route('keranjang.kurang', $id) }}" class="text-gray-400 hover:text-slate-800 font-black px-1 text-xs transition">-</a>
                                    <span class="text-xs font-black text-slate-800 min-w-[14px] text-center">{{ $item['jumlah'] }}</span>
                                    <a href="{{ route('keranjang.tambah', $id) }}" class="text-gray-400 hover:text-slate-800 font-black px-1 text-xs transition" onclick="event.preventDefault(); this.closest('form').submit();">+</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16 text-gray-300 italic text-xs">
                            Keranjang kosong. Pilih menu di sebelah kiri.
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-4 mt-4 bg-white shrink-0">
                    <div class="mb-3">
                        <label for="nomor_meja" class="block text-[11px] font-black text-slate-500 tracking-wider uppercase mb-1">Nomor Meja Pelanggan</label>
                        <input type="text" id="nomor_meja" name="nomor_meja" required placeholder="Misal: 04, 12, atau VIP" 
                            class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-black text-slate-800 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition @error('nomor_meja') border-red-500 @enderror">
                    </div>

                    <div class="mb-3">
                        <label for="uang_bayar" class="block text-[11px] font-black text-slate-500 tracking-wider uppercase mb-1">Uang Tunai Diterima (Rp)</label>
                        <input type="number" id="uang_bayar" name="uang_bayar" required placeholder="Masukkan jumlah uang cash..." 
                            class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs font-black text-slate-900 focus:bg-white focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition">
                    </div>

                    <div class="space-y-2 bg-slate-900 text-white p-3.5 rounded-xl mb-4 text-xs font-bold border border-slate-800 shadow-inner">
                        <div class="flex justify-between items-center text-slate-400">
                            <span>Total Tagihan:</span>
                            <span class="text-white font-black text-sm">Rp {{ number_format($total ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-slate-800">
                            <span class="text-slate-400">Uang Kembalian:</span>
                            <span id="label_kembalian" class="text-slate-400 font-black text-sm">Rp 0</span>
                        </div>
                    </div>

                    @if(!empty($cart))
                        <button type="submit" id="btn-submit" disabled class="w-full bg-gray-100 text-gray-400 font-black py-3.5 rounded-xl text-xs cursor-not-allowed tracking-widest transition duration-150 uppercase shadow-sm">
                            🔒 MASUKKAN PEMBAYARAN LUNAS
                        </button>
                    @else
                        <button type="button" disabled class="w-full bg-gray-50 text-gray-300 font-black py-3.5 rounded-xl text-xs cursor-not-allowed tracking-widest uppercase">
                            KERANJANG KOSONG
                        </button>
                    @endif
                </div>

            </form> 
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
                labelSample = 'Rp ' + kembalian.toLocaleString('id-ID');
                labelKembalian.innerText = labelSample;
                labelKembalian.className = 'text-emerald-400 font-black text-sm font-mono';
                
                btnSubmit.disabled = false;
                btnSubmit.innerText = '🔔 CETAK NOTA & KIRIM KE DAPUR';
                btnSubmit.className = "w-full bg-amber-500 hover:bg-amber-600 text-slate-950 font-black py-3.5 rounded-xl text-xs shadow-md transition duration-150 tracking-widest cursor-pointer uppercase";
            } else {
                labelKembalian.innerText = uangBayar > 0 ? '❌ Nominal Kurang!' : 'Rp 0';
                labelKembalian.className = uangBayar > 0 ? 'text-red-400 font-black text-xs' : 'text-slate-400 font-black text-sm';
                
                if(btnSubmit) {
                    btnSubmit.disabled = true;
                    btnSubmit.innerText = '🔒 UANG PEMBAYARAN KURANG';
                    btnSubmit.className = "w-full bg-gray-100 text-gray-400 font-black py-3.5 rounded-xl text-xs cursor-not-allowed tracking-widest uppercase shadow-sm";
                }
            }
        });
    </script>
</x-app-layout>