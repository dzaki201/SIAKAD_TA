<?php

namespace Database\Seeders;

use App\Models\Nilai;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nilai::insert([
            // Siswa 1
            ['nilai' => '85', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 1, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 2, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '88', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 3, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 4, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '82', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 5, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '95', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 6, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '87', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 7, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '93', 'siswa_id' => 1, 'guru_id' => 1, 'capaian_pembelajaran_id' => 8, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // Siswa 2
            ['nilai' => '83', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 1, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '89', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 2, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 3, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '86', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 4, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 5, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '92', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 6, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '85', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 7, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '91', 'siswa_id' => 2, 'guru_id' => 1, 'capaian_pembelajaran_id' => 8, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            //siswa 3
            ['nilai' => '85', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 1, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 2, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '88', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 3, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 4, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '82', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 5, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '95', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 6, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '87', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 7, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '93', 'siswa_id' => 3, 'guru_id' => 1, 'capaian_pembelajaran_id' => 8, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // Siswa 4
            ['nilai' => '83', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 1, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '89', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 2, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 3, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '86', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 4, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 5, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '92', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 6, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '85', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 7, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '91', 'siswa_id' => 4, 'guru_id' => 1, 'capaian_pembelajaran_id' => 8, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            //siswa 5
            ['nilai' => '85', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 1, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 2, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '88', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 3, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 4, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '82', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 5, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '95', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 6, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '87', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 7, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '93', 'siswa_id' => 5, 'guru_id' => 1, 'capaian_pembelajaran_id' => 8, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // Siswa 6
            ['nilai' => '83', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 1, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '89', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 2, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 3, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '86', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 4, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 5, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '92', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 6, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '85', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 7, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '91', 'siswa_id' => 6, 'guru_id' => 1, 'capaian_pembelajaran_id' => 8, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

        ]);

        // Nilai untuk kelas 3 (siswa 13-18)
        Nilai::insert([
            // Siswa 13
            ['nilai' => '84', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 9, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '91', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 10, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '86', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 11, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 12, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '87', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 13, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '93', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 14, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '89', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 15, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '94', 'siswa_id' => 13, 'guru_id' => 1, 'capaian_pembelajaran_id' => 16, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            //siswa 14
            ['nilai' => '94', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 9, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '81', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 10, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '96', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 11, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 12, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '97', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 13, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '83', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 14, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '95', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 15, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '84', 'siswa_id' => 14, 'guru_id' => 1, 'capaian_pembelajaran_id' => 16, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // Siswa 15
            ['nilai' => '84', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 9, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '91', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 10, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '86', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 11, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 12, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '87', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 13, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '93', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 14, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '89', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 15, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '94', 'siswa_id' => 15, 'guru_id' => 1, 'capaian_pembelajaran_id' => 16, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            //siswa 16
            ['nilai' => '94', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 9, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '81', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 10, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '96', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 11, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 12, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '97', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 13, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '83', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 14, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '95', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 15, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '84', 'siswa_id' => 16, 'guru_id' => 1, 'capaian_pembelajaran_id' => 16, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            // Siswa 17
            ['nilai' => '84', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 9, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '91', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 10, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '86', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 11, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '90', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 12, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '87', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 13, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '93', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 14, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '89', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 15, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '94', 'siswa_id' => 17, 'guru_id' => 1, 'capaian_pembelajaran_id' => 16, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

            //siswa 18
            ['nilai' => '94', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 9, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '81', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 10, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '96', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 11, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '80', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 12, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '97', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 13, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '83', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 14, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '95', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 15, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['nilai' => '84', 'siswa_id' => 18, 'guru_id' => 1, 'capaian_pembelajaran_id' => 16, 'tahun_ajaran_id' => 6, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}
