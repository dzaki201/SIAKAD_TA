<?php

namespace Database\Seeders;

use App\Models\CapaianPembelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CapaianPembelajaranSeeder extends Seeder
{
    public function run(): void
    {
         //Guru 1
        CapaianPembelajaran::insert([
            // Kelas 1
            ['nama' => 'Mengenal Warna Dasar', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-07-01', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Menggambar Bentuk Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-07-05', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kolase dari Kertas Warna', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-07-10', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Mengenal Pola Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-07-15', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Membuat Gambar Hewan', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-07-20', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Melukis Menggunakan Cat Air', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-07-25', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PTS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-08-01', 'tahun_ajaran_id' => 6, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PAS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 1, 'tanggal' => '2024-12-01', 'tahun_ajaran_id' => 6, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
            // Kelas 3
            ['nama' => 'Mengenal Warna Dasar', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-07-02', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Menggambar Bentuk Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-07-06', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kolase dari Kertas Warna', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-07-11', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Mengenal Pola Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-07-16', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Membuat Gambar Hewan', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-07-21', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Melukis Menggunakan Cat Air', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-07-26', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PTS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-08-02', 'tahun_ajaran_id' => 6, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PAS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 3, 'tanggal' => '2024-12-02', 'tahun_ajaran_id' => 6, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
            // Kelas 5
            // ['nama' => 'Mengenal Warna Dasar', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-07-03', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Menggambar Bentuk Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-07-07', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Kolase dari Kertas Warna', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-07-12', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Mengenal Pola Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-07-17', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Membuat Gambar Hewan', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-07-22', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Melukis Menggunakan Cat Air', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-07-27', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'PTS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-08-03', 'tahun_ajaran_id' => 6, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'PAS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 5, 'tanggal' => '2024-12-03', 'tahun_ajaran_id' => 6, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
            // Kelas 7
            // ['nama' => 'Mengenal Warna Dasar', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-07-04', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Menggambar Bentuk Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-07-08', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Kolase dari Kertas Warna', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-07-13', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Mengenal Pola Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-07-18', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Membuat Gambar Hewan', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-07-23', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'Melukis Menggunakan Cat Air', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-07-28', 'tahun_ajaran_id' => 6, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'PTS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-08-04', 'tahun_ajaran_id' => 6, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            // ['nama' => 'PAS Seni Rupa', 'mata_pelajaran_id' => 4, 'guru_id' => 1, 'kelas_id' => 7, 'tanggal' => '2024-12-04', 'tahun_ajaran_id' => 6, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
