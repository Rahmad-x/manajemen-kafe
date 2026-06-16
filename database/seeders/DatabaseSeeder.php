<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
public function run(): void
    {
        // 1. Akun Admin
        User::create([
            'name' => 'Rahmad Admin',
            'username' => 'admin',
            'email' => 'rhmd76457645@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Akun Kasir
        User::create([
            'name' => 'dandi Kasir',
            'username' => 'kasir',
            'email' => 'Dandyorlenjunior@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'kasir',
        ]);

        // 3. Akun Dapur
        User::create([
            'name' => 'akmal Dapur',
            'username' => 'dapur',
            'email' => 'acedomi64@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'dapur',
        ]);

        Menu::create([
            'nama_menu' => 'Kopi Susu Gula Aren',
            'harga' => 18000,
            'kategori' => 'Minuman',
            'status' => 'Tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Ice Cafe Latte',
            'harga' => 22000,
            'kategori' => 'Minuman',
            'status' => 'Tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Matcha Latte Premium',
            'harga' => 24000,
            'kategori' => 'Minuman',
            'status' => 'Tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Americano Hot Double Shot',
            'harga' => 15000,
            'kategori' => 'Minuman',
            'status' => 'Tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Ice Chocolate Lava',
            'harga' => 20000,
            'kategori' => 'Minuman',
            'status' => 'Tersedia',
        ]);

        // --- KATEGORI: MAKANAN ---
        Menu::create([
            'nama_menu' => 'Roti Bakar Cokelat Keju',
            'harga' => 15000,
            'kategori' => 'Makanan',
            'status' => 'Tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Warm Croissant Original',
            'harga' => 19000,
            'kategori' => 'Makanan',
            'status' => 'Tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'French Fries Crispy BBQ',
            'harga' => 14000,
            'kategori' => 'Makanan',
            'status' => 'Tersedia',
        ]);

        Menu::create([
            'nama_menu' => 'Nasi Goreng Kopi-Tech Special',
            'harga' => 25000,
            'kategori' => 'Makanan',
            'status' => 'Tersedia',
        ]);
    }
}
