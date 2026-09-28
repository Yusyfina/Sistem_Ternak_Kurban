<?php

namespace App\Http\Controllers;

use App\Models\Penimbangan;
use App\Models\Ternak;
use Illuminate\Http\Request;

class PenimbanganController extends Controller
{
    /**
     * Menampilkan daftar penimbangan terbaru.
     */
    public function index()
    {
        $penimbangan = Penimbangan::with([
            'ternak.jenisTernak',
            'ternak.lokasi',
            'operator',
        ])
            ->latest('ditimbang_at')
            ->paginate(10);

        return view('penimbangan.index', compact('penimbangan'));
    }

    /**
     * Menampilkan form untuk membuat penimbangan baru.
     */
    public function create()
    {
        $ternak = Ternak::with([
            'jenisTernak',
            'lokasi',
        ])
            ->where('status', 'tersedia')
            ->orderBy('kode_ternak')
            ->get();

        return view('penimbangan.create', compact('ternak'));
    }

    /**
     * Menyimpan hasil penimbangan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ternak_id' => [
                'required',
                'exists:ternak,id',
            ],

            'bobot' => [
                'required',
                'numeric',
                'min:0',
            ],

            'metode' => [
                'required',
                'in:manual,estimasi,otomatis_iot',
            ],

            'sumber' => [
                'required',
                'in:manual_entry,otomatis_iot,data_manajemen,tidak_ada_data',
            ],

            'ditimbang_at' => [
                'nullable',
                'date',
            ],
        ]);

        /*
         * Operator yang melakukan penimbangan
         * diambil dari user yang sedang login.
         */
        $validated['operator_id'] = auth()->id();

        /*
         * Setiap penimbangan baru otomatis
         * masuk status menunggu verifikasi.
         */
        $validated['status_verifikasi'] = 'menunggu';

        /*
         * Jika tanggal/waktu tidak diisi,
         * gunakan waktu sekarang.
         */
        if (empty($validated['ditimbang_at'])) {
            $validated['ditimbang_at'] = now();
        }

        /*
         * Simpan data penimbangan.
         */
        $penimbangan = Penimbangan::create($validated);

        /*
         * Update bobot terakhir pada data ternak.
         */
        Ternak::where('id', $penimbangan->ternak_id)
            ->update([
                'bobot_terakhir' => $penimbangan->bobot,
            ]);

        return redirect()
            ->route('penimbangan.index')
            ->with(
                'success',
                'Data penimbangan berhasil disimpan.'
            );
    }

    /**
     * Menampilkan seluruh riwayat penimbangan.
     */
    public function riwayat()
    {
        $penimbangan = Penimbangan::with([
            'ternak.jenisTernak',
            'ternak.lokasi',
            'operator',
            'verifikator',
        ])
            ->latest('ditimbang_at')
            ->paginate(15);

        return view(
            'penimbangan.riwayat',
            compact('penimbangan')
        );
    }
}