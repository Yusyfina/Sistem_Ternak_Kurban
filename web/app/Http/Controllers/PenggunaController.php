<?php

namespace App\Http\Controllers;

use App\Models\LokasiPeternakan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::with('lokasi')
            ->latest()
            ->paginate(10);

        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        $lokasi = LokasiPeternakan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('pengguna.create', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:10'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => [
                'required',
                Rule::in([
                    'super_admin',
                    'admin_pusat',
                    'admin_lokasi',
                    'operator',
                    'mandor',
                ]),
            ],
            'lokasi_id' => [
                'nullable',
                'exists:lokasi_peternakan,id',
            ],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $validated['password'] = Hash::make(
            $validated['password']
        );

        User::create($validated);

        return redirect()
            ->route('pengguna.index')
            ->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(User $pengguna)
    {
        $pengguna->load('lokasi');

        return view('pengguna.show', compact('pengguna'));
    }

    public function edit(User $pengguna)
    {
        $lokasi = LokasiPeternakan::where('status', 'aktif')
            ->orderBy('nama')
            ->get();

        return view('pengguna.edit', compact(
            'pengguna',
            'lokasi'
        ));
    }

    public function update(
        Request $request,
        User $pengguna
    ) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kode' => ['nullable', 'string', 'max:10'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $pengguna->id,
            ],
            'role' => [
                'required',
                Rule::in([
                    'super_admin',
                    'admin_pusat',
                    'admin_lokasi',
                    'operator',
                    'mandor',
                ]),
            ],
            'lokasi_id' => [
                'nullable',
                'exists:lokasi_peternakan,id',
            ],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make(
                $request->password
            );
        }

        $pengguna->update($validated);

        return redirect()
            ->route('pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy(User $pengguna)
    {
        $pengguna->delete();

        return redirect()
            ->route('pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}