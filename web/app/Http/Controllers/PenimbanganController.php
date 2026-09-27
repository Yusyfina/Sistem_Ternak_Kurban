<?php

namespace App\Http\Controllers;

use App\Models\Penimbangan;
use App\Models\Ternak;
use Illuminate\Http\Request;

class PenimbanganController extends Controller
{
    /**
     * Daftar penimbangan terbaru.
     */
    public function index()
    {
        $penimbangan = Penimbangan::with([
            'ternak',
            'operator',
        ])
            ->latest('ditimbang_at')
            ->paginate(10);

        return view('penimbangan.index', compact('penimbangan'));
    }

    /**
     * Form penimbangan.
     */
    public function create()
    {
        $ternak = Ternak::where('status', 'tersedia')
            ->orderBy('kode_ternak')
            ->get();

        return view('penimbangan.create', compact('ternak'));
    }

    /**
     * Simpan hasil penimbangan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ternak_id' => ['required', 'exists:ternak,id'],
            'bobot' => ['required', 'numeric', 'min:0'],
            'metode' => [
                'required',
                'in:manual,estimasi,otomatis_iot'
            ],
            'sumber' => [
                'required',
                'in:manual_entry,otomatis_iot,data_manajemen,tidak_ada_data'
            ],
            'ditimbang_at' => ['nullable', 'date'],
        ]);

        $validated['operator_id'] = auth()->id();
        $validated['status_verifikasi'] = 'menunggu';

        Penimbangan::create($validated);

        // Update bobot terakhir pada ternak
        Ternak::where('id', $validated['ternak_id'])
            ->update([
                'bobot_terakhir' => $validated['bobot'],
            ]);

        return redirect()
            ->route('penimbangan.index')
            ->with('success', 'Data penimbangan berhasil disimpan.');
    }

    /**
     * Riwayat seluruh penimbangan.
     */
    public function riwayat()
    {
        $penimbangan = Penimbangan::with([
            'ternak.lokasi',
            'operator',
            'verifikator',
        ])
            ->latest('ditimbang_at')
            ->paginate(15);

        return view('penimbangan.riwayat', compact('penimbangan'));
    }
}