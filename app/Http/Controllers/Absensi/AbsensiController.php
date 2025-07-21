<?php

namespace App\Http\Controllers\Absensi;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PlotSiswaKelas;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function store($id)
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasId = $guru->kelas_id;
        $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->pluck('siswa_id');
        $siswas = Siswa::whereIn('id', $siswaIds)->get();
        $siswas->map(function ($siswa) use ($kelasId, $id) {
            Absensi::create([
                'siswa_id' => $siswa->id,
                'ijin' => "0",
                'sakit' => "0",
                'alpa' => "0",
                'tahun_ajaran_id' => $id,
            ]);
        });

        return redirect()->back()->with('success', 'Absensi berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'ijin' => 'nullable|integer|min:0',
            'sakit' => 'nullable|integer|min:0',
            'alpa' => 'nullable|integer|min:0',
        ]);

        $absensi = Absensi::findOrFail($id);
        $absensi->update($validated);
        return redirect()->back()->with('success', 'Data absensi berhasil diperbarui.');
    }
}
