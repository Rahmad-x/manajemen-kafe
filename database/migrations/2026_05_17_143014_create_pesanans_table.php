<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('meja_id')->constarined('mejas')->restrictOnDelete();
            $table->string('nama_pelanggan',100);
            $table->enum('status_pesanan',['Menunggu Dimasak','Sedang Dimasak','Siap dimasak','Siap Disajikan','Selesai'])->default('Menunggu Dimasak');
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
