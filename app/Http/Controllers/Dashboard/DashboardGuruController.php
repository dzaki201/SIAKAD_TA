<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Absensi;
use App\Models\KunciNilai;
use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use App\Models\KelasMataPelajaran;
use App\Models\PlotGuruMapel;
use App\Models\SiswaEkstrakulikuler;
use Database\Seeders\SiswaSeeder;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;

class DashboardGuruController extends Controller
{
   public function guruIndex()
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();
      return view('Guru.layouts.dashboard', compact('mapels'));
   }
   public function guruNilai($id)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::where('id', $id)->first();
      $tahun = TahunAjaran::where('status', 1)->first();
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
         return view('guru.layouts.nilai', compact('mapels', 'tahun', 'kunci', 'mapel', 'kelas'));
      }
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
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
      return view('guru.layouts.nilai', compact('siswas', 'mapels', 'capaians', 'mapel', 'tahun', 'nilais', 'nilaiakhirs', 'kunci', 'kelas'));
   }
   public function guruEditNilai($id, $cpId)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::where('id', $id)->first();
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();
      $cp = CapaianPembelajaran::where('id', $cpId)->first();
      $tahun = TahunAjaran::where('status', 1)->first();
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
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->where('mata_pelajaran_id', $mapel->id)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();

      return view('guru.layouts.edit-nilai-akhir', compact('siswas', 'mapels', 'mapel', 'tahun', 'nilaiakhirs', 'kelas'));
   }
   public function guruAbsensi()
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $tahun = TahunAjaran::where('status', 1)->first();

      $siswas = Siswa::with(['absensi' => function ($query) use ($tahun) {
         $query->where('tahun_ajaran_id', $tahun->id);
      }])->where('kelas_id', $kelasId)->get();

      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();
      $tahuns = TahunAjaran::get();
      return view('guru.layouts.absensi', compact('mapels', 'siswas', 'tahun', 'tahuns'));
   }
   public function guruAbsensiSearch(Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $tahun = TahunAjaran::where('id', $request->tahun)->first();

      $siswas = Siswa::with(['absensi' => function ($query) use ($request) {
         $query->where('tahun_ajaran_id', $request->tahun);
      }])->where('kelas_id', $kelasId)->get();

      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();
      $tahuns = TahunAjaran::get();
      return view('guru.layouts.absensi', compact('mapels', 'siswas', 'tahun', 'tahuns'));
   }
   public function guruEkskul()
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $tahun = TahunAjaran::where('status', 1)->first();

      $siswas = Siswa::with(['siswaekskul' => function ($query) use ($tahun) {
         $query->where('tahun_ajaran_id', $tahun->id)
            ->with('ekskul');
      }])->where('kelas_id', $kelasId)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();
      $tahuns = TahunAjaran::get();
      $ekskuls = Ekstrakulikuler::get();
      return view('guru.layouts.ekskul',  compact('mapels', 'siswas', 'tahun', 'tahuns', 'ekskuls'));
   }
   public function guruEkskulSearch(Request $request)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $tahun = TahunAjaran::where('id', $request->tahun)->first();

      $siswas = Siswa::with(['siswaekskul' => function ($query) use ($request) {
         $query->where('tahun_ajaran_id', $request->tahun)
            ->with('ekskul');
      }])->where('kelas_id', $kelasId)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->where('status', 'umum')
         ->get();
      $tahuns = TahunAjaran::get();
      $ekskuls = Ekstrakulikuler::get();
      return view('guru.layouts.ekskul',  compact('mapels', 'siswas', 'tahun', 'tahuns', 'ekskuls'));
   }
   public function guruRapor()
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $siswas = Siswa::where('kelas_id', $guru->kelas_id)->get();
      $tahun = TahunAjaran::where('status', 1)->first();


      // $plotGuruMapel = PlotGuruMapel::where('kelas_id', $guru->kelas_id)->pluck('guru_id');
      // $guruMapel = Guru::where('id', $plotGuruMapel)->pluck('id');
      // $capaians = CapaianPembelajaran::where(function ($query) use ($guru, $guruMapel) {
      //    $query->where('guru_id', $guru->id)
      //       ->orWhereIn('guru_id', $guruMapel);
      // })
      //    ->where('tahun_ajaran_id', $tahun->id)
      //    ->where('kelas_id', $guru->kelas_id)
      //    ->where('status', 'CP')
      //    ->get();
      $kelasMapel = KelasMataPelajaran::where('kelas_id', $guru->id)->pluck('mata_pelajaran_id');
      $mapels = MataPelajaran::whereIn('id', $kelasMapel)->get();

      $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      $ekskuls = SiswaEkstrakulikuler::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();
      $absensi = Absensi::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('tahun_ajaran_id', $tahun->id)
         ->get();

      $template = view('guru.layouts.rapor', compact('siswas', 'guru', 'tahun', 'mapels', 'nilaiakhirs', 'ekskuls', 'absensi'))->render();

      $outputPath = public_path('rapor_siswa_kelas_' . $guru->kelas->nama . '.pdf');
      Browsershot::html($template)
         ->showBackground()
         ->save($outputPath);

      return response()->download($outputPath);
   }
}
