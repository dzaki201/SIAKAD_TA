<?php

namespace Database\Seeders;

use App\Models\Ekstrakulikuler;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EkstrakulikulerSeeder extends Seeder
{
    public function run(): void
    {
        Ekstrakulikuler::insert([
            ['nama' => 'Pramuka', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Tari', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pencak Silat', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
