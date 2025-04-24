<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'username' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ]);

        User::create([
            'username' => 'orang_tua',
            'email' => 'orangtua@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'orang_tua',
        ]);
    }
}
