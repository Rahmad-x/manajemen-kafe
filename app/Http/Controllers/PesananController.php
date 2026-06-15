<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Pesanan;

class PesananController extends Controller
{
    public function index(){
        $menus = Menu::where('status', 'Tersedia')->get();
        $cart = session()->get('cart', []);

        $activeOrders = Pesanan::where('status', 'Diproses')
        ->orderBy('updated_at', 'desc')
        ->get();        
        return view('dashboard', compact('menus', 'cart','activeOrders'));
    }

    public function tambahKeranjang($id){
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        if(isset($cart[$id])){
            $cart[$id]['jumlah']++;
        }else{
            $cart[$id] = [
                "nama_menu" => $menu->nama_menu,
                "jumlah"=>1,
                "harga" => $menu->harga,
                "kategori" => $menu->kategori,
                "catatan" => "",
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }
    public function kurangKeranjang($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            if($cart[$id]['jumlah'] > 1) {
                $cart[$id]['jumlah']--;
            } else {
                unset($cart[$id]); // Hapus jika jumlahnya 0
            }
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }
    public function hapusKeranjang($id)
    {
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang masih kosong!');
        }
        
        $totalHarga = 0;
        foreach($cart as $item) {
        $totalHarga += $item['harga'] * $item['jumlah'];
        }
        // Validasi input nomor meja
      $request->validate([
        'nomor_meja' => 'required|string|max:10',
        'uang_bayar' => 'required|numeric|min:' . $totalHarga, // Terkunci di sini jika uang kurang
        ], [
        'uang_bayar.min' => 'Transaksi gagal! Nominal uang pembayaran yang dimasukkan masih kurang.',
        ]);

        $kembalian = $request->uang_bayar - $totalHarga;

        // Hitung total harga belanjaan
        $totalHarga = 0;
        foreach($cart as $item) {
            $totalHarga += $item['harga'] * $item['jumlah'];
        }

      $pesanan = Pesanan::create([
        'user_id'     => auth()->id(),
        'nomor_meja'  => $request->nomor_meja,
        'total_harga' => $totalHarga,
        'uang_bayar'  => $request->uang_bayar,
        'kembalian'   => $kembalian,
        'status'      => 'Diproses', // Pesanan resmi lunas dan langsung terbang ke dapur
    ]);

        // Simpan ke tabel anak: detail_pesanans
       foreach($cart as $menuId => $item) {
        $catatanInput = $request->input("catatan_".$menuId);

        $pesanan->detailPesanans()->create([
            'menu_id'      => $menuId,
            'jumlah'       => $item['jumlah'],
            'harga_satuan' => $item['harga'],
            'catatan'      => $catatanInput,
        ]);
    }
        // Kosongkan keranjang belanja setelah berhasil checkout
        session()->forget('cart');

        return redirect()->route('dashboard')->with('success', 'Pesanan Meja ' . $pesanan->nomor_meja . ' berhasil dikirim ke dapur!');
    }
//     public function bayar($id)
// {
//     $pesanan = Pesanan::findOrFail($id);
    
//     // Ubah status pesanan menjadi Selesai (Sudah Bayar & Selesai Makan)
//     $pesanan->update([
//         'status' => 'Selesai'
//     ]);

//     return redirect()->route('dashboard')->with('success', 'Transaksi Meja ' . $pesanan->nomor_meja . ' Berhasil Diselesaikan!');
// }
}
