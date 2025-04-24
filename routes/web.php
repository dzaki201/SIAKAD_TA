<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardGuruController;
use App\Http\Controllers\Dashboard\DashboardAdminController;
use App\Http\Controllers\Dashboard\DashboardOrangTuaController;


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

Route::controller(AuthController::class)->group(function(){
    Route::get('/register','register')->name('register');
    Route::post('/register','registerSave')->name('register.save');
    
    Route::get('/login','login')->name('login');
    Route::post('/login','loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// Route::middleware('auth')->group(function(){
//     Route::get('/beranda',[DashboardController::class,'BerandaUser'])->name('beranda.user');
// });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin-dashboard',[DashboardAdminController::class,'adminIndex'])->name('admin.dashboard');
    Route::get('/admin-guru',[DashboardAdminController::class,'adminGuru'])->name('admin.guru');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/beranda-guru',[DashboardGuruController::class,'guruIndex'])->name('beranda.guru');
});

Route::middleware(['auth', 'role:orang_tua'])->group(function () {
    Route::get('/beranda-orangtua',[DashboardOrangTuaController::class,'OrangTuaIndex'])->name('beranda.orangtua');
});