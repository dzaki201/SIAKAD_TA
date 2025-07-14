<?php

namespace Database\Seeders;

use DB;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\OrangTuaSiswa;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrangTuaAyahSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = storage_path('app/public/seeder/data_ayah.xlsx');

        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray(null, true, true, true);

        $siswas = Siswa::orderBy('id')->get();
        $index = 0;

        foreach (array_slice($rows, 1) as $row) {
            if (empty(array_filter($row))) {
                continue;
            }

            if (!isset($siswas[$index])) {
                break;
            }
            $ortu = OrangTua::create([
                'user_id'    => null,
                'nik'        => $row['A'] ?: null,
                'nama'       => $row['B'] ? Str::title(strtolower($row['B'])) : '-',
                'pekerjaan'  => $row['C'] ?? '-',
                'alamat'     => $row['D'] ?? '-',
                'no_hp'      => $row['E'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            OrangTuaSiswa::create([
                'orang_tua_id' => $ortu->id,
                'siswa_id'     => $siswas[$index]->id,
                'status'       => 'Ayah',
            ]);
            $index++;
        }
    }


    // public function run(): void
    // {
    //     OrangTua::insert([
    //         [
    //             'user_id' => 8,
    //             'nama' => 'Bapak Andi',
    //             'nik' => '3172011111110001',
    //             'pekerjaan' => 'Karyawan Swasta',
    //             'alamat' => 'Jl. Merdeka No. 1',
    //             'no_hp' => '081234567890',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'user_id' => null,
    //             'nama' => 'Ibu Sari',
    //             'nik' => '3172011111110002',
    //             'pekerjaan' => 'Ibu Rumah Tangga',
    //             'alamat' => 'Jl. Merdeka No. 1',
    //             'no_hp' => '081234567891',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'user_id' => 9,
    //             'nama' => 'Bapak Budi',
    //             'nik' => '3172011111110003',
    //             'pekerjaan' => 'Guru',
    //             'alamat' => 'Jl. Sudirman No. 10',
    //             'no_hp' => '081234567892',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'user_id' => null,
    //             'nama' => 'Ibu Nina',
    //             'nik' => '3172011111110004',
    //             'pekerjaan' => 'Pegawai Negeri',
    //             'alamat' => 'Jl. Sudirman No. 10',
    //             'no_hp' => '081234567893',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //         [
    //             'user_id' => 10,
    //             'nama' => 'Pak Joko',
    //             'nik' => '3172011111110005',
    //             'pekerjaan' => 'Petani',
    //             'alamat' => 'Jl. Diponegoro No. 5',
    //             'no_hp' => '081234567894',
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ],
    //     ]);
    // }
}
