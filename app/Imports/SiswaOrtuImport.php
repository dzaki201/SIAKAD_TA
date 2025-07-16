<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\OrangTuaSiswa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SiswaOrtuImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index < 2) continue;
            if (empty($row[0])) continue;
            $tanggal = null;
            if (!empty($row[4])) {
                try {
                    if (is_numeric($row[4])) {
                        $tanggal = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y-m-d');
                    } else {
                        $tanggal = Carbon::parse($row[4])->format('Y-m-d');
                    }
                } catch (\Exception $e) {
                    $tanggal = null;
                }
            }

            $siswa = Siswa::create([
                'nama'          => $row[0],
                'nis'           => $row[1],
                'nisn'          => $row[2],
                'tempat_lahir'  => $row[3] ?? null,
                'tanggal_lahir' => $tanggal,
                'jenis_kelamin' => $row[5] ?? null,
                'agama'         => $row[6] ?? null,
                'sekolah_asal'  => $row[7] ?? null,
                'alamat'        => $row[8] ?? null,
            ]);

            if (!empty($row[9]) && !empty($row[10])) {
                $ayah = OrangTua::create([
                    'nik'       => $row[9],
                    'nama'      => $row[10],
                    'pekerjaan' => $row[11] ?? null,
                    'alamat'    => $row[12] ?? null,
                    'no_hp'     => $row[13] ?? null,
                ]);

                OrangTuaSiswa::create([
                    'siswa_id'     => $siswa->id,
                    'orang_tua_id' => $ayah->id,
                    'status'       => 'ayah',
                ]);
            }

            if (!empty($row[14]) && !empty($row[15])) {
                $ibu = OrangTua::create([
                    'nik'       => $row[14],
                    'nama'      => $row[15],
                    'pekerjaan' => $row[16] ?? null,
                    'alamat'    => $row[17] ?? null,
                    'no_hp'     => $row[18] ?? null,
                ]);

                OrangTuaSiswa::create([
                    'siswa_id'     => $siswa->id,
                    'orang_tua_id' => $ibu->id,
                    'status'       => 'ibu',
                ]);
            }
            if (!empty($row[19]) && !empty($row[20])) {
                $wali = OrangTua::create([
                    'nik'       => $row[19],
                    'nama'      => $row[20],
                    'pekerjaan' => $row[21] ?? null,
                    'alamat'    => $row[22] ?? null,
                    'no_hp'     => $row[23] ?? null,
                ]);

                OrangTuaSiswa::create([
                    'siswa_id'     => $siswa->id,
                    'orang_tua_id' => $wali->id,
                    'status'       => 'wali',
                ]);
            }
        }
    }
}
