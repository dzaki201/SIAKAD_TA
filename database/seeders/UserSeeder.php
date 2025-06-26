<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'email' => 'guru1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
            ],
            [
                'email' => 'guru2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ],
            [
                'email' => 'guru3@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ],
            [
                'email' => 'guru4@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ],
            [
                'email' => 'guru5@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
            ],
            [
                'email' => 'guru6@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
            ],
            [
                'email' => 'orangtua1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'email' => 'orangtua2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'email' => 'orangtua3@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'email' => 'orangtua4@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'email' => 'orangtua5@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'email' => 'kepalasekolah@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'kepsek',
            ]
        ]);
    }
}
