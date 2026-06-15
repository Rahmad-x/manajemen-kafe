<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    
// 🔥 TAMBAHKAN BARIS INI UNTUK MEMBUKA GEMBOK RINCIAN PESANAN
    protected $fillable = [
        'pesanan_id',
        'menu_id',
        'jumlah',
        'harga_satuan',
        'catatan',
    ];

    // Relasi ke model Menu (jika sudah ada, biarkan tetap ada)
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}