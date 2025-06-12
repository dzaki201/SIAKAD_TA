<?php

use App\Models\NilaiAkhir;
use App\Models\TahunAjaran;
use App\Models\SiswaEkstrakulikuler;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guru\GuruController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Kelas\KelasController;
use App\Http\Controllers\Nilai\NilaiController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\Absensi\AbsensiController;
use App\Http\Controllers\Nilai\KunciNilaiController;
use App\Http\Controllers\Nilai\NilaiAkhirController;
use App\Http\Controllers\Guru\PlottingGuruController;
use App\Http\Controllers\OrangTua\OrangTuaController;
use App\Http\Controllers\Ekstrakulikuler\Ekstrakulikuler;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\Dashboard\DashboardGuruController;
use App\Http\Controllers\TahunAjaran\TahunAjaranController;
use App\Http\Controllers\Dashboard\DashboardAdminController;
use App\Http\Controllers\Nilai\CapaianPembelajaranController;
use App\Http\Controllers\Dashboard\DashboardOrangTuaController;
use App\Http\Controllers\MataPelajaran\MataPelajaranController;
use App\Http\Controllers\Dashboard\DashboardGuruMapelController;
use App\Http\Controllers\Ekstrakulikuler\EkstrakulikulerController;
use App\Http\Controllers\Ekstrakulikuler\SiswaEkstrakulikulerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'registerSave')->name('register.save');

    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// Route::middleware('auth')->group(function(){
//     Route::get('/beranda',[DashboardController::class,'BerandaUser'])->name('beranda.user');
// });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard', [DashboardAdminController::class, 'adminIndex'])->name('admin.dashboard');

    Route::get('/admin-user', [DashboardAdminController::class, 'adminUser'])->name('admin.user');
    Route::post('/admin-user', [UserController::class, 'store'])->name('admin.user.store');
    Route::put('/admin-user/{id}/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/admin-user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('/admin-guru', [DashboardAdminController::class, 'adminGuru'])->name('admin.guru');
    Route::get('/admin-plotting-guru-kelas', [DashboardAdminController::class, 'adminPlottingGuruKelas'])->name('admin.guru-kelas');
    Route::get('/admin-plotting-guru-mapel', [DashboardAdminController::class, 'adminPlottingGuruMapel'])->name('admin.guru-mapel');
    Route::post('/admin-guru', [GuruController::class, 'store'])->name('admin.guru.store');
    Route::post('/admin-plotting-guru-kelas', [PlottingGuruController::class, 'plotKelas'])->name('admin.plotting.guru-kelas');
    Route::post('/admin-plotting-guru-mapel', [PlottingGuruController::class, 'plotMapel'])->name('admin.plotting.guru-mapel');
    Route::post('/admin-kelas-guru-mapel/{id}', [PlottingGuruController::class, 'kelasGuruMapel'])->name('admin.kelas-guru-mapel');
    Route::post('/admin-edit-plotting-guru-kelas/{id}', [PlottingGuruController::class, 'editPlotKelas'])->name('admin.edit.plotting.guru-kelas');
    Route::post('/admin-edit-plotting-guru-mapel/{id}', [PlottingGuruController::class, 'editPlotMapel'])->name('admin.edit.plotting.guru-mapel');
    Route::put('/admin-guru/{id}/update', [GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/admin-guru/{id}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');

    Route::get('/admin-siswa', [DashboardAdminController::class, 'adminSiswa'])->name('admin.siswa');
    Route::get('/admin-edit-kelas-siswa', [DashboardAdminController::class, 'adminEditKelasSiswa'])->name('admin.edit.kelas.siswa');
    Route::post('/admin-siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::put('/admin-siswa/{id}/update', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::post('/admin-siswa/update-kelas', [SiswaController::class, 'updateKelas'])->name('admin.update.kelas.siswa');
    Route::delete('/admin-siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

    Route::get('/admin-orang-tua', [DashboardAdminController::class, 'adminOrangTua'])->name('admin.orang-tua');
    Route::post('/admin-orang-tua', [OrangTuaController::class, 'store'])->name('admin.orang-tua.store');
    Route::put('/admin-orang-tua/{id}/update', [OrangTuaController::class, 'update'])->name('admin.orang-tua.update');
    Route::delete('/admin-orang-tua/{id}', [OrangTuaController::class, 'destroy'])->name('admin.orang-tua.destroy');

    Route::get('/admin-kelas', [DashboardAdminController::class, 'adminKelas'])->name('admin.kelas');
    Route::post('/admin-kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
    Route::put('/admin-kelas/{id}/update', [KelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/admin-kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

    Route::get('/admin-mata-pelajaran', [DashboardAdminController::class, 'adminMataPelajaran'])->name('admin.mata-pelajaran');
    Route::post('/admin-mata-pelajaran', [MataPelajaranController::class, 'store'])->name('admin.mata-pelajaran.store');
    Route::put('/admin-mata-pelajaran/{id}/update', [MataPelajaranController::class, 'update'])->name('admin.mata-pelajaran.update');
    Route::delete('/admin-mata-pelajaran/{id}', [MataPelajaranController::class, 'destroy'])->name('admin.mata-pelajaran.destroy');

    Route::get('/admin-tahun-ajaran', [DashboardAdminController::class, 'adminTahunAjaran'])->name('admin.tahun-ajaran');
    Route::post('/admin-tahun-ajaran', [TahunAjaranController::class, 'store'])->name('admin.tahun-ajaran.store');
    Route::post('/admin-tahun-ajaran/{id}/aktifkan', [TahunAjaranController::class, 'aktifkan'])->name('admin.tahun-ajaran.aktifkan');
    Route::post('/admin-tahun-ajaran/{id}/nonaktifkan', [TahunAjaranController::class, 'nonaktifkan'])->name('admin.tahun-ajaran.nonaktifkan');
    Route::delete('/admin-tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('admin.tahun-ajaran.destroy');

    Route::get('/admin-ekstrakulikuler', [DashboardAdminController::class, 'adminEkstrakulikuler'])->name('admin.ekskul');
    Route::post('/admin-ekstrakulikuler', [EkstrakulikulerController::class, 'store'])->name('admin.ekskul.store');
    Route::put('/admin-ekstrakulikuler/{id}/update', [EkstrakulikulerController::class, 'update'])->name('admin.ekskul.update');
    Route::delete('/admin-ekstrakulikuler/{id}', [EkstrakulikulerController::class, 'destroy'])->name('admin.ekskul.destroy');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru-dashboard', [DashboardGuruController::class, 'guruIndex'])->name('guru.dashboard');

    Route::get('/guru-nilai/{id}', [DashboardGuruController::class, 'guruNilai'])->name('guru.nilai');
    Route::get('/guru-edit-nilai/{id}/{cpId}', [DashboardGuruController::class, 'gurueditNilai'])->name('guru.edit.nilai');

    Route::get('/guru-kunci-nilai/{id}', [KunciNilaiController::class, 'store'])->name('guru.kunci-nilai.store');
    Route::post('/guru-nilai-kunci/{id}', [KunciNilaiController::class, 'kunci'])->name('guru.kunci-nilai');

    Route::get('/guru-edit-nilai-akhir/{id}', [DashboardGuruController::class, 'gurueditNilaiAkhir'])->name('guru.edit.nilai-akhir');
    Route::get('/guru-nilai-akhir/{id}', [NilaiAkhirController::class, 'store'])->name('guru.nilai-akhir.store');
    Route::post('/guru-nilai-akhir-update', [NilaiAkhirController::class, 'update'])->name('guru.nilai-akhir.update');

    Route::get('/guru-absensi', [DashboardGuruController::class, 'guruAbsensi'])->name('guru.absensi');
    Route::get('/guru-absensi-search', [DashboardGuruController::class, 'guruAbsensiSearch'])->name('guru.absensi.search');
    Route::get('/guru-absensi/{id}', [AbsensiController::class, 'store'])->name('guru.absensi.store');
    Route::put('/guru-absensi{id}/update', [AbsensiController::class, 'update'])->name('guru.absensi.update');

    Route::get('/guru-ekskul', [DashboardGuruController::class, 'guruEkskul'])->name('guru.ekskul');
    Route::get('/guru-ekskul-search', [DashboardGuruController::class, 'guruEkskulSearch'])->name('guru.ekskul.search');
    Route::post('/guru-ekskul', [SiswaEkstrakulikulerController::class, 'store'])->name('guru.ekskul.store');
    Route::put('/guru-ekskul/{id}/update', [SiswaEkstrakulikulerController::class, 'update'])->name('guru.ekskul.update');
    Route::delete('/guru-ekskul/{id}', [SiswaEkstrakulikulerController::class, 'destroy'])->name('guru.ekskul.destroy');
});
Route::middleware(['auth', 'role:guru_mapel'])->group(function () {
    Route::get('/guru-mapel-dashboard', [DashboardGuruMapelController::class, 'guruMapelIndex'])->name('guru-mapel.dashboard');

    Route::get('/guru-mapel-nilai/{id}', [DashboardGuruMapelController::class, 'guruMapelNilai'])->name('guru-mapel.nilai');
    Route::get('/guru-mapel-edit-nilai/{id}/{cpId}', [DashboardGuruMapelController::class, 'guruMapelEditNilai'])->name('guru-mapel.edit.nilai');
});

Route::middleware(['auth', 'role:orang_tua'])->group(function () {
    Route::get('/orang-tua-dashboard', [DashboardOrangTuaController::class, 'OrangTuaIndex'])->name('orang-tua.dashboard');
});
Route::middleware(['auth', 'role:guru,guru_mapel'])->group(function () {
    Route::post('/guru-capaian-pembelajaran', [CapaianPembelajaranController::class, 'store'])->name('guru.cp.store');
    Route::post('/guru-pts-pas', [CapaianPembelajaranController::class, 'tambahPtsPas'])->name('guru.tambah.pts-pas');
    Route::put('/guru-capaian-pembelajaran/{id}/update', [CapaianPembelajaranController::class, 'update'])->name('guru.cp.update');
    Route::put('/guru-pts-pas/{id}/update', [CapaianPembelajaranController::class, 'updatePtsPas'])->name('guru.update.pts-pas');
    Route::delete('/guru-capaian-pembelajaran/{id}', [CapaianPembelajaranController::class, 'destroy'])->name('guru.cp.destroy');

    Route::post('/guru-nilai-update', [NilaiController::class, 'update'])->name('guru.nilai.update');
});
