<?php

namespace Database\Seeders;

use App\Models\CatatanGuru;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatatanGuruSeeder extends Seeder
{

    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 34; $i++) {
            $data[] = [
                'siswa_id'        => $i,
                'tahun_ajaran_id' => 5,
                'catatan' => 'Ananda menunjukkan sikap dan prestasi belajar yang sangat baik. Terus pertahankan dan kembangkan kemampuan yang dimiliki.'
            ];
        }
        CatatanGuru::insert($data);
    }
}
