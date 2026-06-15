<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        
        <div class="mb-6">
            <a href="{{ route('menus.index') }}" class="text-xs text-amber-600 hover:text-amber-700 font-bold flex items-center gap-1 mb-2">
                ⬅️ Kembali ke Daftar Menu
            </a>
            <h3 class="text-lg font-bold text-slate-800">Edit Menu Kafe</h3>
            <p class="text-xs text-gray-500 mt-0.5">Ubah informasi menu kofimu melalui formulir di bawah ini.</p>
        </div>

        <form action="{{ route('menus.update', $menu->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') <div>
                <label for="nama_menu" class="block text-sm font-bold text-slate-700 mb-1">Nama Menu</label>
                <input type="text" id="nama_menu" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" 
                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:border-amber-500 focus:ring-amber-500 @error('nama_menu') border-red-500 @enderror">
                @error('nama_menu')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="kategori" class="block text-sm font-bold text-slate-700 mb-1">Kategori</label>
                    <select id="kategori" name="kategori" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:border-amber-500 focus:ring-amber-500">
                        <option value="Minuman" {{ old('kategori', $menu->kategori) == 'Minuman' ? 'selected' : '' }}>☕ Minuman</option>
                        <option value="Makanan" {{ old('kategori', $menu->kategori) == 'Makanan' ? 'selected' : '' }}>🥐 Makanan</option>
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-bold text-slate-700 mb-1">Status Ketersediaan</label>
                    <select id="status" name="status" class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:border-amber-500 focus:ring-amber-500">
                        <option value="Tersedia" {{ old('status', $menu->status) == 'Tersedia' ? 'selected' : '' }}>🟢 Tersedia</option>
                        <option value="Habis" {{ old('status', $menu->status) == 'Habis' ? 'selected' : '' }}>🔴 Habis</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="harga" class="block text-sm font-bold text-slate-700 mb-1">Harga (Rupiah)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-sm text-gray-400 font-semibold">Rp</span>
                    <input type="number" id="harga" name="harga" value="{{ old('harga', $menu->harga) }}" 
                        class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm focus:border-amber-500 focus:ring-amber-500 @error('harga') border-red-500 @enderror">
                </div>
                @error('harga')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-gray-50 flex justify-end gap-2">
                <a href="{{ route('menus.index') }}" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    Batal
                </a>
                <button type="submit" class="px-5 py-2 text-sm font-bold text-white bg-amber-500 hover:bg-amber-600 rounded-lg shadow-sm transition">
                    🔄 Perbarui Menu
                </button>
            </div>
        </form>

    </div>
</x-app-layout>