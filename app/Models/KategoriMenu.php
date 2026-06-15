<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriMenu extends Model
{
    public function menus(){
    return $this->hasMany(Menu::class, 'kategori_id');
    }
}
