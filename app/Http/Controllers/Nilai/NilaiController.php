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
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100'
        ]);

        $cpId = $request->cp_id;
        $guru = Guru::where('user_id', Auth::id())->first();
        $kelasId = $guru->kelas_id;
        $mapelId = $request->mapel_id;

        $nilaiInput = collect($request->nilai);
        $siswaIds = Siswa::where('kelas_id', $kelasId)->pluck('id');
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

        return redirect()->route('guru.nilai', $mapelId)->with('success', 'Nilai berhasil diperbarui.');
    }
}
