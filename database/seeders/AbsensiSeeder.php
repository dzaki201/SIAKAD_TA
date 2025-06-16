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
                'kelas_id' => 1,
                'ijin' => '1',
                'sakit' => '2',
                'alpa' => '0',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 2,
                'kelas_id' => 1,
                'ijin' => '0',
                'sakit' => '1',
                'alpa' => '0',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 3,
                'kelas_id' => 1,
                'ijin' => '2',
                'sakit' => '0',
                'alpa' => '1',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 4,
                'kelas_id' => 1,
                'ijin' => '0',
                'sakit' => '0',
                'alpa' => '0',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 5,
                'kelas_id' => 1,
                'ijin' => '1',
                'sakit' => '3',
                'alpa' => '0',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 6,
                'kelas_id' => 1,
                'ijin' => '0',
                'sakit' => '0',
                'alpa' => '2',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
