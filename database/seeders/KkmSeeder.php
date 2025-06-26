<?php

namespace Database\Seeders;

use App\Models\Kkm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KkmSeeder extends Seeder
{
    public function run(): void
    {
        Kkm::insert([
            [
                'mata_pelajaran_id' => 1,
                'kelas_id' => 1,
                'nilai' => '78',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 1,
                'kelas_id' => 2,
                'nilai' => '78',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 1,
                'kelas_id' => 3,
                'nilai' => '75',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 1,
                'kelas_id' => 4,
                'nilai' => '75',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 2,
                'kelas_id' => 1,
                'nilai' => '80',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 2,
                'kelas_id' => 2,
                'nilai' => '80',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 2,
                'kelas_id' => 3,
                'nilai' => '77',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 2,
                'kelas_id' => 4,
                'nilai' => '77',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 3,
                'kelas_id' => 1,
                'nilai' => '85',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 3,
                'kelas_id' => 2,
                'nilai' => '85',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 3,
                'kelas_id' => 3,
                'nilai' => '80',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 3,
                'kelas_id' => 4,
                'nilai' => '80',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 4,
                'kelas_id' => 1,
                'nilai' => '75',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 4,
                'kelas_id' => 2,
                'nilai' => '75',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 4,
                'kelas_id' => 3,
                'nilai' => '70',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 4,
                'kelas_id' => 4,
                'nilai' => '70',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 5,
                'kelas_id' => 1,
                'nilai' => '78',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 5,
                'kelas_id' => 2,
                'nilai' => '78',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 5,
                'kelas_id' => 3,
                'nilai' => '74',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'mata_pelajaran_id' => 5,
                'kelas_id' => 4,
                'nilai' => '74',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
