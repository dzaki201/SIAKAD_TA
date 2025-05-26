<?php

namespace App\Http\Controllers\Kelas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
        ]);

        Kelas::create($validatedData);
        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil ditambahkan');
    }
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($validatedData);
        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil diperbaharui');
    }

    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->route('admin.kelas')->with('success', 'Kelas berhasil dihapus');
    }
}
