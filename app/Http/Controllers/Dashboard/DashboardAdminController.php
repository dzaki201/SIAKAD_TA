<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ekstrakulikuler;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\KelasMataPelajaran;
use App\Models\MataPelajaran;
use App\Models\OrangTua;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function adminIndex()
    {
        $guru = Guru::count();
        $siswa = Siswa::count();
        return view('Admin.layouts.dashboard', compact('guru', 'siswa'));
    }
    public function adminGuru()
    {
        $gurus = Guru::all();
        $users = User::where('role', 'guru')->whereDoesntHave('guru')->get();
        return view('admin.layouts.guru', compact('gurus', 'users'));
    }
    public function adminPlottingGuruKelas()
    {
        $gurukelases = Guru::whereNotNull('kelas_id')->get();
        $gurus = Guru::whereNull('kelas_id')->get();
        $mapels = MataPelajaran::get();
        $kelases = Kelas::doesntHave('guru')->get();

        $users = User::where('role', 'guru')->whereDoesntHave('guru')->get();
        return view('admin.layouts.guru.plotting-guru-kelas',  compact('gurus', 'mapels', 'kelases', 'users', 'gurukelases'));
    }
    public function adminPlottingGuruMapel()
    {
        $gurukelases = Guru::whereNotNull('mata_pelajaran_id')->get();
        $gurus = Guru::whereNull('mata_pelajaran_id')->get();
        $mapels = MataPelajaran::get();
        $kelasmapels = KelasMataPelajaran::get();
// dd($kelasmapels);
        $users = User::where('role', 'guru')->whereDoesntHave('guru')->get();
        return view('admin.layouts.guru.plotting-guru-mapel',  compact('gurus', 'mapels', 'kelasmapels', 'users', 'gurukelases'));
    }
    public function adminSiswa()
    {
        $siswas = Siswa::all();
        $kelases = Kelas::all();
        return view('admin.layouts.siswa', compact('siswas', 'kelases'));
    }
    public function adminEditKelasSiswa(Request $request)
    {
        $kelases = Kelas::all();
        $siswa = Siswa::query();
        if ($request->filter_kelas) {
            $siswa->where('kelas_id', $request->filter_kelas);
        }
        $siswas = $siswa->get();
        return view('admin.layouts.siswa.edit-kelas-siswa', compact('siswas', 'kelases'));
    }
    public function adminOrangTua()
    {
        $orangtuas = OrangTua::all();
        $siswas = Siswa::all();
        return view('admin.layouts.orang-tua', compact('orangtuas', 'siswas'));
    }
    public function adminFilterEditKelasSiswa()
    {
        $siswas = Siswa::all();
        $kelases = Kelas::all();
        return view('admin.layouts.editkelassiswa', compact('siswas', 'kelases'));
    }
    public function adminMataPelajaran()
    {
        $kelases = Kelas::all();
        $mapels = MataPelajaran::all();
        return view('admin.layouts.mata-pelajaran', compact('mapels', 'kelases'));
    }
    public function adminKelas()
    {
        $kelases = Kelas::all();
        return view('admin.layouts.kelas', compact('kelases'));
    }
    public function adminTahunAjaran()
    {
        $tahuns = TahunAjaran::all();
        return view('admin.layouts.tahun-ajaran', compact('tahuns'));
    }
    public function adminEkstrakulikuler()
    {
        $ekskuls = Ekstrakulikuler::all();
        return view('admin.layouts.ekstrakulikuler', compact('ekskuls'));
    }
}
