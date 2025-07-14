<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        Kelas::insert([
            ['nama' => '1', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '2', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '3', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '4A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '4B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '5', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '6', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
