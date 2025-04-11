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
    Route::get('/create_ajax',[UserController::class, 'create_ajax']);
    Route::post('/ajax',[UserController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[UserController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[UserController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[UserController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[UserController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[UserController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/',[LevelController::class, 'index']);
    Route::post('/list',[LevelController::class, 'list']);
    Route::get('/create_ajax',[LevelController::class, 'create_ajax']);
    Route::post('/ajax',[LevelController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[LevelController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[LevelController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[LevelController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[LevelController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[LevelController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/',[KategoriController::class, 'index']);
    Route::post('/list',[KategoriController::class, 'list']);
    Route::get('/create_ajax',[KategoriController::class, 'create_ajax']);
    Route::post('/ajax',[KategoriController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[KategoriController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[KategoriController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[KategoriController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[KategoriController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[KategoriController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/',[SupplierController::class, 'index']);
    Route::post('/list',[SupplierController::class, 'list']);
    Route::get('/create_ajax',[SupplierController::class, 'create_ajax']);
    Route::post('/ajax',[SupplierController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[SupplierController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[SupplierController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[SupplierController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[SupplierController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[SupplierController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/',[BarangController::class, 'index']);
    Route::post('/list',[BarangController::class, 'list']);
    Route::get('/create_ajax',[BarangController::class, 'create_ajax']);
    Route::post('/ajax',[BarangController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[BarangController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[BarangController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[BarangController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[BarangController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[BarangController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/',[StokController::class, 'index']);
    Route::post('/list',[StokController::class, 'list']);
    Route::get('/create_ajax',[StokController::class, 'create_ajax']);
    Route::post('/ajax',[StokController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[StokController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[StokController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[StokController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[StokController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[StokController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/',[PenjualanController::class, 'index']);
    Route::post('/list',[PenjualanController::class, 'list']);
    Route::get('/create_ajax',[PenjualanController::class, 'create_ajax']);
    Route::post('/ajax',[PenjualanController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[PenjualanController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[PenjualanController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[PenjualanController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[PenjualanController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[PenjualanController::class, 'delete_ajax']);
});

Route::group(['prefix' => 'detailPenjualan'], function () {
    Route::get('/',[PenjualanDetailController::class, 'index']);
    Route::post('/list',[PenjualanDetailController::class, 'list']);
    Route::get('/create_ajax',[PenjualanDetailController::class, 'create_ajax']);
    Route::post('/ajax',[PenjualanDetailController::class, 'store_ajax']);
    Route::get('/{id}/show_ajax',[PenjualanDetailController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax',[PenjualanDetailController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax',[PenjualanDetailController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax',[PenjualanDetailController::class, 'confirm_ajax']);
    Route::delete('/{id}/delete_ajax',[PenjualanDetailController::class, 'delete_ajax']);
});