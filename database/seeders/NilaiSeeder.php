<?php

namespace Database\Seeders;

use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use App\Models\CapaianPembelajaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $capaian = CapaianPembelajaran::all();
        $siswaList = Siswa::all();

        $nilaiList = [];

        foreach ($siswaList as $siswa) {
            foreach ($capaian as $cp) {
                $nilaiList[] = [
                    'nilai' => rand(70, 98),
                    'siswa_id' => $siswa->id,
                    'capaian_pembelajaran_id' => $cp->id,
                    'tahun_ajaran_id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        Nilai::insert($nilaiList);
    }
}
