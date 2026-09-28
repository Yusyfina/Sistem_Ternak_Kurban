<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PenimbanganController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TernakController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route utama Sistem Ternak Kurban berada di file ini.
|
*/


// ==========================================================
// HALAMAN AWAL
// ==========================================================

Route::get('/', function () {
    return view('welcome');
});


// ==========================================================
// ROUTE YANG MEMBUTUHKAN LOGIN
// ==========================================================

Route::middleware(['auth'])->group(function () {

    // ======================================================
    // DASHBOARD
    // ======================================================

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');


    // ======================================================
    // DATA TERNAK
    // ======================================================

    Route::resource('ternak', TernakController::class);
    Route::get('/ternak/{ternak}/delete', [
        TernakController::class,
        'delete'
    ])->name('ternak.delete');

    // ======================================================
    // PENIMBANGAN
    // ======================================================

    Route::resource('penimbangan', PenimbanganController::class)
        ->only([
            'index',
            'create',
            'store'
        ]);

    Route::get('/riwayat-penimbangan', [
        PenimbanganController::class,
        'riwayat'
    ])->name('penimbangan.riwayat');


    // ======================================================
    // VERIFIKASI PENIMBANGAN
    // ======================================================

    Route::get('/verifikasi', [
        VerifikasiController::class,
        'index'
    ])->name('verifikasi.index');

    Route::post('/verifikasi/{penimbangan}', [
        VerifikasiController::class,
        'store'
    ])->name('verifikasi.store');


    // ======================================================
    // PEMBELI
    // ======================================================

    Route::resource('pembeli', PembeliController::class);


    // ======================================================
    // PESANAN
    // ======================================================

    Route::resource('pesanan', PesananController::class);

    Route::post('/pesanan/{pesanan}/pasangkan', [
        PesananController::class,
        'pasangkan'
    ])->name('pesanan.pasangkan');


    // ======================================================
    // PROFILE USER
    // ======================================================

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');


    // ======================================================
    // KHUSUS SUPER ADMIN & ADMIN PUSAT
    // ======================================================

    Route::middleware('role:super_admin,admin_pusat')->group(function () {

        // --------------------------------------------------
        // DATA LOKASI PETERNAKAN
        // --------------------------------------------------

        Route::resource('lokasi', LokasiController::class);


        // --------------------------------------------------
        // DATA PENGGUNA
        // --------------------------------------------------

        Route::resource('pengguna', PenggunaController::class);


        // --------------------------------------------------
        // PENGATURAN
        // --------------------------------------------------

        Route::get('/pengaturan', [
            PengaturanController::class,
            'index'
        ])->name('pengaturan.index');
    });
});


// ==========================================================
// ROUTE AUTH BAWAAN BREEZE
// ==========================================================

require __DIR__.'/auth.php';
