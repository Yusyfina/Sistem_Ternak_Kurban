<?php

use App\Laporan\LokasiLaporan;
use App\Laporan\PembeliLaporan;
use App\Laporan\PenggunaLaporan;
use App\Laporan\PesananLaporan;
use App\Laporan\RiwayatLaporan;
use App\Laporan\TernakLaporan;
use App\Laporan\VerifikasiLaporan;

return [

    // Format yang didukung (dipakai juga oleh pembatas route).
    'format' => ['xlsx', 'csv', 'pdf', 'docx'],

    'modul' => [

        'ternak' => [
            'label'  => 'Data Ternak',
            'info'   => 'Inventaris ternak, status, dan bobot terakhir.',
            'class'  => TernakLaporan::class,
            'roles'  => ['super_admin', 'admin_pusat', 'admin_lokasi'],
            'filter' => ['lokasi', 'status'],
            'status' => [
                'field' => 'status',
                'opsi'  => [
                    'tersedia'   => 'Tersedia',
                    'dipesan'    => 'Dipesan',
                    'terkirim'   => 'Terkirim',
                    'disembelih' => 'Disembelih',
                ],
            ],
        ],

        'riwayat-penimbangan' => [
            'label'  => 'Riwayat Penimbangan',
            'info'   => 'Seluruh penimbangan beserta operator dan hasil verifikasi.',
            'class'  => RiwayatLaporan::class,
            'roles'  => ['super_admin', 'admin_pusat', 'admin_lokasi', 'operator', 'mandor'],
            'filter' => ['periode', 'lokasi', 'status'],
            'status' => [
                'field' => 'status_verifikasi',
                'opsi'  => [
                    'menunggu'      => 'Menunggu verifikasi',
                    'valid'         => 'Valid',
                    'kurang_akurat' => 'Kurang akurat',
                    'tidak_valid'   => 'Tidak valid',
                ],
            ],
        ],

        'verifikasi' => [
            'label'  => 'Laporan Verifikasi',
            'info'   => 'Status verifikasi, pemeriksa, dan catatan.',
            'class'  => VerifikasiLaporan::class,
            'roles'  => ['super_admin', 'admin_pusat', 'admin_lokasi', 'mandor'],
            'filter' => ['periode', 'lokasi', 'status'],
            'status' => [
                'field' => 'status_verifikasi',
                'opsi'  => [
                    'menunggu'      => 'Menunggu verifikasi',
                    'valid'         => 'Valid',
                    'kurang_akurat' => 'Kurang akurat',
                    'tidak_valid'   => 'Tidak valid',
                ],
            ],
        ],

        'pesanan' => [
            'label'  => 'Pesanan',
            'info'   => 'Rekap pesanan, harga, dan ternak yang dipasangkan.',
            'class'  => PesananLaporan::class,
            'roles'  => ['super_admin', 'admin_pusat'],
            'filter' => ['periode', 'status'],
            'status' => [
                'field' => 'status',
                'opsi'  => [
                    'menunggu_pemasangan' => 'Menunggu pemasangan',
                    'terpasang'           => 'Terpasang',
                    'dibatalkan'          => 'Dibatalkan',
                ],
            ],
        ],

        'pembeli' => [
            'label'  => 'Pembeli',
            'info'   => 'Daftar pembeli dan jumlah pesanannya.',
            'class'  => PembeliLaporan::class,
            'roles'  => ['super_admin', 'admin_pusat'],
            'filter' => [],
        ],

        'lokasi' => [
            'label'  => 'Lokasi Peternakan',
            'info'   => 'Daftar kandang, jumlah ternak, dan jenis ternak.',
            'class'  => LokasiLaporan::class,
            'roles'  => ['super_admin', 'admin_pusat'],
            'filter' => [],
        ],

        'pengguna' => [
            'label'  => 'Pengguna',
            'info'   => 'Daftar akun, peran, dan lokasi (tanpa kata sandi).',
            'class'  => PenggunaLaporan::class,
            'roles'  => ['super_admin'],
            'filter' => [],
        ],
    ],
];