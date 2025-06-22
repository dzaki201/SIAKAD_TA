<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        Guru::insert([
            [
                'user_id' => 2,
                'nama' => 'Pak Dodi',
                'nip' => '19821216 334456 6 006',
                'kelas_id' => null,
                'mata_pelajaran_id' => 4,
                'alamat' => 'Jl. Merdeka No.1',
                'no_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama' => 'Pak Budi',
                'nip' => '19800101 123456 1 001',
                'kelas_id' => 1,
                'mata_pelajaran_id' => null,
                'alamat' => 'Jl. Sudirman No.2',
                'no_hp' => '081234567891',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nama' => 'Bu Ani',
                'nip' => '19850505 654321 2 002',
                'kelas_id' => 2,
                'mata_pelajaran_id' => null,
                'alamat' => 'Jl. Diponegoro No.3',
                'no_hp' => '081234567892',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nama' => 'Pak Agus',
                'nip' => '19871111 112233 3 003',
                'kelas_id' => 3,
                'mata_pelajaran_id' => null,
                'alamat' => 'Jl. Gatot Subroto No.4',
                'no_hp' => '081234567893',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'nama' => 'Bu Siti',
                'nip' => '19790101 223344 4 004',
                'kelas_id' => null,
                'mata_pelajaran_id' => 5,
                'alamat' => 'Jl. Ahmad Yani No.5',
                'no_hp' => '081234567894',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'nama' => 'Pak Joko',
                'nip' => '19821212 334455 5 005',
                'kelas_id' => null,
                'mata_pelajaran_id' => null,
                'alamat' => 'Jl. Pemuda No.6',
                'no_hp' => '081234567895',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
