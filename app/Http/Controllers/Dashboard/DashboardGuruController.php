<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Kkm;
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
use App\Models\PlotGuruMapel;
use App\Models\PlotSiswaKelas;
use App\Models\Ekstrakulikuler;
use Database\Seeders\SiswaSeeder;
use App\Models\KelasMataPelajaran;
use App\Models\CapaianPembelajaran;
use Spatie\Browsershot\Browsershot;
use App\Http\Controllers\Controller;
use App\Models\SiswaEkstrakulikuler;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
   public function guruIndex(Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $tahun = TahunAjaran::where('status', 1)->first();
      $tahuns = TahunAjaran::all();
      $mapel = $mapels->count();
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');
      $siswa = $siswaIds->count();
      $mapelIds = $mapels->pluck('id');

      $nilai = NilaiAkhir::whereIn('siswa_id', $siswaIds)
         ->whereIn('mata_pelajaran_id', $mapelIds)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      $kkmList = Kkm::whereIn('mata_pelajaran_id', $mapelIds)
         ->where('kelas_id', $kelasId)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get()
         ->keyBy('mata_pelajaran_id');

      $totalSiswaKkm = $nilai->filter(function ($item) use ($kkmList) {
         $kkm = $kkmList->get($item->mata_pelajaran_id)->nilai ?? 0;
         return $item->nilai_akhir < $kkm;
      })->unique('siswa_id')->count();

      $siswaKkm = $nilai->filter(function ($item) use ($kkmList) {
         $kkm = $kkmList->get($item->mata_pelajaran_id)->nilai ?? 0;
         return $item->nilai_akhir < $kkm;
      })->sortBy('siswa_id');


      $mataPelajaranId = $request->mata_pelajaran_id ?? $mapelIds->first();
      $mapelSelect =  MataPelajaran::where('id', $request->mata_pelajaran_id ?? $mapelIds->first())->first();

      $cp = CapaianPembelajaran::where('mata_pelajaran_id', $mataPelajaranId)
         ->where('kelas_id', $kelasId)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $cpIds = $cp->pluck('id');
      $detailNilai = Nilai::whereIn('siswa_id', $siswaIds)
         ->whereIn('capaian_pembelajaran_id', $cpIds)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get()
         ->keyBy('capaian_pembelajaran_id');
      $capaianPembelajaran = $cp->keyBy('id');

      $rataRataPerCP = $detailNilai->groupBy('capaian_pembelajaran_id')->map(function ($item, $key) use ($capaianPembelajaran) {
         $label = $capaianPembelajaran[$key]->nama ?? 'CP Tidak Ditemukan';
         return [
            'label' => $label,
            'rata_rata' => round($item->avg('nilai'), 2)
         ];
      });

      return view('Guru.layouts.dashboard', compact('guru', 'rataRataPerCP', 'mapels', 'kelas', 'tahun', 'siswa', 'mapel', 'totalSiswaKkm', 'siswaKkm', 'kkmList', 'tahuns', 'mapelSelect'));
   }
   public function guruSiswa(Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
      $tahuns = TahunAjaran::all();
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');
      $siswas = Siswa::with(['orangTua.user', 'kelasSiswa'])->whereIn('id', $siswaIds)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      return view('Guru.layouts.siswa', compact('tahun', 'tahuns', 'siswas', 'kelas', 'mapels'));
   }
   public function guruNilai($id, Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::with(['kelases' => function ($q) use ($kelasId) {
         $q->where('kelas_id', $kelasId);
      }])->where('id', $id)->first();
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
      $tahunAktif =  TahunAjaran::where('status', 1)->first();
      $tahuns = TahunAjaran::get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($mapel) {
         $query->where('kelas_id', $mapel->kelases->first()->id);
      })->get();
      if ($mapel->status == 'umum') {
         $kunci = KunciNilai::where('guru_id', $guru->id)
            ->where('mata_pelajaran_id', $id)
            ->where('kelas_id', $mapel->kelases->first()->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->first();
         $status = null;
      } else {
         $kunci = KunciNilai::where('mata_pelajaran_id', $id)
            ->where('kelas_id', $mapel->kelases->first()->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->first();
         $status = 'ada';
      }
      if (!$kunci) {
         return view('guru.layouts.nilai', compact('mapels', 'tahun', 'tahunAktif', 'tahuns', 'kunci', 'mapel', 'kelas', 'status'));
      }
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');
      $siswas = Siswa::whereIn('id', $siswaIds)->get();
      $capaians = CapaianPembelajaran::where('mata_pelajaran_id', $id)
         ->where('kelas_id', $mapel->kelases->first()->id)
         ->where('tahun_ajaran_id', $tahun->id)
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
      $kkm = Kkm::where('kelas_id', $kelasId)
         ->where('mata_pelajaran_id', $id)
         ->where('tahun_ajaran_id', $tahun->id)
         ->first();

      return view('guru.layouts.nilai', compact('siswas', 'mapels', 'capaians', 'mapel', 'tahun', 'tahuns', 'tahunAktif', 'nilais', 'nilaiakhirs', 'kunci', 'kelas', 'status', 'kkm'));
   }
   public function guruEditNilai($id, $cpId)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::where('id', $id)->first();
      $tahun = TahunAjaran::where('status', 1)->first();
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');
      $siswas = Siswa::whereIn('id', $siswaIds)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $cp = CapaianPembelajaran::where('id', $cpId)->first();
      $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('capaian_pembelajaran_id', $cpId)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      return view('guru.layouts.edit-nilai', compact('siswas', 'mapels', 'mapel', 'tahun', 'nilais', 'cpId', 'kelas', 'cp'));
   }
   public function guruEditNilaiAkhir($id, $kelasId)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::where('id', $id)->first();
      $tahun = TahunAjaran::where('status', 1)->first();
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');
      $siswas = Siswa::whereIn('id', $siswaIds)->get();
      $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->where('mata_pelajaran_id', $mapel->id)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();

      return view('guru.layouts.edit-nilai-akhir', compact('siswas', 'mapels', 'mapel', 'tahun', 'nilaiakhirs', 'kelas'));
   }
   public function guruAbsensi(Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');

      $siswas = Siswa::with(['absensi' => function ($query) use ($tahun) {
         $query->where('tahun_ajaran_id', $tahun->id);
      }])->whereIn('id', $siswaIds)->get();

      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $tahuns = TahunAjaran::get();
      return view('guru.layouts.absensi', compact('mapels', 'siswas', 'tahun', 'tahuns'));
   }

   public function guruEkskul(Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
      $tahunAktif = TahunAjaran::where('status', 1)->first();
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');

      $siswas = Siswa::with(['siswaekskul' => function ($query) use ($tahun) {
         $query->where('tahun_ajaran_id', $tahun->id)
            ->with('ekskul');
      }])->whereIn('id', $siswaIds)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $tahuns = TahunAjaran::get();
      $ekskuls = Ekstrakulikuler::get();
      return view('guru.layouts.ekskul',  compact('mapels', 'siswas', 'tahun', 'tahuns', 'tahunAktif', 'ekskuls'));
   }
   public function guruRapor(Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $kelases = Kelas::all();
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');

      $siswas = Siswa::whereIn('id', $siswaIds)->get();
      $tahuns = TahunAjaran::get();

      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $mapelsiswa = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })
         ->get();
      $totalMapel = $mapelsiswa->count();
      $mapelIds = $mapelsiswa->pluck('id');
      $nilaiPerSiswa = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get()
         ->groupBy('siswa_id');

      if ($nilaiPerSiswa->isEmpty()) {
         return view('Guru.layouts.rapor', compact('mapels', 'tahuns', 'tahun', 'siswas', 'nilaiPerSiswa', 'kelas', 'kelases'));
      }

      $progresRapor = $siswas->map(function ($siswa) use ($nilaiPerSiswa, $totalMapel, $tahun, $mapelIds, $kelasId) {
         $nilaiSiswa = $nilaiPerSiswa->get($siswa->id, collect());
         $mapelId = $nilaiSiswa->pluck('mata_pelajaran_id');
         $cekNilai = KunciNilai::whereIn('mata_pelajaran_id', $mapelId)
            ->where('tahun_ajaran_id', $tahun->id)
            ->where('kelas_id', $kelasId)
            ->where('is_locked', 1)
            ->get();

         $mapelAda = $cekNilai->pluck('mata_pelajaran_id');
         $mapelBelumAda = MataPelajaran::whereIn('id', $mapelIds->diff($mapelAda))->pluck('nama')->toArray();
         $mapelNilaiAda = $mapelAda->count();
         $persenNilai = $totalMapel > 0 ? round(($mapelNilaiAda / $totalMapel) * 100, 2) : 0;
         $belum = [];
         $progressItem = 0;

         if ($persenNilai >= 100) {
            $progressItem++;
         } else {
            $belum[] = 'Nilai Akhir';
         }

         $absensiAda = Absensi::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->where(function ($query) {
               $query->where('sakit', '>', 0)
                  ->orWhere('ijin', '>', 0)
                  ->orWhere('alpa', '>', 0);
            })
            ->exists();
         if ($absensiAda) {
            $progressItem++;
         } else {
            $belum[] = 'Absensi';
         }

         $ekskulAda = SiswaEkstrakulikuler::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->exists();
         if ($ekskulAda) {
            $progressItem++;
         } else {
            $belum[] = 'Ekstrakulikuler';
         }

         $catatanAda = CatatanGuru::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->exists();
         if ($catatanAda) {
            $progressItem++;
         } else {
            $belum[] = 'Catatan Guru';
         }

         if ($tahun->semester == 'Genap') {
            $naikKelasAda = NaikKelas::where('siswa_id', $siswa->id)
               ->where('tahun_ajaran_id', $tahun->id)
               ->exists();
            if ($naikKelasAda) {
               $progressItem++;
            } else {
               $belum[] = 'Status Naik Kelas';
            }
         }
         if ($tahun->semester == 'Genap') {
            $totalKomponen = 5;
         } else {
            $totalKomponen = 4;
         }

         $persenRapor = round(($progressItem / $totalKomponen) * 100, 2);
         return [
            'siswa_id' => $siswa->id,
            'tahun_id' => $tahun->id,
            'persen_nilai' => $persenNilai,
            'persen_rapor' => $persenRapor,
            'mapel_belum_nilai' => $mapelBelumAda,
            'belum_isi' => $belum,
         ];
      });

      $nilaiAkhir = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get()
         ->groupBy('siswa_id');
      $catatan = CatatanGuru::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get()
         ->groupBy('siswa_id');
      $naikKelas = NaikKelas::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get()
         ->groupBy('siswa_id');
      $siswas->map(function ($siswa) use ($nilaiAkhir, $catatan, $naikKelas) {
         $siswa->setAttribute('nilaiAkhir', $nilaiAkhir->get($siswa->id, collect()));
         $siswa->setAttribute('catatan', $catatan->get($siswa->id, collect())->first());
         $siswa->setAttribute('naikKelas', $naikKelas->get($siswa->id, collect())->first());
         return $siswa;
      });

      return view('Guru.layouts.rapor', compact('mapels', 'tahuns', 'tahun', 'siswas', 'progresRapor', 'nilaiPerSiswa', 'kelas', 'kelases'));
   }
   public function guruRaporSemuaSiswa(Request $request)
   {
      $siswa = PlotSiswaKelas::where('kelas_id', $request->kelas_id)
         ->where('tahun_ajaran_id', $request->tahun_id)
         ->pluck('siswa_id');
      $siswas = Siswa::with(['kelasSiswa' => function ($q) use ($request) {
         $q->where('tahun_ajaran_id', $request->tahun_id);
      }])->whereIn('id', $siswa)->get();

      $guru = Guru::where('kelas_id', $request->kelas_id)->first();
      $kepsek = KepalaSekolah::first();
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
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

      $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $ekskuls = SiswaEkstrakulikuler::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $absensis = Absensi::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $catatans = CatatanGuru::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      if ($tahun->semester == 'Genap') {
         $keputusans = NaikKelas::whereIn('siswa_id', $siswas->pluck('id'))
            ->where('tahun_ajaran_id', $tahun->id)
            ->get();
      } else {
         $keputusans = false;
      }

      $template = view('guru.layouts.rapor-semua-siswa', compact('siswas', 'guru', 'tahun', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensis', 'fase', 'semester', 'catatans', 'keputusans', 'kepsek', 'angkaKelas'))->render();

      $tahunText = str_replace('/', '-', $tahun->tahun);
      $fileName = 'Rapor_Siswa_Kelas_' .  $kelas->nama . '_Semester_' . $tahun->semester . '_' . $tahunText . '.pdf';

      $outputPath = public_path($fileName);
      Browsershot::html($template)
         ->showBackground()
         ->save($outputPath);

      return response()->download($outputPath, $fileName)->deleteFileAfterSend();
   }

   public function guruRaporSiswa($id, Request $request)
   {
      $siswa = Siswa::with(['kelasSiswa' => function ($q) use ($request) {
         $q->where('tahun_ajaran_id', $request->tahun_id);
      }])->where('id', $id)->first();

      $guru = Guru::where('kelas_id', $request->kelas_id)->first();
      $kepsek = KepalaSekolah::first();
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
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

      $template = view('guru.layouts.rapor-siswa', compact('siswa', 'guru', 'tahun', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensi', 'fase', 'semester', 'catatan', 'keputusan', 'nextKelas', 'teksKelas', 'kepsek'))->render();

      $tahunText = str_replace('/', '-', $tahun->tahun);
      $fileName = ('Rapor_' . $siswa->nama . '_Semester_' . $tahun->semester . '_' . $tahunText . '.pdf');

      $outputPath = public_path($fileName);
      Browsershot::html($template)
         ->showBackground()
         ->save($outputPath);

      return response()->download($outputPath, $fileName)->deleteFileAfterSend();
   }
}
