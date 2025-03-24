<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::create([
            'nama' => 'Admin',
            'alamat' => 'xxxxx',
            'telepon' => '08xxxxx',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123'),
            'jenis' => 'admin',
        ]);

        User::create([
            'nama' => 'User Biasa',
            'alamat' => 'yyyyy',
            'telepon' => '08123456789',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user@123'),
            'jenis' => 'member',
        ]);
    }
}
