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
use App\Http\Controllers\LaporanController;

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
    | Super Admin, Admin Lokasi, dan Operator dapat melakukan input.
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

    Route::middleware(
        'role:super_admin,admin_pusat,admin_lokasi,operator,mandor'
    )->group(function () {

        Route::get('/riwayat-penimbangan', [
            PenimbanganController::class,
            'riwayat',
        ])->name('penimbangan.riwayat');

    });


    /*
    |--------------------------------------------------------------------------
    | Verifikasi Penimbangan
    |--------------------------------------------------------------------------
    | Super Admin dan Admin Pusat dapat melihat halaman verifikasi.
    | Hanya Super Admin yang dapat menyimpan hasil verifikasi.
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
    | Lokasi Peternakan - Super Admin
    |--------------------------------------------------------------------------
    | Route create dan edit didaftarkan sebelum route parameter {lokasi}.
    */

    Route::middleware('role:super_admin')->group(function () {

        Route::get('/lokasi/create', [
            LokasiController::class,
            'create',
        ])->name('lokasi.create');

        Route::post('/lokasi', [
            LokasiController::class,
            'store',
        ])->name('lokasi.store');

        Route::get('/lokasi/{lokasi}/edit', [
            LokasiController::class,
            'edit',
        ])->name('lokasi.edit');

        Route::put('/lokasi/{lokasi}', [
            LokasiController::class,
            'update',
        ])->name('lokasi.update');

        Route::patch('/lokasi/{lokasi}', [
            LokasiController::class,
            'update',
        ]);

        Route::delete('/lokasi/{lokasi}', [
            LokasiController::class,
            'destroy',
        ])->name('lokasi.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | Lokasi Peternakan - Super Admin dan Admin Pusat
    |--------------------------------------------------------------------------
    | Kedua role hanya dapat melihat daftar dan detail lokasi.
    */

    Route::middleware('role:super_admin,admin_pusat')->group(function () {

        Route::get('/lokasi', [
            LokasiController::class,
            'index',
        ])->name('lokasi.index');

        Route::get('/lokasi/{lokasi}', [
            LokasiController::class,
            'show',
        ])->name('lokasi.show');

    });


    /*
    |--------------------------------------------------------------------------
    | Pengaturan - Super Admin dan Admin Pusat
    |--------------------------------------------------------------------------
    | Keduanya dapat mengelola kategori harga.
    */

    Route::middleware('role:super_admin,admin_pusat')->group(function () {

        Route::get('/pengaturan', [
            PengaturanController::class,
            'index',
        ])->name('pengaturan.index');

        Route::post('/pengaturan/kategori', [
            PengaturanController::class,
            'storeKategori',
        ])->name('pengaturan.kategori.store');

    });


    /*
    |--------------------------------------------------------------------------
    | Pengaturan Jenis Ternak - Super Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:super_admin')->group(function () {

        Route::post('/pengaturan/jenis', [
            PengaturanController::class,
            'storeJenis',
        ])->name('pengaturan.jenis.store');

    });


    /*
    |--------------------------------------------------------------------------
    | Pengguna - Super Admin
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:super_admin')->group(function () {

        Route::resource('pengguna', PenggunaController::class);

    });

    Route::get('/laporan', [LaporanController::class, 'index'])
    ->name('laporan.index');

    Route::get('/laporan/{modul}/{format}', [LaporanController::class, 'export'])
        ->where('format', 'xlsx|csv|pdf|docx')
        ->name('laporan.export');
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

require __DIR__ . '/auth.php';