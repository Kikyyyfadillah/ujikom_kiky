<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\grafikController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubungiController;
use App\Http\Controllers\jenisController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\menuController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MejaController;
use App\Models\DetailTransaksi;
use App\Models\kategori;
use Database\Factories\AbsensiFactory;

//login
Route::get("/login", [UserController::class, 'index'])->name('login');
Route::post('/login/cek', [UserController::class, 'cekLogin'])->name('cekLogin');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//Route untuk yang sudah login
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'index']);

    //admin
    Route::group(['middleware' => ['cekUserLogin:1']], function () {
        Route::resource('/kategori', KategoriController::class);
        Route::resource('/jenis', jenisController::class);
        Route::resource('/menu', menuController::class);
        Route::resource('/stok', StokController::class);
        Route::resource('/absensi', AbsensiController::class);
        Route::resource('/hubungi', HubungiController::class);
        Route::resource('/grafik', grafikController::class);
    });

    //export import
    // kategori
    Route::get('export/kategori', [kategoriController::class, 'exportData'])->name('export-kategori');
    Route::get('export/kategori.pdf', [kategoriController::class, 'pdf'])->name('export-kategori.pdf');
    Route::post('kategori/import', [kategoriController::class, 'importData'])->name('import-kategori');
    //jenis
    Route::get('export/jenis', [jenisController::class, 'exportData'])->name('export-jenis');
    Route::get('export/jenis_pdf', [jenisController::class, 'pdf'])->name('export-jenis_pdf');
    Route::post('jenis/import', [jenisController::class, 'importData'])->name('import-jenis');
    //menu
    Route::get('export/menu', [menuController::class, 'exportData'])->name('export-menu');
    Route::get('export/menu.pdf', [menuController::class, 'generatepdf'])->name('export-menu.pdf');
    Route::post('menu/import', [menuController::class, 'importData'])->name('import-menu');
    //stok
    Route::get('export/stok', [StokController::class, 'exportData'])->name('export-stok');
    Route::get('export/stok_pdf', [StokController::class, 'pdf'])->name('export-stok_pdf');
    Route::post('import/stok', [StokController::class, 'importData'])->name('import-stok');
    //pelanggan
    Route::get('export/pelanggan', [pelangganController::class, 'exportData'])->name('export-pelanggan');
    Route::get('export/pelanggan.pdf', [pelangganController::class, 'pdf'])->name('export-pelanggan.pdf');
    Route::post('pelanggan/import', [pelangganController::class, 'importData'])->name('import-pelanggan');
    //meja
    Route::get('export/meja', [MejaController::class, 'exportData'])->name('export-meja');
    Route::get('export/meja.pdf', [mejaController::class, 'pdf'])->name('export-meja.pdf');
    Route::post('meja/import', [MejaController::class, 'importData'])->name('import-meja');
    //produk
    Route::get('export/produk', [ProdukController::class, 'exportData'])->name('export-produk');
    Route::post('produk/import', [ProdukController::class, 'importData'])->name('import-produk');
    //absensi
    Route::get('export/absensi', [AbsensiController::class, 'exportData'])->name('export-absensi');
    Route::get('export/absensi.pdf', [AbsensiController::class, 'pdf'])->name('export-absensi.pdf');
    Route::post('absensi/import', [AbsensiController::class, 'importData'])->name('import-absensi');



    //kasir
    Route::group(['middleware' => ['cekUserLogin:2']], function () {
        // Route::resource('/menu', menuController::class);
        Route::resource('/pelanggan', PelangganController::class);
        Route::resource('/pemesanan', PemesananController::class);
        Route::resource('/meja', MejaController::class);
        Route::resource('/transaksi', TransaksiController::class);
        Route::resource('/produk', ProdukController::class);
        Route::resource('/about', AboutController::class);
        Route::get('nota/{nofaktur}', [TransaksiController::class, 'faktur']);
    });

    //owner
    Route::group(['middleware' => ['cekUserLogin:3']], function () {
        Route::resource('/laporan', DetailTransaksiController::class);
        Route::get('export/laporan', [DetailTransaksiController::class, 'exportData'])->name('export-laporan');
        Route::get('export/laporan-pdf', [DetailTransaksiController::class, 'pdf'])->name('export-laporan.pdf');

    });
});
