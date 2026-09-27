<?php

namespace App\Http\Controllers;

use App\Models\JenisTernak;
use App\Models\LokasiPeternakan;
use App\Models\Ternak;
use Illuminate\Http\Request;

class TernakController extends Controller
{
    /**
     * Menampilkan daftar ternak.
     */
    public function index()
    {
        $ternak = Ternak::with(['jenisTernak', 'lokasi'])
            ->latest()
            ->paginate(10);

        return view('ternak.index', compact('ternak'));
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
            'kode_ternak' => ['required', 'string', 'max:10'],
            'jenis_ternak_id' => ['required', 'exists:jenis_ternak,id'],
            'lokasi_id' => ['required', 'exists:lokasi_peternakan,id'],
            'kode_rfid' => ['nullable', 'string', 'max:255'],
            'status' => [
                'required',
                'in:tersedia,dipesan,terkirim,disembelih'
            ],
            'bobot_terakhir' => ['nullable', 'numeric', 'min:0'],
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
     * Form edit ternak.
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
     * Update ternak.
     */
    public function update(Request $request, Ternak $ternak)
    {
        $validated = $request->validate([
            'kode_ternak' => ['required', 'string', 'max:10'],
            'jenis_ternak_id' => ['required', 'exists:jenis_ternak,id'],
            'lokasi_id' => ['required', 'exists:lokasi_peternakan,id'],
            'kode_rfid' => ['nullable', 'string', 'max:255'],
            'status' => [
                'required',
                'in:tersedia,dipesan,terkirim,disembelih'
            ],
            'bobot_terakhir' => ['nullable', 'numeric', 'min:0'],
        ]);

        $ternak->update($validated);

        return redirect()
            ->route('ternak.index')
            ->with('success', 'Data ternak berhasil diperbarui.');
    }

    /**
     * Hapus ternak.
     */
    public function destroy(Ternak $ternak)
    {
        $ternak->delete();

        return redirect()
            ->route('ternak.index')
            ->with('success', 'Data ternak berhasil dihapus.');
    }
}