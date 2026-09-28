<?php

namespace App\Http\Controllers;

use App\Models\JenisTernak;
use App\Models\LokasiPeternakan;
use App\Models\Pembeli;
use App\Models\Penimbangan;
use App\Models\Ternak;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama.
     */
    public function index()
    {
        $totalTernak = \App\Models\Ternak::count();

        $tersedia = \App\Models\Ternak::where('status', 'tersedia')->count();

        $dipesan = \App\Models\Ternak::where('status', 'dipesan')->count();

        $totalLokasi = \App\Models\LokasiPeternakan::count();

        $totalPembeli = \App\Models\Pembeli::count();

        $belumDiverifikasi = \App\Models\Penimbangan::where(
            'status_verifikasi',
            'menunggu'
        )->count();

        $ternakPerLokasi = \App\Models\LokasiPeternakan::withCount('ternak')
            ->get();

        $ternakPerJenis = \App\Models\JenisTernak::withCount('ternak')
            ->get();

        $penimbanganTerbaru = \App\Models\Penimbangan::with([
            'ternak.lokasi'
        ])
            ->latest()
            ->take(4)
            ->get();

        return view('dashboard', [
            'totalTernak' => $totalTernak,
            'tersedia' => $tersedia,
            'dipesan' => $dipesan,
            'totalLokasi' => $totalLokasi,
            'totalPembeli' => $totalPembeli,
            'belumDiverifikasi' => $belumDiverifikasi,
            'ternakPerLokasi' => $ternakPerLokasi,
            'ternakPerJenis' => $ternakPerJenis,
            'penimbanganTerbaru' => $penimbanganTerbaru,
        ]);
    }
}