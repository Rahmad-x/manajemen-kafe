<div class="flex-1 overflow-y-auto pr-2 grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4">
    
    @forelse($menus as $menu)
    <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition cursor-pointer group">
        <div class="relative rounded-lg overflow-hidden bg-gray-100 aspect-square mb-3">
            <div class="w-full h-full flex items-center justify-center text-4xl {{ $menu->kategori == 'Minuman' ? 'bg-amber-100' : 'bg-orange-100' }} group-hover:scale-105 transition duration-300">
                {{ $menu->kategori == 'Minuman' ? '☕' : '🥐' }}
            </div>
            <span class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-0.5 rounded text-[10px] font-bold {{ $menu->kategori == 'Minuman' ? 'text-amber-700' : 'text-orange-700' }}">
                {{ $menu->kategori }}
            </span>
        </div>
        <div>
            <h4 class="font-bold text-sm text-slate-800 line-clamp-1">{{ $menu->nama_menu }}</h4>
            <p class="text-xs text-gray-400 mt-0.5">Status: <span class="text-green-600 font-semibold">{{ $menu->status }}</span></p>
        </div>
        <div class="flex justify-between items-center mt-3 pt-2 border-t border-gray-50">
            <span class="font-black text-sm text-slate-800">Rp {{ number_format($menu->harga, 0, ',', '.') }}</span>
            <button class="w-7 h-7 bg-amber-500 hover:bg-amber-600 text-white rounded-lg flex items-center justify-center font-bold text-sm shadow-sm transition">+</button>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-400 italic">
        📭 Maaf, belum ada menu yang tersedia untuk dijual saat ini.
    </div>
    @endforelse

</div>