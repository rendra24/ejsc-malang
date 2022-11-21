<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('skm', [HomeController::class, 'skm']);
Route::post('store_skm', [HomeController::class, 'store_skm'])->name('anggota.store_skm');;

Route::get('/anggota', [AnggotaController::class, 'index']);
Route::post('/doregis', [HomeController::class, 'store'])->name('anggota.store');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::group(['prefix'=>'laporan'], function(){
        Route::get('penggunjung', [LaporanController::class, 'pengunjung'])->name('laporan.penggunjung');
        Route::get('skm', [LaporanController::class, 'skm'])->name('laporan.skm');
        Route::get('indikator-kepuasan', [LaporanController::class, 'indikator_kepuasan'])->name('laporan.indikator-kepuasan');
        Route::get('kritik-saran', [LaporanController::class, 'kritik_saran'])->name('laporan.kritik-saran');
    });

});