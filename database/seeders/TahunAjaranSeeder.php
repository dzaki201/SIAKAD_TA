<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        TahunAjaran::insert([
            [
                'tahun' => '2021/2022',
                'semester' => 'Ganjil',
                'status' => false,
            ],
            [
                'tahun' => '2021/2022',
                'semester' => 'Genap',
                'status' => false,
            ],
            [
                'tahun' => '2022/2023',
                'semester' => 'Ganjil',
                'status' => false,
            ],
            [
                'tahun' => '2022/2023',
                'semester' => 'Genap',
                'status' => false,
            ],
            [
                'tahun' => '2023/2024',
                'semester' => 'Ganjil',
                'status' => false,
            ],
            [
                'tahun' => '2023/2024',
                'semester' => 'Genap',
                'status' => true,
            ],
        ]);
    }
}
