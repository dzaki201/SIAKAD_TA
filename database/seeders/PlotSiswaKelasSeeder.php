<?php

namespace Database\Seeders;

use App\Models\PlotSiswaKelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlotSiswaKelasSeeder extends Seeder
{
    public function run(): void
    {
        PlotSiswaKelas::insert([
            ['siswa_id' => 1, 'kelas_id' => 1,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 2, 'kelas_id' => 1,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 3, 'kelas_id' => 1,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 4, 'kelas_id' => 1,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 5, 'kelas_id' => 1,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 6, 'kelas_id' => 1,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 7, 'kelas_id' => 2,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 8, 'kelas_id' => 2,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 9, 'kelas_id' => 2,  'tahun_ajaran_id' => 5,],
            ['siswa_id' => 10, 'kelas_id' => 2, 'tahun_ajaran_id' => 5,],
            ['siswa_id' => 11, 'kelas_id' => 2, 'tahun_ajaran_id' => 5,],
            ['siswa_id' => 12, 'kelas_id' => 2, 'tahun_ajaran_id' => 5,],
        ]);

        PlotSiswaKelas::insert([
            ['siswa_id' => 1, 'kelas_id' => 3,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 2, 'kelas_id' => 3,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 3, 'kelas_id' => 3,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 4, 'kelas_id' => 3,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 5, 'kelas_id' => 3,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 6, 'kelas_id' => 3,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 7, 'kelas_id' => 4,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 8, 'kelas_id' => 4,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 9, 'kelas_id' => 4,  'tahun_ajaran_id' => 6,],
            ['siswa_id' => 10, 'kelas_id' => 4, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 11, 'kelas_id' => 4, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 12, 'kelas_id' => 4, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 13, 'kelas_id' => 1, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 14, 'kelas_id' => 1, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 15, 'kelas_id' => 1, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 16, 'kelas_id' => 1, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 17, 'kelas_id' => 1, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 18, 'kelas_id' => 1, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 19, 'kelas_id' => 2, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 20, 'kelas_id' => 2, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 21, 'kelas_id' => 2, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 22, 'kelas_id' => 2, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 23, 'kelas_id' => 2, 'tahun_ajaran_id' => 6,],
            ['siswa_id' => 24, 'kelas_id' => 2, 'tahun_ajaran_id' => 6,],
        ]);
    }
}
