<?php

namespace App\Http\Controllers;

use App\Models\Penimbangan;
use Illuminate\Http\Request;


class OperatorDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Operator hanya boleh melihat data dari lokasi tugasnya.
        $query = Penimbangan::with([
            'ternak.lokasi',
            'ternak.jenisTernak',
            'operator',
        ]);

        if ($user->lokasi_id) {
            $query->whereHas('ternak', function ($q) use ($user) {
                $q->where('lokasi_id', $user->lokasi_id);
            });
        } else {
            // Jika belum memiliki lokasi, jangan tampilkan data lokasi lain.
            $query->whereRaw('1 = 0');
        }

        // Total penimbangan pada lokasi operator.
        $totalPenimbangan = (clone $query)->count();

        // Status menunggu, termasuk data yang statusnya masih NULL.
        $menunggu = (clone $query)
            ->where(function ($q) {
                $q->where('status_verifikasi', 'menunggu')
                  ->orWhereNull('status_verifikasi');
            })
            ->count();

        $valid = (clone $query)
            ->where('status_verifikasi', 'valid')
            ->count();

        $tidakValid = (clone $query)
            ->where('status_verifikasi', 'tidak_valid')
            ->count();

        // Data untuk pie chart.
        $dataPie = [
            'labels' => [
                'Menunggu verifikasi',
                'Valid',
                'Tidak valid',
            ],
            'values' => [
                $menunggu,
                $valid,
                $tidakValid,
            ],
        ];

        // Lima data penimbangan terbaru.
        $riwayatTerbaru = (clone $query)
            ->orderByDesc('ditimbang_at')
            ->orderByDesc('id')
            ->take(5)
            ->get();

        return view('operator.dashboard', compact(
            'user',
            'totalPenimbangan',
            'menunggu',
            'valid',
            'tidakValid',
            'dataPie',
            'riwayatTerbaru'
        ));
    }
}

?>