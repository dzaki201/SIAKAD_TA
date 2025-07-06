<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\PlotSiswaKelas;
use App\Models\KelasMataPelajaran;
use App\Http\Controllers\Controller;
use App\Models\SiswaEkstrakulikuler;

class DashboardKepalaSekolahController extends Controller
{
    public function kepsekIndex()
    {
        $kelases = Kelas::all();
        return view('KepalaSekolah.layouts.dashboard', compact('kelases'));
    }
    public function kepsekSiswa(Request $request, $id)
    {
        $kelases = Kelas::all();
        $kelas = Kelas::where('id', $id)->first();
        $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
        $tahuns = TahunAjaran::all();
        $siswaIds = PlotSiswaKelas::where('kelas_id', $id)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');
        $siswas = Siswa::with(['orangTua.user', 'kelasSiswa'])->whereIn('id', $siswaIds)->get();

        return view('KepalaSekolah.layouts.siswa', compact('tahun', 'tahuns', 'siswas', 'kelas', 'kelases'));
    }
    public function kepsekLihatBukuInduk(Request $request)
    {
        $kelases = Kelas::all();
        $siswa = Siswa::with(['kelasSiswa' => function ($q) use ($request) {
            $q->where('tahun_ajaran_id', $request->tahun_id);
        }])->where('id', $request->siswa_id)->first();

        $tahun = TahunAjaran::where('id', $request->tahun_id)->first();
        $kelasMapel = KelasMataPelajaran::where('kelas_id', $request->kelas_id)->pluck('mata_pelajaran_id');
        $mapels = MataPelajaran::whereIn('id', $kelasMapel)->get();
        $kelasMapel = KelasMataPelajaran::where('kelas_id', $request->kelas_id)->pluck('mata_pelajaran_id');
        $mapels = MataPelajaran::whereIn('id', $kelasMapel)->get();

        $kelas = Kelas::where('id', $request->kelas_id)->first();
        $angkaKelas = (int) substr($kelas->nama, 0, 1);
        if ($angkaKelas == 1 || $angkaKelas == 2) {
            $fase = 'Fase 1';
        } elseif ($angkaKelas == 3 || $angkaKelas == 4) {
            $fase = 'Fase 2';
        } elseif ($angkaKelas == 5 || $angkaKelas == 6) {
            $fase = 'Fase 3';
        } else {
            $fase = 'Tidak Diketahui';
        }
        if ($tahun->semester == 'Ganjil') {
            $semester = 1;
        } elseif ($tahun->semester == 'Genap') {
            $semester = 2;
        } else {
            $semester = '-';
        }
        $nilaiakhirs = NilaiAkhir::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $ekskuls = SiswaEkstrakulikuler::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();

        return view('KepalaSekolah.layouts.lihat-buku-induk', compact('kelases', 'siswa', 'tahun', 'kelas', 'fase', 'semester', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensi'));
    }
}
