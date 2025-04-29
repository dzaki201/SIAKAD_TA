<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::insert([
            [
                'nama' => 'Ahmad',
                'nis' => '220001',
                'kelas_id' => 1,
                'orangtua_id' => 1
            ],
            [
                'nama' => 'Rina',
                'nis' => '220002',
                'kelas_id' => 1,
                'orangtua_id' => 2
            ],
            [
                'nama' => 'Bagus',
                'nis' => '220003',
                'kelas_id' => 1,
                'orangtua_id' => 3
            ],
            [
                'nama' => 'Citra',
                'nis' => '220004',
                'kelas_id' => 1,
                'orangtua_id' => 1
            ],
            [
                'nama' => 'Dina',
                'nis' => '220005',
                'kelas_id' => 1,
                'orangtua_id' => 2
            ],
            [
                'nama' => 'Eko',
                'nis' => '220006',
                'kelas_id' => 1,
                'orangtua_id' => 3
            ]
        ]);
    }
}
