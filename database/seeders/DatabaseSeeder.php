<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\NilaiAkhir;
use App\Models\SiswaEkstrakulikuler;
use Database\Seeders\CapaianPembelajaranSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\OrangTuaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KelasSeeder::class,
            MataPelajaranSeeder::class,
            GuruSeeder::class,
            SiswaSeeder::class,
            OrangTuaSeeder::class,
            TahunAjaranSeeder::class,
            EkstrakulikulerSeeder::class,
            KelasMataPelajaranSeeder::class,
            PlotGuruMapelSeeder::class,
            CapaianPembelajaranSeeder::class,
            NilaiSeeder::class,
            SiswaEkstrakulikulerSeeder::class,
            AbsensiSeeder::class,
            NilaiAkhirSeeder::class,
        ]);
    }
}
