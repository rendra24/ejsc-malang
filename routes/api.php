<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('aktifitas', App\Http\Controllers\Api\AktifitasApiController::class);
Route::post('anggota', [App\Http\Controllers\Api\AnggotaApiController::class,'index']);
Route::post('router', [App\Http\Controllers\Api\AnggotaApiController::class,'add_to_router']);