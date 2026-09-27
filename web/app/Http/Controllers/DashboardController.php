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
        return view('dashboard', [
            // Total seluruh ternak
            'totalTernak' => Ternak::count(),

            // Ternak tersedia
            'tersedia' => Ternak::where('status', 'tersedia')->count(),

            // Ternak sudah dipesan
            'dipesan' => Ternak::where('status', 'dipesan')->count(),

            // Total lokasi peternakan
            'totalLokasi' => LokasiPeternakan::count(),

            // Total pembeli
            'totalPembeli' => Pembeli::count(),

            // Penimbangan yang masih menunggu verifikasi
            'belumDiverifikasi' => Penimbangan::where(
                'status_verifikasi',
                'menunggu'
            )->count(),

            // Jumlah ternak berdasarkan lokasi
            'ternakPerLokasi' => LokasiPeternakan::withCount('ternak')
                ->get()
                ->map(function ($lokasi) {
                    return [
                        'lokasi' => $lokasi->nama,
                        'jumlah' => $lokasi->ternak_count,
                    ];
                }),

            // Jumlah ternak berdasarkan jenis
            'ternakPerJenis' => JenisTernak::withCount('ternak')
                ->get()
                ->map(function ($jenis) {
                    return [
                        'jenis' => $jenis->nama_jenis,
                        'jumlah' => $jenis->ternak_count,
                    ];
                }),

            // 4 data penimbangan terbaru
            'penimbanganTerbaru' => Penimbangan::with('ternak.lokasi')
                ->latest()
                ->take(4)
                ->get(),
        ]);
    }
}