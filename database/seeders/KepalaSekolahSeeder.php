<?php

namespace Database\Seeders;

use App\Models\KepalaSekolah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KepalaSekolahSeeder extends Seeder
{
    public function run(): void
    {
        KepalaSekolah::insert([
            [
                'user_id' => 10,
                'nama' => 'Sri Sugiharti, S.Pd',
                'nip' => '19671130 199203 2 008',
                'alamat' => 'Purwokerto Utara',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
