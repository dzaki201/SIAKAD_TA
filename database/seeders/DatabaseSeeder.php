<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\KunciNilai;
use App\Models\NilaiAkhir;
use App\Models\OrangTuaSiswa;
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
            OrangTuaAyahSeeder::class,
            OrangTuaIbuSeeder::class,
            TahunAjaranSeeder::class,
            EkstrakulikulerSeeder::class,
            KelasMataPelajaranSeeder::class,
            PlotGuruMapelSeeder::class,
            PlotSiswaKelasSeeder::class,
            CapaianPembelajaranSeeder::class,
            NilaiSeeder::class,
            SiswaEkstrakulikulerSeeder::class,
            AbsensiSeeder::class,
            NilaiAkhirSeeder::class,
            KepalaSekolahSeeder::class,
            KkmSeeder::class,
            KunciNilaiSeeder::class,
            // OrangTuaSiswaSeeder::class,
        ]);
    }
}
