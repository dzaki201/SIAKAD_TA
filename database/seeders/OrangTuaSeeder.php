<?php

namespace Database\Seeders;

use App\Models\OrangTua;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrangTuaSeeder extends Seeder
{
    public function run(): void
    {
        OrangTua::insert([
            [
                'user_id' => 8,
                'nama' => 'Bapak Andi',
                'nik' => '3172011111110001',
                'no_hp' => '081234567890'
            ],
            [
                'user_id' => 9,
                'nama' => 'Ibu Sari',
                'nik' => '3172011111110002',
                'no_hp' => '081234567891'
            ],
            [
                'user_id' => 10,
                'nama' => 'Bapak Budi',
                'nik' => '3172011111110003',
                'no_hp' => '081234567892'
            ]
        ]);
    }
}
