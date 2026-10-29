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
use App\Http\Controllers\OperatorDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Awal
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Route yang Membutuhkan Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [
        DashboardController::class,
        'index',
    ])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Data Ternak
    |--------------------------------------------------------------------------
    */

    Route::resource('ternak', TernakController::class);

    Route::get('/ternak/{ternak}/delete', [
        TernakController::class,
        'delete',
    ])->name('ternak.delete');

    /*
    |--------------------------------------------------------------------------
    | Penimbangan
    |--------------------------------------------------------------------------
    | Input penimbangan hanya untuk Super Admin, Admin Lokasi, dan Operator.
    */

    Route::middleware('role:super_admin,admin_lokasi,operator')->group(function () {

        Route::resource('penimbangan', PenimbanganController::class)
            ->only(['index', 'create', 'store']);

    });

    /*
    |--------------------------------------------------------------------------
    | Riwayat Penimbangan
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:super_admin,admin_pusat,admin_lokasi,operator,mandor')
        ->get('/riwayat-penimbangan', [
            PenimbanganController::class,
            'riwayat',
        ])->name('penimbangan.riwayat');

    /*
    |--------------------------------------------------------------------------
    | Verifikasi Penimbangan
    |--------------------------------------------------------------------------
    | Super Admin dan Admin Pusat boleh membuka halaman.
    | Hanya Super Admin yang boleh menyimpan hasil verifikasi.
    */

    Route::middleware('role:super_admin,admin_pusat')->group(function () {

        Route::get('/verifikasi', [
            VerifikasiController::class,
            'index',
        ])->name('verifikasi.index');

    });

    Route::middleware('role:super_admin')->group(function () {

        Route::post('/verifikasi/{penimbangan}', [
            VerifikasiController::class,
            'store',
        ])->name('verifikasi.store');

    });

    /*
    |--------------------------------------------------------------------------
    | Pembeli
    |--------------------------------------------------------------------------
    */

    Route::resource('pembeli', PembeliController::class);

    /*
    |--------------------------------------------------------------------------
    | Pesanan
    |--------------------------------------------------------------------------
    */

    Route::resource('pesanan', PesananController::class);

    Route::post('/pesanan/{pesanan}/pasangkan', [
        PesananController::class,
        'pasangkan',
    ])->name('pesanan.pasangkan');

    /*
    |--------------------------------------------------------------------------
    | Lokasi Peternakan
    |--------------------------------------------------------------------------
    | Super Admin dan Admin Pusat boleh melihat data lokasi.
    */

    Route::middleware('role:super_admin,admin_pusat')->group(function () {

        Route::resource('lokasi', LokasiController::class)
            ->only(['index', 'show']);

        /*
         * Pengaturan dapat dibuka oleh kedua role.
         */

        Route::get('/pengaturan', [
            PengaturanController::class,
            'index',
        ])->name('pengaturan.index');

        /*
         * Super Admin dan Admin Pusat boleh menambahkan kategori harga.
         */

        Route::post('/pengaturan/kategori', [
            PengaturanController::class,
            'storeKategori',
        ])->name('pengaturan.kategori.store');

    });

    /*
    |--------------------------------------------------------------------------
    | Khusus Super Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:super_admin')->group(function () {

        /*
         * Pengelolaan lokasi selain melihat daftar dan detail.
         */

        Route::resource('lokasi', LokasiController::class)
            ->except(['index', 'show']);

        /*
         * Pengelolaan pengguna hanya untuk Super Admin.
         */

        Route::resource('pengguna', PenggunaController::class);

        /*
         * Pengelolaan jenis ternak hanya untuk Super Admin.
         */

        Route::post('/pengaturan/jenis', [
            PengaturanController::class,
            'storeJenis',
        ])->name('pengaturan.jenis.store');

    });

    /*
    |--------------------------------------------------------------------------
    | Profil Pengguna
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [
        ProfileController::class,
        'edit',
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update',
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy',
    ])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Dashboard Operator
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:operator')->group(function () {

        Route::get('/operator/dashboard', [
            OperatorDashboardController::class,
            'index',
        ])->name('operator.dashboard');

    });

});

/*
|--------------------------------------------------------------------------
| Route Authentication Breeze
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
