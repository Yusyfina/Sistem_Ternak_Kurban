<?php

namespace App\Http\Controllers;

use App\Models\Penimbangan;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    /**
     * Daftar penimbangan yang menunggu verifikasi.
     */
    public function index()
    {
        $penimbangan = Penimbangan::with([
            'ternak',
            'operator',
        ])
            ->where('status_verifikasi', 'menunggu')
            ->latest('ditimbang_at')
            ->paginate(10);

        return view('verifikasi.index', compact('penimbangan'));
    }

    /**
     * Menyimpan hasil verifikasi.
     */
    public function store(
        Request $request,
        Penimbangan $penimbangan
    ) {
        $validated = $request->validate([
            'status_verifikasi' => [
                'required',
                'in:valid,kurang_akurat,tidak_valid'
            ],
            'catatan_verifikasi' => ['nullable', 'string'],
        ]);

        $penimbangan->update([
            'status_verifikasi' => $validated['status_verifikasi'],
            'catatan_verifikasi' => $validated['catatan_verifikasi'] ?? null,
            'diverifikasi_oleh' => auth()->id(),
            'diverifikasi_at' => now(),
        ]);

        return redirect()
            ->route('verifikasi.index')
            ->with('success', 'Hasil verifikasi berhasil disimpan.');
    }
}