<?php

namespace Database\Seeders;

use App\Models\PlotGuruMapel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlotGuruMapelSeeder extends Seeder
{
    public function run(): void
    {
        PlotGuruMapel::insert([
            [
                'guru_id' => 5,
                'kelas_id' => 2
            ],
            [
                'guru_id' => 5,
                'kelas_id' => 4
            ],
            [
                'guru_id' => 5,
                'kelas_id' => 6
            ],
            [
                'guru_id' => 5,
                'kelas_id' => 8
            ],
            [
                'guru_id' => 1,
                'kelas_id' => 1
            ],
            [
                'guru_id' => 1,
                'kelas_id' => 3
            ],
            [
                'guru_id' => 1,
                'kelas_id' => 5
            ],
            [
                'guru_id' => 1,
                'kelas_id' => 7
            ],
        ]);
    }
}
