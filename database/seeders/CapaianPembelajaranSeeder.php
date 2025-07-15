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
            //matematika
            ['nama' => 'Mengenal Angka 1-10', 'mata_pelajaran_id' => 5, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-01', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Menjumlahkan Bilangan Kecil', 'mata_pelajaran_id' => 5, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-05', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pengurangan Sederhana', 'mata_pelajaran_id' => 5, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-10', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Mengenal Bentuk Geometri', 'mata_pelajaran_id' => 5, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-15', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PTS Matematika', 'mata_pelajaran_id' => 5, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-08-01', 'tahun_ajaran_id' => 5, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PAS Matematika', 'mata_pelajaran_id' => 5, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-12-01', 'tahun_ajaran_id' => 5, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
            // Bahasa Indonesia
            ['nama' => 'Mengenal Huruf A-Z', 'mata_pelajaran_id' => 4, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-02', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Membaca Kata Sederhana', 'mata_pelajaran_id' => 4, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-06', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Menulis Nama Sendiri', 'mata_pelajaran_id' => 4, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-11', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Mengenal Cerita Pendek', 'mata_pelajaran_id' => 4, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-16', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PTS Bahasa Indonesia', 'mata_pelajaran_id' => 4, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-08-02', 'tahun_ajaran_id' => 5, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PAS Bahasa Indonesia', 'mata_pelajaran_id' => 4, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-12-02', 'tahun_ajaran_id' => 5, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
            //PPKn
            ['nama' => 'Mengenal Tata Tertib Sekolah', 'mata_pelajaran_id' => 3, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-03', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sopan Santun di Rumah dan Sekolah', 'mata_pelajaran_id' => 3, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-07', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Mengenal Lambang Negara', 'mata_pelajaran_id' => 3, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-12', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kerjasama di Lingkungan Sekolah', 'mata_pelajaran_id' => 3, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-07-17', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PTS PPKn', 'mata_pelajaran_id' => 3, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-08-03', 'tahun_ajaran_id' => 5, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PAS PPKn', 'mata_pelajaran_id' => 3, 'guru_id' => 5, 'kelas_id' => 6, 'tanggal' => '2024-12-03', 'tahun_ajaran_id' => 5, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
            //penjaskes
            ['nama' => 'Permainan Bola Sederhana', 'mata_pelajaran_id' => 2, 'guru_id' => 7, 'kelas_id' => 6, 'tanggal' => '2024-07-04', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Gerakan Dasar Lari dan Lompat', 'mata_pelajaran_id' => 2, 'guru_id' => 7, 'kelas_id' => 6, 'tanggal' => '2024-07-09', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Senam Irama', 'mata_pelajaran_id' => 2, 'guru_id' => 7, 'kelas_id' => 6, 'tanggal' => '2024-07-14', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PTS Penjaskes', 'mata_pelajaran_id' => 2, 'guru_id' => 7, 'kelas_id' => 6, 'tanggal' => '2024-08-05', 'tahun_ajaran_id' => 5, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PAS Penjaskes', 'mata_pelajaran_id' => 2, 'guru_id' => 7, 'kelas_id' => 6, 'tanggal' => '2024-12-05', 'tahun_ajaran_id' => 5, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
            //agama
            ['nama' => 'Mengenal Ajaran Agama di Indonesia', 'mata_pelajaran_id' => 1, 'guru_id' => 8, 'kelas_id' => 6, 'tanggal' => '2024-07-05', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Nilai-nilai Toleransi Antar Umat Beragama', 'mata_pelajaran_id' => 1, 'guru_id' => 8, 'kelas_id' => 6, 'tanggal' => '2024-07-10', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pentingnya Bersikap Jujur dan Adil', 'mata_pelajaran_id' => 1, 'guru_id' => 8, 'kelas_id' => 6, 'tanggal' => '2024-07-15', 'tahun_ajaran_id' => 5, 'status' => 'CP', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PTS Pendidikan Agama', 'mata_pelajaran_id' => 1, 'guru_id' => 8, 'kelas_id' => 6, 'tanggal' => '2024-08-07', 'tahun_ajaran_id' => 5, 'status' => 'PTS', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'PAS Pendidikan Agama', 'mata_pelajaran_id' => 1, 'guru_id' => 8, 'kelas_id' => 6, 'tanggal' => '2024-12-07', 'tahun_ajaran_id' => 5, 'status' => 'PAS', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
