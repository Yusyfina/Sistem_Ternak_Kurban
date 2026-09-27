<?php

namespace App\Http\Controllers;

use App\Models\LokasiPeternakan;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasi = LokasiPeternakan::withCount('ternak')
            ->latest()
            ->paginate(10);

        return view('lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        return view('lokasi.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:5', 'unique:lokasi_peternakan,kode'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        LokasiPeternakan::create($validated);

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function show(LokasiPeternakan $lokasi)
    {
        $lokasi->load('ternak');

        return view('lokasi.show', compact('lokasi'));
    }

    public function edit(LokasiPeternakan $lokasi)
    {
        return view('lokasi.edit', compact('lokasi'));
    }

    public function update(
        Request $request,
        LokasiPeternakan $lokasi
    ) {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:5',
                'unique:lokasi_peternakan,kode,' . $lokasi->id,
            ],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $lokasi->update($validated);

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(LokasiPeternakan $lokasi)
    {
        $lokasi->delete();

        return redirect()
            ->route('lokasi.index')
            ->with('success', 'Lokasi berhasil dihapus.');
    }
}