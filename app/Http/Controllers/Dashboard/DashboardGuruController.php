<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use App\Models\CapaianPembelajaran;
use App\Models\Kelas;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
   public function guruIndex()
   {
      $mapels = MataPelajaran::all();
      return view('Guru.layouts.dashboard', compact('mapels'));
   }

   public function guruNilai($id)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;

      $mapel = MataPelajaran::where('id', $id)->first();
      $capaians = CapaianPembelajaran::where('mata_pelajaran_id', $id)->orderBy('tanggal', 'asc')->get();
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $nilais = Nilai::whereIn('siswa_id', $siswas->pluck('id'))
         ->whereIn('capaian_pembelajaran_id', $capaians->pluck('id'))
         ->get();

      $mapels = MataPelajaran::all();
      $tahun = TahunAjaran::where('status', 'true')->first();

      return view('guru.layouts.nilai', compact('siswas', 'mapels', 'capaians', 'mapel', 'tahun','nilais'));
   }
   public function guruEditNilai($id,$cpId)
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
      $mapels = MataPelajaran::all();
      $tahun = TahunAjaran::where('status', 'true')->first();

      return view('guru.layouts.edit-nilai', compact('siswas', 'mapels', 'mapel', 'tahun','nilais', 'cpId','kelas','cp'));
   }
}
