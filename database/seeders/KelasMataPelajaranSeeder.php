<?php

namespace Database\Seeders;

use App\Models\KelasMataPelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasMataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];

        for ($kelas = 1; $kelas <= 7; $kelas++) {
            for ($mapel = 1; $mapel <= 5; $mapel++) {
                $data[] = [
                    'kelas_id'           => $kelas,
                    'mata_pelajaran_id'  => $mapel,
                ];
            }
        }
        KelasMataPelajaran::insert($data);
    }
}
