<?php

namespace App\Http\Controllers;

use App\Models\KategoriHarga;
use App\Models\Pembeli;
use App\Models\Pesanan;
use App\Models\Ternak;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with([
            'pembeli',
            'kategoriHarga',
            'ternak',
        ])
            ->latest()
            ->paginate(10);

        return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        $pembeli = Pembeli::orderBy('nama')->get();

        $kategoriHarga = KategoriHarga::where('status', 'aktif')
            ->orderBy('kategori')
            ->get();

        return view('pesanan.create', compact(
            'pembeli',
            'kategoriHarga'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_pesanan' => ['required', 'string', 'max:255', 'unique:pesanan,no_pesanan'],
            'pembeli_id' => ['required', 'exists:pembeli,id'],
            'kategori_harga_id' => ['required', 'exists:kategori_harga,id'],
            'harga' => ['required', 'numeric', 'min:0'],
            'status' => [
                'required',
                'in:menunggu_pemasangan,terpasang,dibatalkan'
            ],
            'ternak_id' => ['nullable', 'exists:ternak,id'],
        ]);

        Pesanan::create($validated);

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load([
            'pembeli',
            'kategoriHarga',
            'ternak',
        ]);

        return view('pesanan.show', compact('pesanan'));
    }

    public function edit(Pesanan $pesanan)
    {
        $pembeli = Pembeli::orderBy('nama')->get();

        $kategoriHarga = KategoriHarga::where('status', 'aktif')
            ->orderBy('kategori')
            ->get();

        return view('pesanan.edit', compact(
            'pesanan',
            'pembeli',
            'kategoriHarga'
        ));
    }

    public function update(Request $request, Pesanan $pesanan)
    {
        $validated = $request->validate([
            'no_pesanan' => [
                'required',
                'string',
                'max:255',
                'unique:pesanan,no_pesanan,' . $pesanan->id,
            ],
            'pembeli_id' => ['required', 'exists:pembeli,id'],
            'kategori_harga_id' => ['required', 'exists:kategori_harga,id'],
            'harga' => ['required', 'numeric', 'min:0'],
            'status' => [
                'required',
                'in:menunggu_pemasangan,terpasang,dibatalkan'
            ],
            'ternak_id' => ['nullable', 'exists:ternak,id'],
        ]);

        $pesanan->update($validated);

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * Memasangkan pesanan dengan ternak.
     */
    public function pasangkan(
        Request $request,
        Pesanan $pesanan
    ) {
        $validated = $request->validate([
            'ternak_id' => ['required', 'exists:ternak,id'],
        ]);

        $ternak = Ternak::findOrFail($validated['ternak_id']);

        if ($ternak->status !== 'tersedia') {
            return back()
                ->withErrors([
                    'ternak_id' => 'Ternak tidak tersedia untuk dipasangkan.'
                ]);
        }

        $pesanan->update([
            'ternak_id' => $ternak->id,
            'status' => 'terpasang',
        ]);

        $ternak->update([
            'status' => 'dipesan',
        ]);

        return redirect()
            ->route('pesanan.index')
            ->with('success', 'Pesanan berhasil dipasangkan dengan ternak.');
    }
}