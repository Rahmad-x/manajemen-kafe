<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    public function Pesanan(){
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id');
    }

}
