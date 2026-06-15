<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
       public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
       public function meja(){
        return $this->belongsTo(Meja::class, 'meja_id');
    }
    public function detailPesanans(){
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

}
