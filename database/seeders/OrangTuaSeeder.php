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
                'pekerjaan' => 'Karyawan Swasta',
                'alamat' => 'Jl. Merdeka No. 1',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'nama' => 'Ibu Sari',
                'nik' => '3172011111110002',
                'pekerjaan' => 'Ibu Rumah Tangga',
                'alamat' => 'Jl. Merdeka No. 1',
                'no_hp' => '081234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'nama' => 'Bapak Budi',
                'nik' => '3172011111110003',
                'pekerjaan' => 'Guru',
                'alamat' => 'Jl. Sudirman No. 10',
                'no_hp' => '081234567892',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => null,
                'nama' => 'Ibu Nina',
                'nik' => '3172011111110004',
                'pekerjaan' => 'Pegawai Negeri',
                'alamat' => 'Jl. Sudirman No. 10',
                'no_hp' => '081234567893',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 10,
                'nama' => 'Pak Joko',
                'nik' => '3172011111110005',
                'pekerjaan' => 'Petani',
                'alamat' => 'Jl. Diponegoro No. 5',
                'no_hp' => '081234567894',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
