<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\KunciNilai;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Models\CapaianPembelajaran;
use App\Http\Controllers\Controller;
use App\Models\NilaiAkhir;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
   public function guruIndex()
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      return view('Guru.layouts.dashboard', compact('mapels'));
   }

   public function guruNilai($id)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;

      $mapel = MataPelajaran::where('id', $id)->first();
      $tahun = TahunAjaran::where('status', 1)->first();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $kunci = KunciNilai::where('guru_id', $guru->id)
         ->where('mata_pelajaran_id', $id)
         ->where('tahun_ajaran_id', $tahun->id)
         ->first();

      if (!$kunci) {
         return view('guru.layouts.nilai', compact('mapels', 'tahun', 'kunci', 'mapel'));
      }
      $capaians = CapaianPembelajaran::where('mata_pelajaran_id', $id)
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
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))
         ->whereIn('capaian_pembelajaran_id', $capaians->pluck('id'))
         ->get();
      $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('mata_pelajaran_id', $mapel->id)->get();
      return view('guru.layouts.nilai', compact('siswas', 'mapels', 'capaians', 'mapel', 'tahun', 'nilais', 'nilaiakhirs', 'kunci'));
   }
   public function guruEditNilai($id, $cpId)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::where('id', $id)->first();
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('capaian_pembelajaran_id', $cpId)
         ->get();
      $cp = CapaianPembelajaran::where('id', $cpId)->first();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $tahun = TahunAjaran::where('status', 1)->first();

      return view('guru.layouts.edit-nilai', compact('siswas', 'mapels', 'mapel', 'tahun', 'nilais', 'cpId', 'kelas', 'cp'));
   }
   public function guruEditNilaiAkhir($id)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $kelas = Kelas::where('id', $kelasId)->first();
      $mapel = MataPelajaran::where('id', $id)->first();
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $nilaiakhirs = NilaiAkhir::whereIn('siswa_id', $siswas->pluck('id'))
         ->where('mata_pelajaran_id', $mapel->id)->get();
      $mapels = MataPelajaran::whereHas('kelases', function ($query) use ($kelasId) {
         $query->where('kelas_id', $kelasId);
      })->get();
      $tahun = TahunAjaran::where('status', 1)->first();

      return view('guru.layouts.edit-nilai-akhir', compact('siswas', 'mapels', 'mapel', 'tahun', 'nilaiakhirs', 'kelas'));
   }
}
