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
use Illuminate\Support\Facades\Auth;

class DashboardGuruMapelController extends Controller
{
    public function guruMapelIndex()
    {
        $userId = Auth::id();
        $guru = Guru::where('user_id', $userId)->first();
        $kelasMapel = PlotGuruMapel::where('guru_id', $guru->id)->pluck('kelas_id');
        $kelases = Kelas::whereIn('id', $kelasMapel)->get();
        $tahun = TahunAjaran::where('status', 1)->first();

        $siswas = PlotSiswaKelas::whereIn('kelas_id', $kelasMapel)
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
        $jumlahSiswa = $siswas->groupBy('kelas_id')->map(function ($items) {
            return $items->count();
        });
        // dd($siswaIds);
        $mapel = MataPelajaran::where('id', $guru->mata_pelajaran_id)->first();

        // $rataNilai = NilaiAkhir::whereIn('siswa_id', $siswaIds)
        //     ->where('guru_id', $guru->id)
        //     ->where('mata_pelajaran_id', $guru->mata_pelajaran_id)
        //     ->get()
        //     ->groupBy(['siswa.kelas_id', 'tahun_ajaran_id'])
        //     ->map(function ($byTahunAjaran, $kelasId) {
        //         $kelas = Kelas::find($kelasId);
        //         return [
        //             'kelas' => $kelas->nama,
        //             'data' => $byTahunAjaran->map(function ($items, $tahunAjaranId) {
        //                 $tahunAjaran = TahunAjaran::find($tahunAjaranId);
        //                 $label = "Semester {$tahunAjaran->semester} - {$tahunAjaran->tahun}";
        //                 return [
        //                     'label' => $label,
        //                     'rata_rata' => $items->avg('nilai_akhir')
        //                 ];
        //             })->values()
        //         ];
        //     })->values();

        // $labels = $rataNilai->pluck('data')
        //     ->flatten(1)
        //     ->pluck('label')
        //     ->unique()
        //     ->values();
        // $kelaslabels = $rataNilai->pluck('kelas')->unique()->values();
        return view('GuruMapel.layouts.dashboard', compact('kelases', 'jumlahSiswa', 'mapel'));
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

        if (!$kunci) {
            return view('guruMapel.layouts.nilai', compact('tahun', 'tahuns', 'tahunAktif', 'kunci', 'mapel', 'kelas', 'kelases'));
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
            ->where('mata_pelajaran_id', $mapel->id)->get();

        return view('GuruMapel.layouts.nilai', compact('kelases', 'siswas', 'mapel', 'tahun', 'capaians', 'kelas', 'nilais', 'nilaiakhirs', 'kunci', 'tahunAktif', 'tahuns'));
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
