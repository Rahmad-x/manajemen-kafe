<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\MenuController;
use Illuminate\Support\Facades\Route;
use App\Models\Menu;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $menus = Menu::where('status','Tersedia')->get();

    return view('dashboard', compact('menus'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('menus', MenuController::class);
});

require __DIR__.'/auth.php';
