<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kkm;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\PlotSiswaKelas;
use App\Models\KelasMataPelajaran;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use App\Models\KepalaSekolah;
use App\Models\SiswaEkstrakulikuler;

class DashboardKepalaSekolahController extends Controller
{
    public function kepsekIndex(Request $request)
    {
        $kepsek = KepalaSekolah::where('user_id', auth()->user()->id)->first();
        $kelases = Kelas::all();
        $mapels = MataPelajaran::all();
        $kelas = Kelas::all()->count();
        $siswa = Siswa::all()->count();
        $guru = Guru::all()->count();
        $mapel = $mapels->count();

        $mapelId = $request->mata_pelajaran_id ?? MataPelajaran::orderBy('id')->value('id');
        $nilai = NilaiAkhir::where('mata_pelajaran_id', $mapelId)->get();
        $kkmlist = Kkm::where('mata_pelajaran_id', $mapelId)
            ->get()
            ->keyBy(function ($item) {
                return $item->tahun_ajaran_id . '-' . $item->mata_pelajaran_id;
            });
        $tahunAjaran = TahunAjaran::all()->keyBy('id');
        $mapelSelect = MataPelajaran::where('id', $mapelId)->first();
        $namaMapel = $mapelSelect->nama;

        $hasilPerTahun = $nilai->groupBy('tahun_ajaran_id')->map(function ($items, $tahunId) use ($kkmlist, $tahunAjaran) {
            $siswaDiAtasKKM = $items->filter(function ($item) use ($kkmlist, $tahunId) {
                $kkm = $kkmlist->get($tahunId . '-' . $item->mata_pelajaran_id)->kkm ?? 0;
                return $item->nilai_akhir >= $kkm;
            })->pluck('siswa_id')->unique();
            $label = 'Tahun tidak ditemukan';
            if (isset($tahunAjaran[$tahunId])) {
                $label = 'Semester ' . $tahunAjaran[$tahunId]->semester . ' - ' . $tahunAjaran[$tahunId]->tahun;
            }
            return [
                'label' => $label,
                'jumlah_siswa' => $siswaDiAtasKKM->count()
            ];
        })->values();
        return view('KepalaSekolah.layouts.dashboard', compact('kepsek', 'kelases', 'kelas', 'siswa', 'guru', 'mapel', 'mapels', 'hasilPerTahun', 'namaMapel', 'mapelSelect'));
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

    public function cetakBukuInduk(Request $request)
    {
        $siswaIds = PlotSiswaKelas::where('kelas_id', $request->kelas_id)
            ->where('tahun_ajaran_id', $request->tahun_id)
            ->pluck('siswa_id');
        $siswas = Siswa::with(['kelasSiswa' => function ($q) use ($request) {
            $q->where('tahun_ajaran_id', $request->tahun_id);
        }])
            ->whereIn('id', $siswaIds)
            ->get();
        $tahun = TahunAjaran::find($request->tahun_id);
        $kelasMapel = KelasMataPelajaran::where('kelas_id', $request->kelas_id)->pluck('mata_pelajaran_id');
        $mapels = MataPelajaran::whereIn('id', $kelasMapel)->get();

        $kelas = Kelas::find($request->kelas_id);
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

        $semester = $tahun->semester == 'Ganjil' ? 1 : ($tahun->semester == 'Genap' ? 2 : '-');
        $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswaIds)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $ekskuls = SiswaEkstrakulikuler::whereIn('siswa_id', $siswaIds)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $absensi = Absensi::whereIn('siswa_id', $siswaIds)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $template = view('KepalaSekolah.layouts.buku-induk', compact('siswas', 'tahun', 'kelas', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensi', 'fase', 'semester', 'angkaKelas'))->render();

        $tahunText = str_replace('/', '-', $tahun->tahun);
        $fileName = 'Buku_Induk_Kelas_' . $kelas->nama . '_Semester_' . $tahun->semester . '_' . $tahunText . '.pdf';

        $outputPath = public_path($fileName);

        Browsershot::html($template)
            ->showBackground()
            ->margins(10, 10, 10, 10)
            ->save($outputPath);

        return response()->download($outputPath, $fileName)->deleteFileAfterSend();
    }

    public function rekapSiswa(Request $request)
    {
        $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
        $tahuns = TahunAjaran::all();

        $nilai = NilaiAkhir::where('tahun_ajaran_id', $tahun->id)->get();
        $kkms = Kkm::where('tahun_ajaran_id', $tahun->id)->get();
        $plotKelas = PlotSiswaKelas::where('tahun_ajaran_id', $tahun->id)->get();

        $rekap = $kkms->map(function ($kkmItem) use ($nilai, $plotKelas) {
            $siswaDiKelas = $plotKelas->where('kelas_id', $kkmItem->kelas_id)->pluck('siswa_id');

            $jumlah = $nilai->where('mata_pelajaran_id', $kkmItem->mata_pelajaran_id)
                ->filter(function ($item) use ($kkmItem, $siswaDiKelas) {
                    return in_array($item->siswa_id, $siswaDiKelas->toArray()) && $item->nilai_akhir < $kkmItem->nilai;
                })
                ->count();

            return [
                'mapel'  => $kkmItem->mataPelajaran->nama,
                'kelas'  => $kkmItem->kelas->nama,
                'kkm'    => $kkmItem->nilai,
                'jumlah' => $jumlah
            ];
        });

        $kelases = Kelas::all();
        return view('kepalaSekolah.layouts.rekap-siswa', compact('rekap', 'tahuns', 'tahun', 'kelases'));
    }
    public function grafikNilai(Request $request)
    {
        $kelas = Kelas::where('id', $request->kelas_id)->first();
        $kelases = Kelas::all();

        $mapel = $request->mata_pelajaran_id
            ? MataPelajaran::where('id', $request->mata_pelajaran_id)->first()
            : MataPelajaran::first();

        $nilaiAkhirs = NilaiAkhir::where('siswa_id', $request->siswa_id)
            ->where('mata_pelajaran_id', $mapel->id)
            ->get();

        $rekapChart = $nilaiAkhirs->map(function ($item) use ($mapel) {
            $tahun = TahunAjaran::where('id', $item->tahun_ajaran_id)->first();
            return [
                'mapel' => $mapel->nama,
                'nilai' => $item->nilai_akhir,
                'tahun_ajaran' => $tahun->semester . '-' . $tahun->tahun
            ];
        });
        return view('KepalaSekolah.layouts.grafik-nilai', compact('kelases', 'kelas', 'mapel', 'nilaiAkhirs', 'rekapChart'));
    }
}
