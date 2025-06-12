<?php

namespace App\Http\Controllers\Nilai;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'cp_id' => 'required|exists:capaian_pembelajaran,id',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id' => 'required|exists:kelas,id',
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100'
        ]);

        $cpId = $request->cp_id;
        $guru = Guru::where('user_id', Auth::id())->first();
        $mapelId = $request->mapel_id;
        $kelasId = $request->kelas_id;
        $nilaiInput = collect($request->nilai);
        $siswaIds = Siswa::where('kelas_id', $request->kelas_id)->pluck('id');
        $tahunAjaran = TahunAjaran::where('status', '1')->firstOrFail();

        $siswaIds->values()->map(function ($siswaId, $index) use ($nilaiInput, $cpId, $guru, $tahunAjaran) {
            Nilai::updateOrCreate(
                [
                    'siswa_id' => $siswaId,
                    'capaian_pembelajaran_id' => $cpId,
                    'guru_id' => $guru->id,
                    'tahun_ajaran_id' => $tahunAjaran->id
                ],
                [
                    'nilai' => $nilaiInput[$index]
                ]
            );
        });
        $role = Auth::user()->role;
        if ($role === 'guru') {
            return redirect()->route('guru.nilai', $mapelId)->with('success', 'Nilai berhasil diperbarui.');
        } elseif ($role === 'guru_mapel') {
            return redirect()->route('guru-mapel.nilai', $kelasId)->with('success', 'Nilai berhasil diperbarui.');
        }

        // return redirect()->route('guru.nilai', $mapelId)->with('success', 'Nilai berhasil diperbarui.');
    }
}
