<?php

namespace Database\Seeders;

use App\Models\NilaiAkhir;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NilaiAkhirSeeder extends Seeder
{
    public function run(): void
    {
        NilaiAkhir::insert([
            ['nilai_akhir' => '88.2', 'siswa_id' => 1, 'mata_pelajaran_id' => 4, 'keterangan' => null, 'tahun_ajaran_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['nilai_akhir' => '87.6', 'siswa_id' => 2, 'mata_pelajaran_id' => 4, 'keterangan' => null, 'tahun_ajaran_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['nilai_akhir' => '88.2', 'siswa_id' => 3, 'mata_pelajaran_id' => 4, 'keterangan' => null, 'tahun_ajaran_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['nilai_akhir' => '87.6', 'siswa_id' => 4, 'mata_pelajaran_id' => 4, 'keterangan' => null, 'tahun_ajaran_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['nilai_akhir' => '88.2', 'siswa_id' => 5, 'mata_pelajaran_id' => 4, 'keterangan' => null, 'tahun_ajaran_id' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['nilai_akhir' => '87.6', 'siswa_id' => 6, 'mata_pelajaran_id' => 4, 'keterangan' => null, 'tahun_ajaran_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
