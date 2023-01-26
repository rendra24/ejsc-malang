<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KuisionerController;
use App\Http\Controllers\ProfesiController;
use App\Http\Controllers\TujuanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'dologin']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::get('daftar', [HomeController::class, 'index'])->name('daftar');
Route::get('skm', [HomeController::class, 'skm']);
Route::get('penggunjung', [HomeController::class, 'penggunjung'])->name('penggunjung');
Route::post('penggunjung', [HomeController::class, 'store_penggunjung'])->name('anggota.penggunjung');
Route::post('store_skm', [HomeController::class, 'store_skm'])->name('anggota.store_skm');;
Route::post('store_kuisioner', [HomeController::class, 'store_kuisioner'])->name('anggota.store_kuisioner');;

Route::get('/anggota', [AnggotaController::class, 'index']);
Route::post('/doregis', [HomeController::class, 'store'])->name('anggota.store');

Route::group(['middleware' => 'auth'], function() {
    
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('tujuan', TujuanController::class);
    Route::resource('profesi', ProfesiController::class);
    Route::resource('kuisioner', KuisionerController::class);



    Route::group(['prefix'=>'laporan'], function(){
        Route::get('penggunjung', [LaporanController::class, 'pengunjung'])->name('laporan.penggunjung');
        Route::get('skm', [LaporanController::class, 'skm'])->name('laporan.skm');
        Route::get('indikator-kepuasan', [LaporanController::class, 'indikator_kepuasan'])->name('laporan.indikator-kepuasan');
        Route::get('kritik-saran', [LaporanController::class, 'kritik_saran'])->name('laporan.kritik-saran');
        Route::delete('delete-skm/{id}', [LaporanController::class, 'destroy_skm'])->name('laporan.destroy_skm');
    });

    Route::group(['prefix'=>'export'], function(){
        Route::get('penggunjung', [LaporanController::class, 'cetak_penggunjung'])->name('export.penggunjung');
        Route::get('skm', [LaporanController::class, 'cetak_skm'])->name('export.skm');
    });
});