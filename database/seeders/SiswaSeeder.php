<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        Siswa::insert([
            [
                'nama' => 'Ahmad',
                'nis' => '220001',
                'nisn' => '990001',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2014-01-15',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'sekolah_asal' => 'TK Bintang Kecil',
                'alamat' => 'Jl. Merdeka No. 1',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Rina',
                'nis' => '220002',
                'nisn' => '990002',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '2014-02-20',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Kristen',
                'sekolah_asal' => 'TK Harapan',
                'alamat' => 'Jl. Sudirman No. 10',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bagus',
                'nis' => '220003',
                'nisn' => '990003',
                'tempat_lahir' => 'Surabaya',
                'tanggal_lahir' => '2014-03-25',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'sekolah_asal' => 'TK Melati',
                'alamat' => 'Jl. Diponegoro No. 5',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Citra',
                'nis' => '220004',
                'nisn' => '990004',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '2014-04-30',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Hindu',
                'sekolah_asal' => 'SDN 1 Yogyakarta',
                'alamat' => 'Jl. Malioboro No. 8',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Dina',
                'nis' => '220005',
                'nisn' => '990005',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '2014-05-10',
                'jenis_kelamin' => 'Perempuan',
                'agama' => 'Budha',
                'sekolah_asal' => 'SDN 3 Medan',
                'alamat' => 'Jl. Gatot Subroto No. 12',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Eko',
                'nis' => '220006',
                'nisn' => '990006',
                'tempat_lahir' => 'Semarang',
                'tanggal_lahir' => '2014-06-15',
                'jenis_kelamin' => 'Laki-laki',
                'agama' => 'Islam',
                'sekolah_asal' => 'SDN 2 Semarang',
                'alamat' => 'Jl. Pahlawan No. 3',
                'kelas_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
