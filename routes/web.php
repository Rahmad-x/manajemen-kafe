<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\PesananController;
use App\Models\Menu;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $menus = Menu::where('status','Tersedia')->get();

    return view('dashboard', compact('menus'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::resource('menus', MenuController::class);
    });
    Route::middleware('role:kasir,admin')->group(function (){

    Route::get('/dashboard', [PesananController::class, 'index'])->name('dashboard');
    Route::post('/keranjang/tambah/{id}', [PesananController::class, 'tambahKeranjang'])->name('keranjang.tambah');
    Route::get('/keranjang/kurang/{id}', [PesananController::class, 'kurangKeranjang'])->name('keranjang.kurang');
    Route::get('/keranjang/hapus/{id}', [PesananController::class, 'hapusKeranjang'])->name('keranjang.hapus');
    Route::post('/pesanan/store', [PesananController::class, 'store'])->name('pesanan.store');
    });
    


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware('role:dapur,admin')->group(function(){
        Route::get('/dapur',[DapurController::class,'index'])->name('dapur.index');
        Route::patch('/dapur/{id}/selesai',[DapurController::class,'selesai'])->name('dapur.selesai');
        });
    });

require __DIR__.'/auth.php';
