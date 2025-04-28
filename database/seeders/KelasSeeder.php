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
            ['nama_kelas' => '1A', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kelas' => '1B', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kelas' => '2A', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
