<?php

namespace Database\Seeders;

use App\Models\MataPelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        MataPelajaran::insert([
            ['nama_mata_pelajaran' => 'Matematika', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mata_pelajaran' => 'Bahasa Indonesia', 'created_at' => now(), 'updated_at' => now()],
            ['nama_mata_pelajaran' => 'Agama', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
