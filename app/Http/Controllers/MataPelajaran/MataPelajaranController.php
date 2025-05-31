<?php

namespace App\Http\Controllers\MataPelajaran;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id',
        ]);

        $mataPelajaran = MataPelajaran::create([
            'nama' => $validatedData['nama'],
        ]);

        $mataPelajaran->kelases()->attach($validatedData['kelas_id']);
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
            'kelas_id' => 'required|array',
            'kelas_id.*' => 'exists:kelas,id',
        ]);

        $mapel = MataPelajaran::findOrFail($id);
        $mapel->update([
            'nama' => $validatedData['nama'],
        ]);

        $mapel->kelases()->sync($validatedData['kelas_id']);
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil diperbaharui');
    }

    public function destroy(string $id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->delete();
        return redirect()->back()->with('success', 'Mata Pelajaran berhasil dihapus');
    }
}
