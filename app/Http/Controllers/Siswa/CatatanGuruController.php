<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\CatatanGuru;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class CatatanGuruController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'catatan' => 'required|string',
            'siswa_id' => 'required|exists:siswa,id',
        ]);

        $tahun = TahunAjaran::where('status', 1)->first();
        $validatedData['tahun_ajaran_id'] = $tahun->id;
        CatatanGuru::create($validatedData);

        return redirect()->back()->with('success', 'Catatan siswa berhasil disimpan.');
    }
    public function update(Request $request, $id)
    {
         $validatedData = $request->validate([
            'catatan' => 'required|string',
        ]);

        $catatan = CatatanGuru::findOrFail($id);
        $catatan->update($validatedData);

        return redirect()->back()->with('success', 'Catatan siswa berhasil diperbaharui.');
    }
}
