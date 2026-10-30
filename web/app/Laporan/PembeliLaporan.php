<?php

namespace App\Laporan;

use App\Models\Pembeli;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PembeliLaporan extends Laporan
{
    public function judul(): string
    {
        return 'Daftar Pembeli';
    }

    protected function kolomData(): array
    {
        return ['Nama', 'Telepon', 'Alamat', 'Jumlah Pesanan'];
    }

    protected function query(): Builder
    {
        return Pembeli::query()->withCount('pesanan')->orderBy('nama');
    }

    protected function baris(Model $p): array
    {
        return [$p->nama, $p->telepon, $p->alamat, (int) $p->pesanan_count];
    }
}