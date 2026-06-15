<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class meja extends Model
{
    public function detailPesanans(){
        return $this->hasMany(DetailPesanan::class, 'meja_id');
    }

}
