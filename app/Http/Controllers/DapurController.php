<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan; 

class DapurController extends Controller
{
    public function index(){
        $orders = Pesanan::with(['detailPesanans.menu'])
        ->where('status','Diproses')
        ->orderBy('created_at','asc')
        ->get();
        return view('dapur.index', compact('orders'));

    }
    public function selesai($id){
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->update([
            'status' => 'Selesai'        
            ]);
        return redirect()->route('dapur.index')->with('success','Pesanan Meja' . $pesanan->nomor_meja . 'selesai dimasak dan disajikan!');
    }
}
