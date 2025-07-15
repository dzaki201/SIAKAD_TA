<?php

namespace App\Http\Controllers\Guru;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
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
        PlotGuruMapel::where('guru_id', $validatedData['guru_id'])->delete();
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
            'kelas_id' => 'nullable|exists:kelas,id',
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
            'mata_pelajaran_id' => 'nullable|exists:mata_pelajaran,id',
        ]);

        $guru = Guru::findOrFail($id);
        PlotGuruMapel::where('guru_id', $id)->delete();
        if ($guru->kelas_id) {
            $guru->kelas_id = null;
        }

        $guru->update($validatedData);
        return redirect()->back()->with('success', 'Edit Plotting Mata Pelajaran berhasil .');
    }

    public function kelasGuruMapel(Request $request, $id)
    {
        $request->validate([
            'kelas_id'   => 'nullable|array',
            'kelas_id.*' => 'exists:kelas,id',
        ]);

        $guru = Guru::findOrFail($id);

        if ($request->filled('kelas_id')) {
            $error = collect($request->kelas_id)
                ->map(function ($kelasId) use ($guru) {
                    $existingGuruIds = PlotGuruMapel::where('kelas_id', $kelasId)->pluck('guru_id');
                    $exists = Guru::whereIn('id', $existingGuruIds)
                        ->where('mata_pelajaran_id', $guru->mata_pelajaran_id)
                        ->exists();

                    if ($exists) {
                        $kelasNama = Kelas::find($kelasId)->nama;
                        return "Kelas $kelasNama sudah memiliki guru untuk mata pelajaran yang sama.";
                    }
                    return null;
                })
                ->filter()
                ->first();
            if ($error) {
                return back()->withErrors($error);
            }
            $data = collect($request->kelas_id)
                ->map(function ($kelasId) use ($id) {
                    return [
                        'guru_id'    => $id,
                        'kelas_id'   => $kelasId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                })
                ->toArray();

            PlotGuruMapel::where('guru_id', $id)->delete();
            PlotGuruMapel::insert($data);
        }
        return redirect()->back()->with('success', 'Plotting guru mapel ke kelas berhasil disimpan.');
    }
}
