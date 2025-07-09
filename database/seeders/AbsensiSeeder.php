<?php

namespace Database\Seeders;

use App\Models\Absensi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
       Absensi::insert([
            [
                'siswa_id' => 1,
                'ijin' => '1',
                'sakit' => '2',
                'alpa' => '0',
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 2,
                'ijin' => '0',
                'sakit' => '1',
                'alpa' => '0',
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 3,
                'ijin' => '2',
                'sakit' => '0',
                'alpa' => '1',
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 4,
                'ijin' => '0',
                'sakit' => '0',
                'alpa' => '0',
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 5,
                'ijin' => '1',
                'sakit' => '3',
                'alpa' => '0',
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 6,
                'ijin' => '0',
                'sakit' => '0',
                'alpa' => '2',
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
