<?php

namespace App\Http\Controllers\Nilai;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KunciNilai;
use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use App\Models\PlotSiswaKelas;
use Illuminate\Support\Facades\Auth;

class NilaiAkhirController extends Controller
{
    public function store($id, $kelasId)
    {
        $guru = Guru::where('user_id', Auth::id())->firstOrFail();
        $tahunAjaran = TahunAjaran::where('status', '1')->firstOrFail();
        $isLocked = KunciNilai::where('guru_id', $guru->id)
            ->where('mata_pelajaran_id', $id)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->where('kelas_id', $kelasId)
            ->where('is_locked', 1)
            ->exists();

        if ($isLocked) {
            return redirect()->back()->with('errors', 'Data nilai untuk mata pelajaran ini sudah dikunci dan tidak bisa ditambahkan.');
        }

        $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->pluck('siswa_id');
        $cpIds = CapaianPembelajaran::whereIn('status', ['CP', 'PTS', 'PAS'])
            ->where('mata_pelajaran_id', $id)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->where('guru_id', $guru->id)
            ->where('kelas_id', $kelasId)
            ->pluck('id');
        $existing = Nilai::whereIn('siswa_id', $siswaIds)
            ->whereIn('capaian_pembelajaran_id', $cpIds)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->get();
        $hasilAkhir = $existing->groupBy('siswa_id')->map(function ($items) {
            $cp = $items->where('capaianPembelajaran.status', 'CP')->pluck('nilai');
            $pts = $items->where('capaianPembelajaran.status', 'PTS')->pluck('nilai');
            $pas = $items->where('capaianPembelajaran.status', 'PAS')->pluck('nilai');

            $rataCp = $cp->count() ? $cp->avg() : 0;
            $nilaiPts = $pts->first() ?? 0;
            $nilaiPas = $pas->first() ?? 0;
            $nilaiAkhir = (0.6 * $rataCp) + (0.2 * $nilaiPts) + (0.2 * $nilaiPas);

            return  round($nilaiAkhir, 3);
        });

        $nilaiAkhir = $hasilAkhir->map(function ($nilaiAkhir, $siswaId) use ($guru, $id, $tahunAjaran) {
            return [
                'siswa_id' => $siswaId,
                'guru_id' => $guru->id,
                'mata_pelajaran_id' => $id,
                'tahun_ajaran_id' => $tahunAjaran->id,
                'nilai_akhir' => $nilaiAkhir,
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->values()->all();

        if (count($nilaiAkhir) == 0) {
            return redirect()->back()->with('errors', 'Tidak ada data nilai untuk dihitung.');
        }
        NilaiAkhir::whereIn('siswa_id', $siswaIds)
            ->where('guru_id', $guru->id)
            ->where('mata_pelajaran_id', $id)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->delete();
        NilaiAkhir::insert($nilaiAkhir);
        return redirect()->back()->with('success', 'Nilai akhir berhasil dihitung.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'kelas_id' => 'required|exists:kelas,id',
            'keterangan' => 'required|array',
            'keterangan*' => 'nullable|string'
        ]);

        $kelasId = $request->kelas_id;
        $mapelId = $request->mapel_id;
        $keteranganInput = collect($request->keterangan);

        $tahunAjaran = TahunAjaran::where('status', '1')->firstOrFail();
        $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)
            ->where('tahun_ajaran_id', $tahunAjaran->id)
            ->pluck('siswa_id');
        $siswaIds->map(function ($siswaId) use ($keteranganInput, $mapelId) {
            $keterangan = $keteranganInput->get($siswaId);
            NilaiAkhir::where('siswa_id', $siswaId)
                ->where('mata_pelajaran_id', $mapelId)
                ->update(['keterangan' => $keterangan]);
        });

        $role = Auth::user()->role;
        if ($role === 'guru') {
            return redirect()->route('guru.nilai', $mapelId)->with('success', 'Nilai berhasil diperbarui.');
        } elseif ($role === 'guru_mapel') {
            return redirect()->route('guru-mapel.nilai', $kelasId)->with('success', 'Nilai berhasil diperbarui.');
        }
    }
}
