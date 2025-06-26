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
                'user_id' => 13,
                'nama' => 'Budi',
                'nip' => '19821217 987443 8 008',
                'alamat' => 'Jl. Arjuna No.1',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
