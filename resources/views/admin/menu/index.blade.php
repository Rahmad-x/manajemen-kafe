<x-app-layout>
    <div class="h-full flex flex-col">
        
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-4 rounded-2xl border border-gray-100 shadow-sm">
            <div>
                <h3 class="text-xl font-black text-slate-800 flex items-center gap-2">
                    📋 Daftar Master Menu Kafe
                </h3>
                <p class="text-xs text-gray-400 mt-0.5">Kelola data makanan, minuman, harga, beserta ketersediaan stok produk dapur[cite: 34].</p>
            </div>
            
            <a href="{{ route('menus.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white font-black px-4 py-2.5 rounded-xl text-xs shadow-sm flex items-center justify-center gap-1.5 transition self-start sm:self-center tracking-wider">
                ➕ TAMBAH MENU BARU
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl text-xs font-bold shadow-sm">
                🎉 {{ session('success') }}
            </div>
        @endif

        <div class="flex-1 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-900 text-white text-[11px] font-black tracking-wider uppercase border-b border-slate-800">
                            <th class="py-3.5 px-5 w-20">Visual</th>
                            <th class="py-3.5 px-4">Nama Produk</th>
                            <th class="py-3.5 px-4 w-36">Kategori</th>
                            <th class="py-3.5 px-4 w-40">Harga Jual</th>
                            <th class="py-3.5 px-4 w-32">Status Stok</th>
                            <th class="py-3.5 px-5 w-40 text-center">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs font-medium text-slate-700">
                        @forelse($menus as $menu)
                        <tr class="hover:bg-slate-50/60 transition duration-150">
                            <td class="py-3 px-5">
                                <div class="w-10 h-10 rounded-xl bg-gray-100 border border-gray-200/60 flex items-center justify-center text-xl shadow-inner">
                                    {{ $menu->kategori == 'Minuman' ? '☕' : '🥐' }}
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <span class="font-bold text-slate-900 text-sm block">{{ $menu->nama_menu }}</span>
                                <span class="text-[10px] text-gray-400 font-mono block mt-0.5">ID: #MN-{{ $menu->id }}</span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded-full font-bold text-[10px] tracking-wide inline-block {{ $menu->kategori == 'Minuman' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-amber-50 text-amber-700 border border-amber-100' }}">
                                    {{ $menu->kategori }}
                                </span>
                            </td>
                            <td class="py-3 px-4 font-bold font-mono text-slate-800 text-sm">
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            </td>
                            <td class="py-3 px-4">
                                @if($menu->status == 'Tersedia')
                                <span class="px-2.5 py-0.5 rounded-md font-black text-[9px] bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    🟢 READY
                                </span>
                                @else
                                <span class="px-2.5 py-0.5 rounded-md font-black text-[9px] bg-red-100 text-red-800 border border-red-200">
                                    🔴 HABIS
                                </span>
                                @endif
                            </td>
                            <td class="py-3 px-5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('menus.edit', $menu->id) }}" class="p-2 text-slate-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition border border-transparent hover:border-amber-200" title="Ubah Data">
                                        ✏️
                                    </a>
                                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu {{ $menu->nama_menu }} ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition border border-transparent hover:border-red-200" title="Hapus Menu">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td col-span="6" class="py-12 text-center text-gray-400 italic text-xs">
                                📭 Lemari menu kosong. Silakan klik tombol di kanan atas untuk mengisi menu perdana kafe.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>