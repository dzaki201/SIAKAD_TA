<?php

namespace App\Http\Controllers\Siswa;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\PlotSiswaKelas;
use App\Http\Controllers\Controller;

class PlotSiswaKelasController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'kelas_id' => 'required',
            'tahun_ajaran_id' => 'required|exists:tahun_ajaran,id'
        ]);
        
        if ($request->kelas_id === 'lulus') {
            Siswa::whereIn('id', $request->siswa_id)->update(['status' => 1]);

            return redirect()->back()->with('success', 'Data siswa telah diluluskan.');
        }

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
