<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['nama_role'=>'Admin'],
            ['nama_role'=>'Kasir'],
            ['nama_role'=>'Dapur'],
        ]);
    }
}
