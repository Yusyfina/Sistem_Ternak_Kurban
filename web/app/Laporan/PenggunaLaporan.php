<?php

namespace App\Laporan;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PenggunaLaporan extends Laporan
{
    public function judul(): string
    {
        return 'Daftar Pengguna';
    }

    protected function kolomData(): array
    {
        return ['Nama', 'Kode', 'Email', 'Peran', 'Lokasi', 'Status'];
    }

    protected function query(): Builder
    {
        return User::query()->with('lokasi')->orderBy('role')->orderBy('name');
    }

    protected function baris(Model $u): array
    {
        return [
            $u->name,
            $u->kode,
            $u->email,
            Str::headline($u->role),
            $u->lokasi->nama ?? 'Semua lokasi',
            ucfirst($u->status),
        ];
    }
}