<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\GuruController;
use App\Http\Controllers\Kelas\KelasController;
use App\Http\Controllers\Dashboard\DashboardGuruController;
use App\Http\Controllers\Dashboard\DashboardAdminController;
use App\Http\Controllers\Dashboard\DashboardOrangTuaController;
use App\Http\Controllers\MataPelajaran\MataPelajaranController;
use App\Http\Controllers\Siswa\SiswaController;
use App\Http\Controllers\TahunAjaran\TahunAjaranController;
use App\Http\Controllers\User\UserController;
use App\Models\TahunAjaran;

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
    Route::put('/admin-dashboard/{id}/edit', [UserController::class, 'update'])->name('admin.dashboard.update');

    Route::get('/admin-guru', [DashboardAdminController::class, 'adminGuru'])->name('admin.guru');
    Route::post('/admin-guru', [GuruController::class, 'store'])->name('admin.guru.store');
    Route::put('/admin-guru/{id}/edit', [GuruController::class, 'update'])->name('admin.guru.update');
    Route::delete('/admin-guru/{id}', [GuruController::class, 'destroy'])->name('admin.guru.destroy');

    Route::get('/admin-siswa', [DashboardAdminController::class, 'adminSiswa'])->name('admin.siswa');
    Route::get('/admin-edit-kelas-siswa', [DashboardAdminController::class, 'adminEditKelasSiswa'])->name('admin.edit.kelas.siswa');
    Route::post('/admin-siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::put('/admin-siswa/{id}/edit', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::post('/admin-siswa/update-kelas', [SiswaController::class, 'updateKelas'])->name('admin.update.kelas.siswa');
    Route::delete('/admin-siswa/{id}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');

    Route::get('/admin-kelas', [DashboardAdminController::class, 'adminKelas'])->name('admin.kelas');
    Route::post('/admin-kelas', [KelasController::class, 'store'])->name('admin.kelas.store');
    Route::put('/admin-kelas/{id}/edit', [KelasController::class, 'update'])->name('admin.kelas.update');
    Route::delete('/admin-kelas/{id}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

    Route::get('/admin-mata-pelajaran', [DashboardAdminController::class, 'adminMataPelajaran'])->name('admin.mata-pelajaran');
    Route::post('/admin-mata-pelajaran', [MataPelajaranController::class, 'store'])->name('admin.mata-pelajaran.store');
    Route::put('/admin-mata-pelajaran/{id}/edit', [MataPelajaranController::class, 'update'])->name('admin.mata-pelajaran.update');
    Route::delete('/admin-mata-pelajaran/{id}', [MataPelajaranController::class, 'destroy'])->name('admin.mata-pelajaran.destroy');

    Route::get('/admin-tahun-ajaran', [DashboardAdminController::class, 'adminTahunAjaran'])->name('admin.tahun-ajaran');
    Route::post('/admin-tahun-ajaran', [TahunAjaranController::class, 'store'])->name('admin.tahun-ajaran.store');
    Route::post('/admin-tahun-ajaran/{id}/aktifkan', [TahunAjaranController::class, 'aktifkan'])->name('admin.tahun-ajaran.aktifkan');
    Route::post('/admin-tahun-ajaran/{id}/nonaktifkan', [TahunAjaranController::class, 'nonaktifkan'])->name('admin.tahun-ajaran.nonaktifkan');
    Route::delete('/admin-tahun-ajaran/{id}', [TahunAjaranController::class, 'destroy'])->name('admin.tahun-ajaran.destroy');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/beranda-guru', [DashboardGuruController::class, 'guruIndex'])->name('beranda.guru');
});

Route::middleware(['auth', 'role:orang_tua'])->group(function () {
    Route::get('/beranda-orangtua', [DashboardOrangTuaController::class, 'OrangTuaIndex'])->name('beranda.orangtua');
});
