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
            ['nama' => 'Matematika', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bahasa Indonesia', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Agama', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
