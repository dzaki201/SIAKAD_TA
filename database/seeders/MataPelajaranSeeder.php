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
                'nama' => 'Agama',
                'status' => 'Khusus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Penjaskes',
                'status' => 'khusus',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Pancasila',
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
                'nama' => 'Matematika',
                'status' => 'umum',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
