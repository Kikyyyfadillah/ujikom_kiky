<?php

use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\jenisController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

//login
Route::get("/login", [UserController::class, 'index'])->name('login');
Route::post('/login/cek', [UserController::class, 'cekLogin'])->name('cekLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//Route untuk yang sudah login
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'index']);

    //admin
    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::resource('/jenis', jenisController::class);
        Route::resource('/menu', menuController::class);
        Route::resource('/stok', StokController::class);
    });

    //export import
    Route::get('export/jenis', [jenisController::class, 'exportData'])->name('export-jenis');
    Route::get('export/jenis_pdf', [jenisController::class, 'pdf'])->name('export-jenis_pdf');
    Route::post('jenis/import', [jenisController::class, 'importData'])->name('import-jenis'); //jenis
    Route::get('export/menu', [menuController::class, 'exportData'])->name('export-menu');
    Route::get('export/menu_pdf', [menuController::class, 'pdf'])->name('export-menu_pdf');
    Route::post('menu/import', [menuController::class, 'importData'])->name('import-menu'); //menu
    Route::get('export/stok', [menuController::class, 'exportData'])->name('export-stok'); //stok
    Route::get('export/produk', [ProdukController::class, 'exportData'])->name('export-produk');
    Route::post('produk/import', [ProdukController::class, 'importData'])->name('import-produk');


    //kasir
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        // Route::resource('/menu', menuController::class);
        Route::resource('/pelanggan', PelangganController::class);
        Route::resource('/pemesanan', PemesananController::class);
        Route::resource('/transaksi', TransaksiController::class);
        Route::resource('/produk', ProdukController::class);
        Route::resource('/about', AboutController::class);
        Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
    });
});
