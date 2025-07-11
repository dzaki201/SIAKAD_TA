<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use App\Models\KepalaSekolah;
use App\Models\MataPelajaran;
use App\Models\PlotGuruMapel;
use App\Models\PlotSiswaKelas;
use App\Models\Ekstrakulikuler;
use App\Models\KelasMataPelajaran;
use App\Http\Controllers\Controller;
use App\Models\Kkm;

class DashboardAdminController extends Controller
{
    public function adminIndex()
    {
        $user = User::count();
        $guru = Guru::count();
        $siswa = Siswa::count();
        $tahun = TahunAjaran::where('status', 1)->first();

        return view('Admin.layouts.dashboard', compact('guru', 'user', 'siswa', 'tahun'));
    }
    public function adminUser()
    {
        $users = User::get();
        return view('admin.layouts.user', compact('users'));
    }
    public function adminKepsek()
    {
        $kepseks = KepalaSekolah::all();
        $users = User::where('role', 'kepsek')
            ->whereNotIn('id', KepalaSekolah::pluck('user_id'))
            ->get();
        return view('admin.layouts.kepala-sekolah', compact('kepseks', 'users'));
    }
    public function adminGuru()
    {
        $gurus = Guru::all();
        $users = User::where(function ($query) {
            $query->whereNull('role');
        })
            ->orWhereIn('role', ['guru', 'guru_mapel'])
            ->whereNotIn('id', Guru::pluck('user_id'))
            ->get();
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
        $mapels = MataPelajaran::where('status', 'khusus')->get();
        $kelasmapels = KelasMataPelajaran::get();
        $kelasgurumapels = PlotGuruMapel::get();

        $users = User::where('role', 'guru')->whereDoesntHave('guru')->get();
        return view('admin.layouts.guru.plotting-guru-mapel',  compact('gurus', 'mapels', 'kelasmapels', 'kelasgurumapels', 'users', 'gurukelases'));
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
        $tahun = TahunAjaran::where('status', 1)->first();
        $siswa = Siswa::when($request->filled('filter_kelas'), function ($query) use ($request) {
            $query->whereHas('kelasSiswa', function ($sub) use ($request) {
                $sub->where('kelas_id', $request->filter_kelas);
            });
        })->with(['kelasSiswa' => function ($query) {
            $query->orderByDesc('tahun_ajaran_id');
        }])->get();

        $siswas = $siswa->map(function ($item) use ($tahun) {
            $kelas = $item->kelasSiswa->firstWhere('tahun_ajaran_id', $tahun->id);
            if (!$kelas) {
                $kelas = $item->kelasSiswa->first();
            }

            $item->setRelation('kelasSiswa', $kelas);
            return $item;
        });
        return view('admin.layouts.siswa.edit-kelas-siswa', compact('siswas', 'kelases', 'tahun'));
    }
    public function adminOrangTua()
    {
        $userIds = OrangTua::whereNotNull('user_id')->pluck('user_id');
        $users = User::where('role', 'orang_tua')
            ->whereNotIn('id', $userIds)
            ->get();
        $orangtuas = OrangTua::with('siswa')->get();
        // dd($orangtuas);
        $siswas = Siswa::all();
        return view('admin.layouts.orang-tua', compact('orangtuas', 'siswas', 'users'));
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
        $kelasMapels = KelasMataPelajaran::get();
        return view('admin.layouts.mata-pelajaran', compact('mapels', 'kelases', 'kelasMapels'));
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
    public function adminKkm(Request $request)
    {
        $tahunLama = kkm::max('tahun_ajaran_id');
        $tahun = TahunAjaran::where('id', $request->tahun_ajaran_id ?? $tahunLama)->first();
        $kkm = Kkm::where('tahun_ajaran_id', $tahun->id)
            ->when($request->mata_pelajaran_id, function ($query) use ($request) {
                return $query->where('mata_pelajaran_id', $request->mata_pelajaran_id);
            })
            ->get();
        $mapels = MataPelajaran::all();
        $mapel = MataPelajaran::where('id', $request->mata_pelajaran_id)->first();
        $kelases = Kelas::all();
        $tahuns = TahunAjaran::all();
        return view('admin.layouts.kkm', compact('kkm', 'mapel', 'mapels', 'tahun', 'tahuns', 'kelases', 'tahunLama'));
    }
}
