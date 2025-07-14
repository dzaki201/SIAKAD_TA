<?php

namespace Database\Seeders;

use App\Models\PlotSiswaKelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlotSiswaKelasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 34; $i++) {
            $data[] = [
                'siswa_id'        => $i,
                'kelas_id'        => 6,
                'tahun_ajaran_id' => 5,
            ];
        }

        for ($i = 1; $i <= 34; $i++) {
            $data[] = [
                'siswa_id'        => $i,
                'kelas_id'        => 7,
                'tahun_ajaran_id' => 6,
            ];
        }

        for ($i = 35; $i <= 58; $i++) {
            $data[] = [
                'siswa_id'        => $i,
                'kelas_id'        => 6,
                'tahun_ajaran_id' => 6,
            ];
        }

        PlotSiswaKelas::insert($data);
    }
}
