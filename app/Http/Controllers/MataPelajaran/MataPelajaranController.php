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
            'nama_mata_pelajaran' => 'required|string',
        ]);

        MataPelajaran::create($validatedData);
        return redirect()->route('admin.matapelajaran')->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_mata_pelajaran' => 'required|string',
        ]);

        $mapel = MataPelajaran::findOrFail($id);
        $mapel->update($validatedData);
        return redirect()->route('admin.matapelajaran')->with('success', 'Mata Pelajaran berhasil diperbaharui');
    }

    public function destroy(string $id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->delete();
        return redirect()->route('admin.matapelajaran')->with('success', 'Mata Pelajaran berhasil dihapus');
    }
}
