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
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'username' => 'guru1',
                'email' => 'guru1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
            ],
            [
                'username' => 'guru2',
                'email' => 'guru2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ],
            [
                'username' => 'guru3',
                'email' => 'guru3@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ],
            [
                'username' => 'guru4',
                'email' => 'guru4@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ],
            [
                'username' => 'guru5',
                'email' => 'guru5@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
            ],
            [
                'username' => 'guru6',
                'email' => 'guru6@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
            ],
            [
                'username' => 'orang_tua1',
                'email' => 'orangtua1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'username' => 'orang_tua2',
                'email' => 'orangtua2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'username' => 'orang_tua3',
                'email' => 'orangtua3@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'username' => 'orang_tua4',
                'email' => 'orangtua4@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ],
            [
                'username' => 'orang_tua5',
                'email' => 'orangtua5@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ]
        ]);
    }
}
