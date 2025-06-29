<?php

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Models\PlotSiswaKelas;
use App\Http\Controllers\Controller;

class PlotSiswaKelasController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'kelas_id' => 'required|exists:kelas,id',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id'
        ]);

        $existingIds = PlotSiswaKelas::whereIn('siswa_id', $request->siswa_id)
            ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->pluck('siswa_id')
            ->toArray();

        if (!empty($existingIds)) {
            PlotSiswaKelas::whereIn('siswa_id', $existingIds)
                ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
                ->update([
                    'kelas_id' => $request->kelas_id
                ]);
        }

        $newIds = array_diff($request->siswa_id, $existingIds);
        if (!empty($newIds)) {
            $dataToInsert = collect($newIds)->map(function ($siswaId) use ($request) {
                return [
                    'siswa_id' => $siswaId,
                    'kelas_id' => $request->kelas_id,
                    'tahun_ajaran_id' => $request->tahun_ajaran_id
                ];
            })->toArray();
            PlotSiswaKelas::insert($dataToInsert);
        }

        return redirect()->back()->with('success', 'Kelas siswa berhasil diubah!');
    }
}
