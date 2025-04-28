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
                'role' => 'guru',
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
                'role' => 'guru',
            ],
            [
                'username' => 'guru6',
                'email' => 'guru6@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'guru',
            ],
            [
                'username' => 'orang_tua',
                'email' => 'orangtua@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'orang_tua',
            ]
        ]);
    }
}
