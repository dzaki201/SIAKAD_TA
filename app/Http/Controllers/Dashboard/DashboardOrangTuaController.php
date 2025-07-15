<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\OrangTua;
use App\Models\NaikKelas;
use App\Models\KunciNilai;
use App\Models\NilaiAkhir;
use App\Models\CatatanGuru;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\KepalaSekolah;
use App\Models\MataPelajaran;
use App\Models\OrangTuaSiswa;
use App\Models\PlotSiswaKelas;
use App\Models\KelasMataPelajaran;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use App\Models\SiswaEkstrakulikuler;

class DashboardOrangTuaController extends Controller
{
    public function orangTuaIndex()
    {
        $tahun = TahunAjaran::where('status', 1)->first();
        $orangTua = OrangTua::where('user_id', auth()->user()->id)->first();
        if ($orangTua) {
            $siswaIds = OrangTuaSiswa::where('orang_tua_id', $orangTua->id)->pluck('siswa_id');
            $anak = Siswa::with(['kelasSiswa' => function ($q) use ($tahun) {
                $q->where('tahun_ajaran_id', $tahun->id);
            }])
                ->whereIn('id', $siswaIds)
                ->get();
        }else{
            $anak = null;
        }

        return view('OrangTua.layouts.dashboard', compact('anak', 'tahun', 'orangTua'));
    }
    public function orangTuaNilaiAkhir(Request $request)
    {
        $tahuns = TahunAjaran::all();
        $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
        $kelasId = PlotSiswaKelas::where('siswa_id', $request->siswa_id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->first('kelas_id');
        $tahunIds = NilaiAkhir::where('siswa_id', $request->siswa_id)
            ->pluck('tahun_ajaran_id')
            ->unique()
            ->values();
        $nilaiAkhirs = NilaiAkhir::where('siswa_id', $request->siswa_id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $siswaId = $request->siswa_id;
        return view('OrangTua.layouts.nilai-akhir', compact('tahun', 'tahuns', 'tahunIds', 'nilaiAkhirs', 'kelasId', 'siswaId'));
    }
    public function orangTuaNilai(Request $request)
    {
        $tahuns = TahunAjaran::get();
        $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
        $kunciStatus = KunciNilai::where('kelas_id', $request->kelas_id)
            ->where('mata_pelajaran_id', $request->mapel_id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->value('is_locked') == 1;
        $nilais = Nilai::with('capaianPembelajaran')
            ->where('siswa_id', $request->siswa_id)
            ->whereHas('capaianPembelajaran', function ($q) use ($request) {
                $q->where('mata_pelajaran_id', $request->mapel_id);
            })
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $mapel = MataPelajaran::where('id', $request->mapel_id)->first();

        $capaianPembelajaran = CapaianPembelajaran::where('mata_pelajaran_id', $request->mapel_id)
            ->get()
            ->keyBy('id');

        $nilaiPerCP = $nilais->map(function ($item) use ($capaianPembelajaran) {
            $label = $capaianPembelajaran[$item->capaian_pembelajaran_id]->nama ?? 'CP Tidak Ditemukan';
            return [
                'label' => $label,
                'nilai' => $item->nilai
            ];
        })->values();

        return view('OrangTua.layouts.nilai', compact('nilaiPerCP', 'tahun', 'tahuns', 'nilais', 'kunciStatus', 'mapel'));
    }

    public function orangTuaRapor(Request $request)
    {
        $siswa = Siswa::with(['kelasSiswa' => function ($q) use ($request) {
            $q->where('tahun_ajaran_id', $request->tahun_ajaran_id);
        }])->where('id', $request->siswa_id)->first();

        $guru = Guru::where('kelas_id', $siswa->kelasSiswa->first()->id)->first();
        $kepsek = KepalaSekolah::first();
        $tahun = TahunAjaran::where('id', $request->tahun_ajaran_id)->first() ?? TahunAjaran::where('status', 1)->first();
        $tahuns = TahunAjaran::get();
        $tahunIds = NilaiAkhir::where('siswa_id', $request->siswa_id)
            ->pluck('tahun_ajaran_id')
            ->unique()
            ->values();
        $kelasMapel = KelasMataPelajaran::where('kelas_id', $siswa->kelasSiswa->first()->id)->pluck('mata_pelajaran_id');
        $mapels = MataPelajaran::whereIn('id', $kelasMapel)->get();

        $kelas = Kelas::where('id', $siswa->kelasSiswa->first()->id)->first();
        $angkaKelas = (int) substr($kelas->nama, 0, 1);
        if ($angkaKelas == 1 || $angkaKelas == 2) {
            $fase = 'Fase 1';
        } elseif ($angkaKelas == 3 || $angkaKelas == 4) {
            $fase = 'Fase 2';
        } elseif ($angkaKelas == 5 || $angkaKelas == 6) {
            $fase = 'Fase 3';
        } else {
            $fase = '-';
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
        $mapelIds = $nilaiakhirs->pluck('mata_pelajaran_id')->unique();
        $guruIds = $nilaiakhirs->pluck('guru_id')->unique();
        $kunciNilais = KunciNilai::whereIn('mata_pelajaran_id', $mapelIds)
            ->whereIn('guru_id', $guruIds)
            ->where('tahun_ajaran_id', $request->tahun_ajaran_id)
            ->where('kelas_id', $siswa->kelasSiswa->first()->id)
            ->get();

        $ekskuls = SiswaEkstrakulikuler::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $absensi = Absensi::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $catatan = CatatanGuru::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->first();
        if ($tahun->semester == 'Genap') {
            $keputusan = NaikKelas::where('siswa_id', $siswa->id)
                ->where('tahun_ajaran_id', $tahun->id)
                ->first();
        } else {
            $keputusan = false;
        }
        $angkaKeHuruf = [
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            6 => 'Enam',
        ];
        if ($keputusan) {
            if ($keputusan->status == 'naik') {
                $nextKelas = $angkaKelas + 1;
            } elseif ($keputusan->status == 'tinggal') {
                $nextKelas = $angkaKelas;
            }
            $teksKelas = $angkaKeHuruf[$nextKelas] ?? $nextKelas;
        } else {
            $nextKelas = null;
            $teksKelas = null;
        }

        if (
            $nilaiakhirs->isEmpty() ||
            $ekskuls->isEmpty() ||
            $absensi->isEmpty() ||
            !$catatan ||
            ($tahun->semester == 'Genap' && !$keputusan) ||
            $kunciNilais->pluck('is_locked')->contains(0)
        ) {
            $rapor = null;
        } else {
            $rapor = 'ada';
        }

        return view('orangTua.layouts.rapor', compact('siswa', 'guru', 'kepsek', 'tahun', 'tahuns', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensi', 'fase', 'tahunIds', 'semester', 'catatan', 'keputusan', 'nextKelas', 'teksKelas', 'rapor'));
    }
}
