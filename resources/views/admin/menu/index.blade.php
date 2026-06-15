<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm font-medium flex items-center gap-2 shadow-sm">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                
                <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Daftar Menu Kafe</h3>
                        <p class="text-xs text-gray-500 mt-0.5">Kelola data makanan, minuman, harga, dan status ketersediaan di sini.</p>
                    </div>
                    <a href="{{ route('menus.create') }}" class="bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold py-2.5 px-4 rounded-lg shadow-sm transition flex items-center gap-2">
                        ➕ Tambah Menu Baru
                    </a>
                </div>

                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-900 text-amber-500 text-xs font-bold uppercase tracking-wider">
                                <th class="p-4">No</th>
                                <th class="p-4">Nama Menu</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4">Harga</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm text-slate-700">
                            {{-- Looping Data Menu dari Database --}}
                            @forelse($menus as $index => $menu)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-4 font-medium">{{ $index + 1 }}</td>
                                <td class="p-4 font-bold text-slate-900">{{ $menu->nama_menu }}</td>
                                <td class="p-4">
                                    {{-- Badge Dinamis untuk Kategori --}}
                                    <span class="px-2.5 py-1 text-xs font-bold rounded-md {{ $menu->kategori == 'Makanan' ? 'bg-orange-50 text-orange-700' : 'bg-blue-50 text-blue-700' }}">
                                        {{ $menu->kategori }}
                                    </span>
                                </td>
                                <td class="p-4 font-semibold text-slate-900">
                                    Rp {{ number_format($menu->harga, 0, ',', '.') }}
                                </td>
                                <td class="p-4">
                                    {{-- Badge Dinamis untuk Status --}}
                                    <span class="px-2.5 py-0.5 text-xs font-bold rounded-full {{ $menu->status == 'Tersedia' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $menu->status }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    {{-- Tombol Aksi (Edit & Hapus) --}}
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('menus.edit', $menu->id) }}" class="px-3 py-1 text-xs font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-md transition">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-xs font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-md transition">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            {{-- Tampilan Jika Data di Database Masih Kosong --}}
                            <tr>
                                <td colspan="6" class="p-12 text-center text-gray-400 italic">
                                    <div class="text-3xl mb-2">📭</div>
                                    Belum ada data menu. Silakan klik tombol "Tambah Menu Baru" di atas.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>