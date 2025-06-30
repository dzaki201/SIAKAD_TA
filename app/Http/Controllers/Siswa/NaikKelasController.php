<?php

namespace App\Http\Controllers\Siswa;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NaikKelas;

class NaikKelasController extends Controller
{
    public function Store(Request $request)
    {
        $validatedData = $request->validate([
            'status'   => 'required|in:naik,tinggal,lulus',
            'siswa_id' => 'required|exists:siswa,id',
        ]);

        $tahun = TahunAjaran::where('status', 1)->first();
        $validatedData['tahun_ajaran_id'] = $tahun->id;
        NaikKelas::create($validatedData);

        return redirect()->back()->with('success', 'Status naik kelas siswa berhasil disimpan.');
    }
}
