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
            ['nama' => '1A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '1B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '2A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '2B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '3A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '3B', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '4A', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => '4B', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
