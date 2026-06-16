<?php

namespace Database\Seeders;

use App\Models\User;
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
    }
}
