<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\SuratJalanController;
use App\Http\Controllers\DetailSuratJalanController;
use App\Http\Controllers\InvoiceController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);

// 🔑 LOGOUT: Diubah ke POST agar sinkron dengan form di layout app.blade.php
// Ganti bagian ini menjadi GET
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('pegawai', PegawaiController::class);
Route::resource('pelanggan', PelangganController::class);
Route::resource('produk', ProdukController::class);
Route::resource('kendaraan', KendaraanController::class);

/*
|--------------------------------------------------------------------------
| SURAT JALAN
|--------------------------------------------------------------------------
*/
Route::resource('surat_jalan', SuratJalanController::class);

/*
|--------------------------------------------------------------------------
| DETAIL SURAT JALAN
|--------------------------------------------------------------------------
*/
// Gunakan huruf kecil 'Route::prefix' 
Route::prefix('detailsuratjalan')->group(function () {

    Route::get('/{id}', [DetailSuratJalanController::class, 'index'])
        ->name('detailsuratjalan.index');

    Route::post('/{id}', [DetailSuratJalanController::class, 'store'])
        ->name('detailsuratjalan.store');

    Route::put('/{id}/{produk}', [DetailSuratJalanController::class, 'update'])
        ->name('detailsuratjalan.update');

    Route::delete('/{id}/{produk}', [DetailSuratJalanController::class, 'destroy'])
        ->name('detailsuratjalan.destroy');

    Route::get('/{id}/cetak', [DetailSuratJalanController::class, 'cetak'])
        ->name('detailsuratjalan.cetak');
});

/*
|--------------------------------------------------------------------------
| INVOICE & AJAX (SUDAH DI-FIX)
|--------------------------------------------------------------------------
*/
// 1. Route AJAX Custom
Route::get('/invoice/get-surat-jalan', [InvoiceController::class, 'getSuratJalan'])->name('invoice.get_surat_jalan');

// 2. Route Cetak (Wajib di atas resource agar URL 'invoice/cetak' tidak dikira ID)
Route::get('/invoice/{id}/cetak', [InvoiceController::class, 'cetak'])->name('invoice.cetak');

// 3. Route Resource Utama Invoice (Cukup Tulis 1 Kali Saja)
Route::resource('invoice', InvoiceController::class);

/*
|--------------------------------------------------------------------------
| LAPORAN
|--------------------------------------------------------------------------
*/
Route::get('/laporan', function () {
    return view('laporan.index');
})->name('laporan.index');