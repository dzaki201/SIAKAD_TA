<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
   public function guruIndex()
   {
      return view('Guru.layouts.dashboard');
   }
   public function guruNilai()
   {
      $userId = Auth::id();
      $guru = Guru::where('user_id', $userId)->first();
      $kelasId = $guru->kelas_id;
      $siswas = Siswa::where('kelas_id', $kelasId)->get();
      $mapels = MataPelajaran::all();
      return view('guru.layouts.nilai', compact('siswas','mapels'));
   }
}
