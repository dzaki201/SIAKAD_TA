<?php

namespace Database\Seeders;

use App\Models\KelasMataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasMataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        KelasMataPelajaran::insert([
            [
                'kelas_id' => 1,
                'mata_pelajaran_id' => 1
            ],
            [
                'kelas_id' => 2,
                'mata_pelajaran_id' => 1
            ],
            [
                'kelas_id' => 3,
                'mata_pelajaran_id' => 1
            ],
            [
                'kelas_id' => 4,
                'mata_pelajaran_id' => 1
            ],
            [
                'kelas_id' => 1,
                'mata_pelajaran_id' => 2
            ],
            [
                'kelas_id' => 2,
                'mata_pelajaran_id' => 2
            ],
            [
                'kelas_id' => 3,
                'mata_pelajaran_id' => 2
            ],
            [
                'kelas_id' => 4,
                'mata_pelajaran_id' => 2
            ],
            [
                'kelas_id' => 1,
                'mata_pelajaran_id' => 3
            ],
            [
                'kelas_id' => 2,
                'mata_pelajaran_id' => 3
            ],
            [
                'kelas_id' => 3,
                'mata_pelajaran_id' => 3
            ],
            [
                'kelas_id' => 4,
                'mata_pelajaran_id' => 3
            ],
            [
                'kelas_id' => 1,
                'mata_pelajaran_id' => 4
            ],
            [
                'kelas_id' => 3,
                'mata_pelajaran_id' => 4
            ],
            [
                'kelas_id' => 5,
                'mata_pelajaran_id' => 4
            ],
            [
                'kelas_id' => 7,
                'mata_pelajaran_id' => 4
            ],
            [
                'kelas_id' => 2,
                'mata_pelajaran_id' => 5
            ],
            [
                'kelas_id' => 4,
                'mata_pelajaran_id' => 5
            ],
            [
                'kelas_id' => 6,
                'mata_pelajaran_id' => 5
            ],
            [
                'kelas_id' => 8,
                'mata_pelajaran_id' => 5
            ],
        ]);
    }
}
