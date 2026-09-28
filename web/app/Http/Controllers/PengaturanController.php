<?php

namespace App\Http\Controllers;

use App\Models\JenisTernak;
use App\Models\KategoriHarga;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    /**
     * Menampilkan halaman pengaturan.
     */
    public function index()
    {
        $kategori = KategoriHarga::orderBy('kategori')
            ->orderBy('bobot_min')
            ->get();

        $jenisTernak = JenisTernak::orderBy('spesies')
            ->orderBy('nama_jenis')
            ->get();

        return view('pengaturan.index', compact(
            'kategori',
            'jenisTernak'
        ));
    }

    /**
     * Menambahkan kategori harga.
     */
    public function storeKategori(Request $request)
    {
        $validated = $request->validate([
            'kategori' => [
                'required',
                'string',
                'max:100',
            ],

            'spesies' => [
                'required',
                'in:domba,sapi',
            ],

            'bobot_min' => [
                'required',
                'numeric',
                'min:0',
            ],

            'bobot_max' => [
                'required',
                'numeric',
                'gte:bobot_min',
            ],

            'harga' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        $validated['status'] = 'aktif';

        KategoriHarga::create($validated);

        return redirect()
            ->route('pengaturan.index')
            ->with(
                'success',
                'Kategori harga berhasil ditambahkan.'
            );
    }

    /**
     * Menambahkan jenis ternak.
     */
    public function storeJenis(Request $request)
    {
        $validated = $request->validate([
            'spesies' => [
                'required',
                'in:domba,sapi',
            ],

            'nama_jenis' => [
                'required',
                'string',
                'max:100',
            ],
        ]);

        JenisTernak::create($validated);

        return redirect()
            ->route('pengaturan.index')
            ->with(
                'success',
                'Jenis ternak berhasil ditambahkan.'
            );
    }
}