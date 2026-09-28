<?php

namespace App\Http\Controllers;

use App\Models\JenisTernak;
use App\Models\LokasiPeternakan;
use App\Models\Pembeli;
use App\Models\Penimbangan;
use App\Models\Ternak;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        $totalTernak = Ternak::count();

        $tersedia = Ternak::where(
            'status',
            'tersedia'
        )->count();

        $dipesan = Ternak::where(
            'status',
            'dipesan'
        )->count();

        $terkirim = Ternak::where(
            'status',
            'terkirim'
        )->count();

        $disembelih = Ternak::where(
            'status',
            'disembelih'
        )->count();

        $totalLokasi = LokasiPeternakan::count();

        $totalPembeli = Pembeli::count();

        $belumDiverifikasi = Penimbangan::where(
            'status_verifikasi',
            'menunggu'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TERNAK BERDASARKAN LOKASI
        |--------------------------------------------------------------------------
        */

        $ternakPerLokasi = LokasiPeternakan::withCount('ternak')
            ->orderBy('nama')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TERNAK BERDASARKAN JENIS
        |--------------------------------------------------------------------------
        */

        $ternakPerJenis = JenisTernak::withCount('ternak')
            ->orderBy('spesies')
            ->orderBy('nama_jenis')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PENIMBANGAN TERBARU
        |--------------------------------------------------------------------------
        */

        $penimbanganTerbaru = Penimbangan::with([
            'ternak.lokasi',
            'ternak.jenisTernak',
            'operator',
        ])
            ->latest('ditimbang_at')
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | DATA UNTUK LINE CHART PENIMBANGAN
        |--------------------------------------------------------------------------
        */

        $dataPenimbangan = Penimbangan::with('ternak')
            ->whereNotNull('ditimbang_at')
            ->latest('ditimbang_at')
            ->take(10)
            ->get()
            ->sortBy('ditimbang_at')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard', [
            'totalTernak' => $totalTernak,
            'tersedia' => $tersedia,
            'dipesan' => $dipesan,
            'terkirim' => $terkirim,
            'disembelih' => $disembelih,

            'totalLokasi' => $totalLokasi,
            'totalPembeli' => $totalPembeli,
            'belumDiverifikasi' => $belumDiverifikasi,

            'ternakPerLokasi' => $ternakPerLokasi,
            'ternakPerJenis' => $ternakPerJenis,

            'penimbanganTerbaru' => $penimbanganTerbaru,
            'dataPenimbangan' => $dataPenimbangan,
        ]);
    }
}