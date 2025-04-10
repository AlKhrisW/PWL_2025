<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\WelcomeController;


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

Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function () {
    Route::get('/',[UserController::class, 'index']);
    Route::post('/list',[UserController::class, 'list']);
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/',[LevelController::class, 'index']);
    Route::post('/list',[LevelController::class, 'list']);
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/',[KategoriController::class, 'index']);
    Route::post('/list',[KategoriController::class, 'list']);
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/',[SupplierController::class, 'index']);
    Route::post('/list',[SupplierController::class, 'list']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/',[BarangController::class, 'index']);
    Route::post('/list',[BarangController::class, 'list']);
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/',[StokController::class, 'index']);
    Route::post('/list',[StokController::class, 'list']);
});

Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/',[PenjualanController::class, 'index']);
    Route::post('/list',[PenjualanController::class, 'list']);
});

Route::group(['prefix' => 'detailPenjualan'], function () {
    Route::get('/',[PenjualanDetailController::class, 'index']);
    Route::post('/list',[PenjualanDetailController::class, 'list']);
});