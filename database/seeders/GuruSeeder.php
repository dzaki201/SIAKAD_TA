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
                'nama' => 'Siti Baroroh, S.Pd.SD',
                'nip' => '19650902 198810 2 001',
                'kelas_id' => 1,
                'mata_pelajaran_id' => null,
                'alamat' => 'Rejasari',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'nama' => 'Kristin Hardiati Saputri, S.Pd',
                'nip' => '19931225 20222 12 011',
                'kelas_id' => 2,
                'mata_pelajaran_id' => null,
                'alamat' => 'Perum Pasir Indah',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'nama' => 'Dyah Pranowo Lestari, S.Pd',
                'nip' => '19750111 201406 2 002',
                'kelas_id' => 4,
                'mata_pelajaran_id' => null,
                'alamat' => 'Pasir Lor',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'nama' => 'Ermi Widiasih, S.Pd',
                'nip' => '19711005 20232 12 003',
                'kelas_id' => 5,
                'mata_pelajaran_id' => null,
                'alamat' => 'Karang Lewas Kidul',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 6,
                'nama' => 'Lutfi',
                'nip' => '19665006 10244 12 001',
                'kelas_id' => 6,
                'mata_pelajaran_id' => null,
                'alamat' => 'Karanglewas Wetan',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 7,
                'nama' => 'Ismiati Djatiningish, S.Pd',
                'nip' => '19660521 198903 2 007',
                'kelas_id' => null,
                'mata_pelajaran_id' => null,
                'alamat' => 'Perum Teluk',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 8,
                'nama' => 'Syarif Hermawan, S.Pd',
                'nip' => '19841127 200903 1 005',
                'kelas_id' => null,
                'mata_pelajaran_id' => 2,
                'alamat' => 'Perum Mandalatama',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 9,
                'nama' => 'Novi Tri Asih, S.Pd',
                'nip' => '19951102 20222 12 007',
                'kelas_id' => null,
                'mata_pelajaran_id' => 1,
                'alamat' => 'Pasir Wetan',
                'no_hp' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
