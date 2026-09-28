<?php

namespace App\Http\Controllers;

use App\Models\JenisTernak;
use App\Models\LokasiPeternakan;
use App\Models\Ternak;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TernakController extends Controller
{
    /**
     * Menampilkan daftar ternak.
     */
    public function index()
    {
        $ternak = Ternak::with([
            'jenisTernak',
            'lokasi',
        ])
            ->latest()
            ->paginate(10);

        $lokasi = LokasiPeternakan::orderBy('nama')->get();

        return view('ternak.index', compact(
            'ternak',
            'lokasi'
        ));
    }

    /**
     * Menampilkan form tambah ternak.
     */
    public function create()
    {
        $jenisTernak = JenisTernak::orderBy('nama_jenis')->get();

        $lokasi = LokasiPeternakan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('ternak.create', compact(
            'jenisTernak',
            'lokasi'
        ));
    }

    /**
     * Menyimpan ternak baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_ternak' => [
                'required',
                'string',
                'max:10',
            ],

            'jenis_ternak_id' => [
                'required',
                'exists:jenis_ternak,id',
            ],

            'lokasi_id' => [
                'required',
                'exists:lokasi_peternakan,id',
            ],

            'kode_rfid' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:tersedia,dipesan,terkirim,disembelih',
            ],

            'bobot_terakhir' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        Ternak::create($validated);

        return redirect()
            ->route('ternak.index')
            ->with('success', 'Data ternak berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail ternak.
     */
    public function show(Ternak $ternak)
    {
        $ternak->load([
            'jenisTernak',
            'lokasi',
            'penimbangan',
        ]);

        return view('ternak.show', compact('ternak'));
    }

    /**
     * Menampilkan form edit ternak.
     */
    public function edit(Ternak $ternak)
    {
        $jenisTernak = JenisTernak::orderBy('nama_jenis')->get();

        $lokasi = LokasiPeternakan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('ternak.edit', compact(
            'ternak',
            'jenisTernak',
            'lokasi'
        ));
    }

    /**
     * Mengupdate data ternak.
     */
    public function update(Request $request, Ternak $ternak)
    {
        $validated = $request->validate([
            'kode_ternak' => [
                'required',
                'string',
                'max:10',
            ],

            'jenis_ternak_id' => [
                'required',
                'exists:jenis_ternak,id',
            ],

            'lokasi_id' => [
                'required',
                'exists:lokasi_peternakan,id',
            ],

            'kode_rfid' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:tersedia,dipesan,terkirim,disembelih',
            ],

            'bobot_terakhir' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $ternak->update($validated);

        return redirect()
            ->route('ternak.index')
            ->with('success', 'Data ternak berhasil diperbarui.');
    }

    /**
     * Menampilkan halaman konfirmasi hapus.
     */
    public function delete(Ternak $ternak)
    {
        $ternak->load([
            'jenisTernak',
            'lokasi',
        ]);

        return view('ternak.delete', compact('ternak'));
    }

    /**
     * Menghapus data ternak.
     */
    public function destroy(Ternak $ternak)
    {
        /*
         * Cek apakah ternak sudah memiliki
         * riwayat penimbangan.
         *
         * Kalau sudah ada, jangan langsung dihapus
         * supaya riwayat penimbangan tetap aman.
         */
        if ($ternak->penimbangan()->exists()) {
            return redirect()
                ->route('ternak.index')
                ->with(
                    'error',
                    'Data ternak tidak dapat dihapus karena sudah memiliki riwayat penimbangan.'
                );
        }

        $ternak->delete();

        return redirect()
            ->route('ternak.index')
            ->with('success', 'Data ternak berhasil dihapus.');
    }
}