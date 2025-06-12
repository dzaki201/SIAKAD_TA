<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\PlotGuruMapel;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardGuruMapelController extends Controller
{
    public function guruMapelIndex()
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasmapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasmapel)->get();
        return view('GuruMapel.layouts.dashboard', compact('kelases'));
    }
    public function guruMapelNilai($id)
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasmapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasmapel)->get();
        $kelas = Kelas::where('id', $id)->first();
        $tahun = TahunAjaran::where('status', 1)->first();
        $mapel = MataPelajaran::where('id', $guru->mata_pelajaran_id)->first();
        $siswas = Siswa::where('kelas_id', $id)->get();
        $capaians = CapaianPembelajaran::where('mata_pelajaran_id', $mapel->id)
            ->where('kelas_id', $id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->where('guru_id', $guru->id)
            ->get()
            ->sortBy(function ($item) {
                $order = [
                    'CP' => 1,
                    'PTS' => 2,
                    'PAS' => 3,
                ];
                $statusOrder = $order[$item->status];
                return [$statusOrder, $item->tanggal];
            });
        $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))
            ->whereIn('capaian_pembelajaran_id', $capaians->pluck('id'))
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
            ->where('tahun_ajaran_id', $tahun->id)
            ->where('mata_pelajaran_id', $mapel->id)->get();

        return view('GuruMapel.layouts.nilai', compact('kelases', 'siswas', 'mapel', 'tahun', 'capaians', 'kelas', 'nilais', 'nilaiakhirs'));
    }
    public function guruMapelEditNilai($id, $cpId)
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasmapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasmapel)->get();
        $kelas = Kelas::where('id', $id)->first();
        $mapel = MataPelajaran::where('id', $guru->mata_pelajaran_id)->first();
        $siswas = Siswa::where('kelas_id', $id)->get();
        $cp = CapaianPembelajaran::where('id', $cpId)->first();
        $tahun = TahunAjaran::where('status', 1)->first();
        $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))
            ->where('capaian_pembelajaran_id', $cpId)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();

        return view('GuruMapel.layouts.edit-nilai', compact('siswas', 'kelases', 'tahun', 'nilais', 'cpId', 'kelas', 'mapel', 'cp'));
    }

    public function guruMapelEditNilaiAkhir($id, $kelasId)
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasmapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasmapel)->get();
        $kelas = Kelas::where('id', $kelasId)->first();
        $mapel = MataPelajaran::where('id', $id)->first();
        $tahun = TahunAjaran::where('status', 1)->first();
        $siswas = Siswa::where('kelas_id', $kelasId)->get();
        $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
            ->where('tahun_ajaran_id', $tahun->id)
            ->where('mata_pelajaran_id', $mapel->id)->get();

        return view('guruMapel.layouts.edit-nilai-akhir', compact('siswas', 'mapel', 'tahun', 'nilaiakhirs', 'kelas', 'kelases'));
    }
}
