<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function index()
    {
        $pembeli = Pembeli::latest()->paginate(10);

        return view('pembeli.index', compact('pembeli'));
    }

    public function create()
    {
        return view('pembeli.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        Pembeli::create($validated);

        return redirect()
            ->route('pembeli.index')
            ->with('success', 'Data pembeli berhasil ditambahkan.');
    }

    public function show(Pembeli $pembeli)
    {
        $pembeli->load('pesanan');

        return view('pembeli.show', compact('pembeli'));
    }

    public function edit(Pembeli $pembeli)
    {
        return view('pembeli.edit', compact('pembeli'));
    }

    public function update(Request $request, Pembeli $pembeli)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
            'alamat' => ['nullable', 'string'],
        ]);

        $pembeli->update($validated);

        return redirect()
            ->route('pembeli.index')
            ->with('success', 'Data pembeli berhasil diperbarui.');
    }

    public function destroy(Pembeli $pembeli)
    {
        $pembeli->delete();

        return redirect()
            ->route('pembeli.index')
            ->with('success', 'Data pembeli berhasil dihapus.');
    }
}