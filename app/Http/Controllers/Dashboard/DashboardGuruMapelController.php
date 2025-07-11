<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KunciNilai;
use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\PlotGuruMapel;
use App\Models\PlotSiswaKelas;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use App\Models\Kkm;
use Illuminate\Support\Facades\Auth;

class DashboardGuruMapelController extends Controller
{
    public function guruMapelIndex()
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasMapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $tahun = TahunAjaran::where('status', 1)->first();
        $kelases = Kelas::whereIn('id', $kelasMapel)->get();
        $mapel = MataPelajaran::where('id', $guru->mata_pelajaran_id)->first();

        $siswaKelas = PlotSiswaKelas::whereIn('kelas_id', $kelasMapel)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get()
            ->keyBy('siswa_id');
        $siswa = $siswaKelas->count();
        $siswaIds = $siswaKelas->pluck('siswa_id');
        $nilai = NilaiAkhir::whereIn('siswa_id', $siswaIds)
            ->where('mata_pelajaran_id', $mapel->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $kkmList = Kkm::where('mata_pelajaran_id', $mapel->id)
            ->whereIn('kelas_id', $kelasMapel)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get()
            ->keyBy('kelas_id');

        $totalSiswaKkm = $nilai->filter(function ($item) use ($kkmList, $siswaKelas) {
            $kelasId = $siswaKelas->get($item->siswa_id)->kelas_id ?? null;
            if (!$kelasId) {
                return false;
            }
            $kkm = $kkmList->get($kelasId)->nilai ?? 0;
            return $item->nilai_akhir < $kkm;
        })->count();

        $siswaKkm = $nilai->filter(function ($item) use ($kkmList, $siswaKelas) {
            $kelasId = $siswaKelas->get($item->siswa_id)->kelas_id ?? null;
            if (!$kelasId) {
                return false;
            }
            $kkm = $kkmList->get($kelasId)->nilai ?? 0;
            return $item->nilai_akhir < $kkm;
        })->groupBy(function ($item) use ($siswaKelas) {
            return $siswaKelas->get($item->siswa_id)->kelas_id;
        });

        $kelas = $kelasMapel->count();
        return view('GuruMapel.layouts.dashboard', compact('kelases', 'siswa', 'mapel', 'kelas', 'tahun', 'siswaKkm', 'totalSiswaKkm', 'kkmList'));
    }
    public function guruMapelNilai(Request $request, $id)
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasMapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasMapel)->get();
        $kelas = Kelas::where('id', $id)->first();
        $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
        $tahunAktif = TahunAjaran::where('status', 1)->first();
        $tahuns = TahunAjaran::get();
        $mapel = MataPelajaran::where('id', $guru->mata_pelajaran_id)->first();
        $kunci = KunciNilai::where('guru_id', $guru->id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->where('kelas_id', $kelas->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->first();
        $status = null;

        if (!$kunci) {
            return view('guruMapel.layouts.nilai', compact('tahun', 'tahuns', 'tahunAktif', 'kunci', 'mapel', 'kelas', 'kelases', 'status'));
        }
        $siswaIds = PlotSiswaKelas::where('kelas_id', $kelas->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->pluck('siswa_id');
        $siswas = Siswa::whereIn('id', $siswaIds)->get();
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
            ->where('mata_pelajaran_id', $mapel->id)
            ->get();
        $kkm = Kkm::where('kelas_id', $id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->first();

        return view('GuruMapel.layouts.nilai', compact('kelases', 'siswas', 'mapel', 'tahun', 'capaians', 'kelas', 'nilais', 'nilaiakhirs', 'kunci', 'tahunAktif', 'tahuns', 'status', 'kkm'));
    }
    public function guruMapelEditNilai($id, $cpId)
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasMapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasMapel)->get();
        $kelas = Kelas::where('id', $id)->first();
        $mapel = MataPelajaran::where('id', $guru->mata_pelajaran_id)->first();
        $tahun = TahunAjaran::where('status', 1)->first();

        $siswaIds = PlotSiswaKelas::where('kelas_id', $kelas->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->pluck('siswa_id');
        $siswas = Siswa::whereIn('id', $siswaIds)->get();
        $cp = CapaianPembelajaran::where('id', $cpId)->first();
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
        $kelasMapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasMapel)->get();
        $kelas = Kelas::where('id', $kelasId)->first();
        $mapel = MataPelajaran::where('id', $id)->first();
        $tahun = TahunAjaran::where('status', 1)->first();
        $siswaIds = PlotSiswaKelas::where('kelas_id', $kelas->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->pluck('siswa_id');
        $siswas = Siswa::whereIn('id', $siswaIds)->get();
        $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
            ->where('tahun_ajaran_id', $tahun->id)
            ->where('mata_pelajaran_id', $mapel->id)->get();

        return view('guruMapel.layouts.edit-nilai-akhir', compact('siswas', 'mapel', 'tahun', 'nilaiakhirs', 'kelas', 'kelases'));
    }
}
