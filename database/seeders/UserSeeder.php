<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'role_id' => 1,
                'nama_lengkap' => 'Administrator Kafe',
                'username' => 'admin',
                'password'=> Hash::make('password123'),
            ],
            [
                'role_id' => 2,
                'nama_lengkap' => 'Kasir 1',
                'username' => 'kasir',
                'password'=> Hash::make('password123'),
            ],
            [
                'role_id' => 3,
                'nama_lengkap' => 'Koki Dapur',
                'username' => 'daput',
                'password'=> Hash::make('password123'),
            ]        
        ]);    
    }

}
