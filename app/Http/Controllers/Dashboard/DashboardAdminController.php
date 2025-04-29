<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function adminIndex()
    {
        return view('Admin.layouts.dashboard');
    }
    public function adminGuru()
    {
        $gurus = Guru::all();
        $mapels = MataPelajaran::doesntHave('guru')->get();
        $kelases = Kelas::doesntHave('guru')->get();
        $users = User::where('role', 'guru')->whereDoesntHave('guru')->get();
        return view('admin.layouts.guru', compact('gurus', 'mapels', 'kelases', 'users'));
    }
    public function adminMataPelajaran()
    {
        $mapels = MataPelajaran::all();
        return view('admin.layouts.matapelajaran', compact('mapels'));
    }
    public function adminKelas()
    {
        $kelases = Kelas::all();
        return view('admin.layouts.kelas', compact('kelases'));
    }
}
