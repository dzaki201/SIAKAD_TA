<?php

namespace Database\Seeders;

use App\Models\Kkm;
use App\Models\MataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KkmSeeder extends Seeder
{
    public function run(): void
    {
        $mapels = MataPelajaran::all();

        $nilai = [];

        foreach ($mapels as $mapel) {
            $nilai[] = [
                'mata_pelajaran_id' => $mapel->id,
                'kelas_id' => 6,
                'nilai' => rand(70, 78),
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $nilai[] = [
                'mata_pelajaran_id' => $mapel->id,
                'kelas_id' => 7,
                'nilai' => rand(70, 78),
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $nilai[] = [
                'mata_pelajaran_id' => $mapel->id,
                'kelas_id' => 6,
                'nilai' => rand(70, 78),
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $nilai[] = [
                'mata_pelajaran_id' => $mapel->id,
                'kelas_id' => 7,
                'nilai' => rand(70, 78),
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Kkm::insert($nilai);
    }
}
