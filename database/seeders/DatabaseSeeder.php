<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            OrangTuaSeeder::class,
            SiswaSeeder::class,
            TahunAjaranSeeder::class
        ]);
    }
}
