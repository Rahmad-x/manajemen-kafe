<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_pesanans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel induk (pesanans)
            $table->foreignId('pesanan_id')->constrained('pesanans')->onDelete('cascade');
            
            // Menghubungkan ke tabel menu
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->string('catatan')->nullable(); // Ditambahkan nullable agar kasir bisa mengosongkan catatan masakan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_pesanans');
    }
};