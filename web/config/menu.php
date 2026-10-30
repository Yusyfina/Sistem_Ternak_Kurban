
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu Super Admin
    |--------------------------------------------------------------------------
    */

    'super_admin' => [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'label' => 'Data Ternak',
            'route' => 'ternak.index',
        ],
        [
            'label' => 'Penimbangan',
            'route' => 'penimbangan.create',
        ],
        [
            'label' => 'Riwayat Penimbangan',
            'route' => 'penimbangan.riwayat',
        ],
        [
            'label' => 'Verifikasi',
            'route' => 'verifikasi.index',
        ],
        [
            'label' => 'Pembeli',
            'route' => 'pembeli.index',
        ],
        [
            'label' => 'Pesanan',
            'route' => 'pesanan.index',
        ],
        [
            'label' => 'Lokasi Peternakan',
            'route' => 'lokasi.index',
        ],
        [
            'label' => 'Pengguna',
            'route' => 'pengguna.index',
        ],
        [
            'label' => 'Pengaturan',
            'route' => 'pengaturan.index',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Admin Pusat
    |--------------------------------------------------------------------------
    */

    'admin_pusat' => [
        [
            'label' => 'Dashboard',
            'route' => 'dashboard',
        ],
        [
            'label' => 'Data Ternak',
            'route' => 'ternak.index',
        ],
        [
            'label' => 'Riwayat Penimbangan',
            'route' => 'penimbangan.riwayat',
        ],
        [
            'label' => 'Verifikasi',
            'route' => 'verifikasi.index',
        ],
        [
            'label' => 'Pembeli',
            'route' => 'pembeli.index',
        ],
        [
            'label' => 'Pesanan',
            'route' => 'pesanan.index',
        ],
        [
            'label' => 'Lokasi Peternakan',
            'route' => 'lokasi.index',
        ],
        [
            'label' => 'Pengaturan',
            'route' => 'pengaturan.index',
        ],
    ],

];
