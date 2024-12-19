<?php

use App\Http\Controllers\AlamatController;
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
Route::group(['prefix'=> 'alamat'], function () {
    Route::get('/provinces', [AlamatController::class, 'provinces'])->name('alamat.provinces');
    Route::get('/regencies/{id}', [AlamatController::class, 'regencies'])->name('alamat.regencies');
    Route::get('/districts/{id}', [AlamatController::class, 'districts'])->name('alamat.districts');
    Route::get('/villages/{id}', [AlamatController::class, 'villages'])->name('alamat.villages');
});