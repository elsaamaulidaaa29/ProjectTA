<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleContoller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DataPenjualanController;

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

Route::resource('products', ProductsController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// table page
Route::get('/table', function () {
    return view('table'); // Mengarahkan ke file resources/views/tables.blade.php
});

Route::get('/table', [App\Http\Controllers\TableController::class, 'index'])->name('tables.index');

// Route::get('/harian', [App\Http\Controllers\DataPenjualanController::class, 'harian'])->name('data.harian');

Route::resource('/penjualan', DataPenjualanController::class);

Route::get('/barang', [App\Http\Controllers\DataBarangController::class, 'index'])->name('data.barang');

Route::resource('barang', DataBarangController::class);

Route::get('/grafikpenjualan', [App\Http\Controllers\DataPenjualanController::class, 'grafikPenjualan'])->name('grafik.penjualan');

// Route::get('/grafikproduk', [App\Http\Controllers\DataBarangController::class, 'grafikProduk'])->name('grafik.produk');

Route::resource('user', UserController::class);

Route::resource('roles', RoleContoller::class);
Route::resource('permissions', PermissionController::class);


// Route::get('/grafik', [App\Http\Controllers\ProductsController::class, 'index'])->name('grafik.penjualan.produk');
