<?php

namespace Database\Seeders;

use App\Models\KunciNilai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KunciNilaiSeeder extends Seeder
{
    public function run(): void
    {
        KunciNilai::insert([
            [
                'guru_id' => 5,
                'mata_pelajaran_id' => 5,
                'tahun_ajaran_id' => 5,
                'kelas_id' => 6,
                'is_locked' => 0,
                'locked_at' => null,
            ],
            [
                'guru_id' => 5,
                'mata_pelajaran_id' => 4,
                'tahun_ajaran_id' => 5,
                'kelas_id' => 6,
                'is_locked' => 0,
                'locked_at' => null,
            ],
            [
                'guru_id' => 5,
                'mata_pelajaran_id' => 3,
                'tahun_ajaran_id' => 5,
                'kelas_id' => 6,
                'is_locked' => 0,
                'locked_at' => null,
            ],
            [
                'guru_id' => 7,
                'mata_pelajaran_id' => 2,
                'tahun_ajaran_id' => 5,
                'kelas_id' => 6,
                'is_locked' => 0,
                'locked_at' => null,
            ],
            [
                'guru_id' => 8,
                'mata_pelajaran_id' => 1,
                'tahun_ajaran_id' => 5,
                'kelas_id' => 6,
                'is_locked' => 0,
                'locked_at' => null,
            ],
        ]);
    }
}
