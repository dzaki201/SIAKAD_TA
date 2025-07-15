<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiswaEkstrakulikuler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaEkstrakulikulerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 34; $i++) {
            $data[] = [
                'siswa_id' => $i,
                'ekstrakulikuler_id' => 1,
                'keterangan' => 'Baik',
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        SiswaEkstrakulikuler::insert($data);
    }
}
