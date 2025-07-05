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
      })->where('status', 'umum')
         ->get();
      return view('Guru.layouts.dashboard', compact('mapels', 'kelas'));
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
      })->where('status', 'umum')
         ->get();

      $nilaiAkhir = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get()
         ->groupBy('siswa_id');
      $siswas->map(function ($siswa) use ($nilaiAkhir) {
         $siswa->setAttribute('nilaiAkhir', $nilaiAkhir->get($siswa->id, collect()));
         return $siswa;
      });
      return view('Guru.layouts.siswa', compact('mapels', 'tahun', 'tahuns', 'siswas', 'kelas'));
   }
   public function guruNilai($id, Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::where('id', $id)->first();
      $tahun = TahunAjaran::where('id', $request->tahun_id)->first() ?? TahunAjaran::where('status', 1)->first();
      $tahunAktif =  TahunAjaran::where('status', 1)->first();
      $tahuns = TahunAjaran::get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();
      $kunci = KunciNilai::where('guru_id', $guru->id)
         ->where('mata_pelajaran_id', $id)
         ->where('kelas_id', $kelasId)
         ->where('tahun_ajaran_id', $tahun->id)
         ->first();

      if (!$kunci) {
         return view('guru.layouts.nilai', compact('mapels', 'tahun', 'tahunAktif', 'tahuns', 'kunci', 'mapel', 'kelas'));
      }
      $siswaIds = PlotSiswaKelas::where('kelas_id', $kelasId)->where('tahun_ajaran_id', $tahun->id)->pluck('siswa_id');
      $siswas = Siswa::whereIn('id', $siswaIds)->get();
      $capaians = CapaianPembelajaran::where('mata_pelajaran_id', $id)
         ->where('kelas_id', $guru->kelas_id)
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
      return view('guru.layouts.nilai', compact('siswas', 'mapels', 'capaians', 'mapel', 'tahun', 'tahuns', 'tahunAktif', 'nilais', 'nilaiakhirs', 'kunci', 'kelas'));
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
      })->where('status', 'umum')
         ->get();
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
      })->where('status', 'umum')
         ->get();

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
      })->where('status', 'umum')
         ->get();
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
      })->where('status', 'umum')
         ->get();
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
      })->where('status', 'umum')
         ->get();
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
         $mapelAda = $nilaiSiswa->pluck('mata_pelajaran_id');
         $mapelBelumAda = MataPelajaran::whereIn('id', $mapelIds->diff($mapelAda))->pluck('nama')->toArray();
         $mapelNilaiAda = $mapelAda->count();
         $persenNilai = $totalMapel > 0 ? round(($mapelNilaiAda / $totalMapel) * 100, 2) : 0;
         $belum = [];
         $progressItem = 0;

         // Nilai Akhir
         if ($persenNilai >= 100) {
            $progressItem++;
         } else {
            $belum[] = 'Nilai Akhir';
         }

         // Absensi
         $absensiAda = Absensi::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->where('kelas_id', $kelasId)
            ->exists();
         if ($absensiAda) {
            $progressItem++;
         } else {
            $belum[] = 'Absensi';
         }

         // Ekskul
         $ekskulAda = SiswaEkstrakulikuler::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->exists();
         if ($ekskulAda) {
            $progressItem++;
         } else {
            $belum[] = 'Ekstrakulikuler';
         }

         // Catatan Guru
         $catatanAda = CatatanGuru::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $tahun->id)
            ->exists();
         if ($catatanAda) {
            $progressItem++;
         } else {
            $belum[] = 'Catatan Guru';
         }

         // Naik Kelas
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

         $totalKomponen = 5;
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

      $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      $ekskuls = SiswaEkstrakulikuler::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $absensi = Absensi::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      $template = view('guru.layouts.rapor-semua-siswa', compact('siswas', 'guru', 'tahun', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensi', 'fase'))->render();

      $tahunText = str_replace('/', '-', $tahun->tahun);
      $fileName = 'Rapor_Siswa_Kelas_' .  $kelas->nama . '_Semester_' . $tahun->semester . '_' . $tahunText . '.pdf';

      $outputPath = public_path($fileName);
      Browsershot::html($template)
         ->showBackground()
         ->save($outputPath);

      return response()->download($outputPath, $fileName);
   }

   public function guruRaporSiswa($id, Request $request)
   {
      $siswa = Siswa::with(['kelasSiswa' => function ($q) use ($request) {
         $q->where('tahun_ajaran_id', $request->tahun_id);
      }])->where('id', $id)->first();

      $guru = Guru::where('kelas_id', $request->kelas_id)->first();
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

      $nilaiakhirs = NilaiAkhir::where('siswa_id', $siswa->id)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $ekskuls = SiswaEkstrakulikuler::where('siswa_id', $siswa->id)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $absensi = Absensi::where('siswa_id', $siswa->id)
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      $template = view('guru.layouts.rapor-siswa', compact('siswa', 'guru', 'tahun', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensi', 'fase'))->render();

      $tahunText = str_replace('/', '-', $tahun->tahun);
      $fileName = ('Rapor_' . $siswa->nama . '_Semester_' . $tahun->semester . '_' . $tahunText . '.pdf');

      $outputPath = public_path($fileName);
      Browsershot::html($template)
         ->showBackground()
         ->save($outputPath);

      return response()->download($outputPath, $fileName);
   }
}
