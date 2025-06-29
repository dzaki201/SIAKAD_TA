<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlotSiswaKelas extends Controller
{
    public function updateKelas(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|array',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        PlotSiswaKelas::whereIn('id', $request->siswa_id)
            ->update(['kelas_id' => $request->kelas_id]);

        return redirect()->back()->with('success', 'Kelas siswa berhasil diubah!');
    }
}
