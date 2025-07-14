<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\OrangTuaSiswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrangTuaSiswaSeeder extends Seeder
{

    public function run(): void
    {

        // OrangTuaSiswa::insert([
        //     [
        //         'orang_tua_id' => 1,
        //         'siswa_id' => 1,
        //         'status' => 'ayah',
        //     ],
        //     [
        //         'orang_tua_id' => 2,
        //         'siswa_id' => 1,
        //         'status' => 'ibu',
        //     ],
        //     [
        //         'orang_tua_id' => 3,
        //         'siswa_id' => 2,
        //         'status' => 'ayah',
        //     ],
        //     [
        //         'orang_tua_id' => 4,
        //         'siswa_id' => 2,
        //         'status' => 'ibu',
        //     ],
        //     [
        //         'orang_tua_id' => 5,
        //         'siswa_id' => 3,
        //         'status' => 'wali',
        //     ],
        // ]);
    }
}
