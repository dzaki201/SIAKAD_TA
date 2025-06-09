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
            [
                'nama' => 'Matematika',
                'status' => 'umum',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Bahasa Indonesia',
                'status' => 'umum',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'PPKN',
                'status' => 'umum',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Seni Rupa',
                'status' => 'khusus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Seni Musik',
                'status' => 'umum',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
