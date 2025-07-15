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
                'foto' => 'foto-user-1.jpg'
            ],
            [
                'email' => 'guru1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'foto' => 'foto-user-2.jpg'
            ],
            [
                'email' => 'guru2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'foto' => 'foto-user-3.jpg'
            ],
            [
                'email' => 'guru3@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'foto' => null
            ],
            [
                'email' => 'guru4@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'foto' => null
            ],
            [
                'email' => 'guru5@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'foto' => null
            ],
            [
                'email' => 'guru6@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
                'foto' => null
            ],
            [
                'email' => 'guru7@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
                'foto' => null
            ],
            [
                'email' => 'guru8@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru_mapel',
                'foto' => null
            ],
            [
                'email' => 'kepalasekolah@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'kepsek',
                'foto' => null
            ],
            [
                'email' => 'orangtua1@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
                'foto' => null
            ],
            [
                'email' => 'orangtua2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
                'foto' => null
            ],
            [
                'email' => 'orangtua3@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
                'foto' => null
            ],
            [
                'email' => 'orangtua4@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
                'foto' => null
            ],
            [
                'email' => 'orangtua5@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
                'foto' => null
            ]
        ]);
    }
}
