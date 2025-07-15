<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AbsensiSeeder extends Seeder
{
    public function run(): void
    {
        $siswaList = Siswa::all();

        $absensi = [];
        foreach ($siswaList as $siswa) {
            $absensi[] = [
                'siswa_id' => $siswa->id,
                'ijin' => rand(0, 5),
                'sakit' => rand(0, 5),
                'alpa' => rand(0, 5),
                'tahun_ajaran_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
       Absensi::insert($absensi);
    }
}
