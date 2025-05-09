<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleContoller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
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
    return view('auth.login');
});

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('/penjualan', DataPenjualanController::class);

    Route::get('/penjualan', [DataPenjualanController::class, 'index'])->name('penjualan.index');


    Route::get('/barang', [App\Http\Controllers\DataBarangController::class, 'index'])->name('data.barang');

    Route::resource('barang', DataBarangController::class);

    Route::get('/grafik-penjualan', [App\Http\Controllers\DataPenjualanController::class, 'grafikPenjualan'])->name('grafik.penjualan');
    // Route::get('/grafik-produk', [App\Http\Controllers\DataBarangController::class, 'grafikProduk'])->name('grafik.produk');
    Route::get('/grafik-all', [App\Http\Controllers\DataPenjualanController::class, 'grafikPenjualanKeseluruhan'])->name('grafik.all');

    // Route::get('/grafikproduk', [App\Http\Controllers\DataBarangController::class, 'grafikProduk'])->name('grafik.produk');

    Route::resource('profile', ProfileController::class);

    Route::get('/report/penjualan', [ReportController::class, 'generatePDF']);

    Route::resource('roles', RoleContoller::class);
    Route::get('roles/{roleId}/give-permissions', [RoleContoller::class, 'addPermissionsToRole'])->name('roles.give-permission');
    Route::put('roles/{roleId}/give-permissions', [RoleContoller::class, 'givePermissionsToRole'])->name('roles.update-permission');

    Route::resource('permissions', PermissionController::class);
    Route::resource('user', UserController::class);
});

Auth::routes();


// Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');


// Route::get('/grafik', [App\Http\Controllers\ProductsController::class, 'index'])->name('grafik.penjualan.produk');