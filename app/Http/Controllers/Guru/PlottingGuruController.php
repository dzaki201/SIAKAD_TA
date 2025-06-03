<?php

namespace App\Http\Controllers\Guru;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Models\PlotGuruMapel;
use App\Http\Controllers\Controller;

class PlottingGuruController extends Controller
{
    public function plotKelas(Request $request)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $guru = Guru::findOrFail($validatedData['guru_id']);
        if ($guru->mata_pelajaran_id) {
            $guru->mata_pelajaran_id = null;
        }

        $guru->kelas_id = $validatedData['kelas_id'];
        $guru->save();

        return redirect()->back()->with('success', 'Plotting Kelas berhasil.');
    }

    public function plotMapel(Request $request)
    {
        $validatedData = $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
        ]);

        $guru = Guru::findOrFail($validatedData['guru_id']);
        if ($guru->kelas_id) {
            $guru->kelas_id = null;
        }

        $guru->mata_pelajaran_id = $validatedData['mata_pelajaran_id'];
        $guru->save();
        return redirect()->back()->with('success', 'Plotting Mata Pelajaran berhasil .');
    }

    public function editPlotKelas(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $guru = Guru::findOrFail($id);
        if ($guru->mata_pelajaran_id) {
            $guru->mata_pelajaran_id = null;
        }

        $guru->update($validatedData);
        return redirect()->back()->with('success', 'Edit Plotting Kelas berhasil .');
    }

    public function editPlotMapel(Request $request, $id)
    {
        $validatedData = $request->validate([
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
        ]);

        $guru = Guru::findOrFail($id);
        if ($guru->kelas_id) {
            $guru->kelas_id = null;
        }

        $guru->update($validatedData);
        return redirect()->back()->with('success', 'Edit Plotting Mata Pelajaran berhasil .');
    }

    public function kelasGuruMapel(Request $request, $id)
    {

        $request->validate([
            'kelas_id'  => 'required|array',
            'kelas_id.*' => 'exists:kelas,id',
        ]);

        PlotGuruMapel::where('guru_id', $request->guru_id)->delete();
        $data = collect($request->kelas_id)->map(function ($kelasId) use ($id) {
            return [
                'guru_id'   => $id,
                'kelas_id'  => $kelasId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        PlotGuruMapel::insert($data);
        return redirect()->back()->with('success', 'Plotting guru mapel ke kelas berhasil disimpan.');
    }
}
