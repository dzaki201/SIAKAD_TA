<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use App\Http\Controllers\Controller;
use App\Models\CapaianPembelajaran;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
   public function guruIndex()
   {
      return view('Guru.layouts.dashboard');
   }
   public function guruNilai()
   {
      $mapels = MataPelajaran::all();
      return view('guru.layouts.nilai-dashboard', compact('mapels'));
   }
   public function guruGetNilai($id)
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;

      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $gurus = Guru::all();
      $mapels = MataPelajaran::all();
      $mapel = MataPelajaran::where('id',$id)->first();
      $capaians = CapaianPembelajaran::where('mata_pelajaran_id', $id)->get();

      return view('guru.layouts.nilai', compact('siswas', 'gurus', 'mapels', 'capaians', 'mapel'));
   }
}
