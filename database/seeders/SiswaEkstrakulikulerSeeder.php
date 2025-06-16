<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiswaEkstrakulikuler;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaEkstrakulikulerSeeder extends Seeder
{
    public function run(): void
    {
        SiswaEkstrakulikuler::insert([
            [
                'siswa_id' => 1,
                'ekstrakulikuler_id' => 1,
                'keterangan' => 'Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 2,
                'ekstrakulikuler_id' => 1,
                'keterangan' => 'Cukup',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 3,
                'ekstrakulikuler_id' => 1,
                'keterangan' => 'Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 4,
                'ekstrakulikuler_id' => 1,
                'keterangan' => 'Sangat Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 5,
                'ekstrakulikuler_id' => 1,
                'keterangan' => 'Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 6,
                'ekstrakulikuler_id' => 1,
                'keterangan' => 'Cukup',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 1,
                'ekstrakulikuler_id' => 2,
                'keterangan' => 'Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 2,
                'ekstrakulikuler_id' => 3,
                'keterangan' => 'Cukup',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 3,
                'ekstrakulikuler_id' => 2,
                'keterangan' => 'Sangat Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 4,
                'ekstrakulikuler_id' => 3,
                'keterangan' => 'Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 5,
                'ekstrakulikuler_id' => 2,
                'keterangan' => 'Cukup',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => 6,
                'ekstrakulikuler_id' => 3,
                'keterangan' => 'Baik',
                'tahun_ajaran_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
