<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function kategori(){
        return $this->belongsTo(KategoriMenu::class, 'kategori_id');
    
    }
    public function detailPesanans(){
        return $this->hasMany(detailPesanan::class, 'menu_id');
    }
}
