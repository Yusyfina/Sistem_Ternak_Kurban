<?php

namespace App\Laporan;

use App\Models\LokasiPeternakan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LokasiLaporan extends Laporan
{
    public function judul(): string
    {
        return 'Lokasi Peternakan';
    }

    protected function kolomData(): array
    {
        return ['Kode', 'Nama', 'Alamat', 'Status', 'Jumlah Ternak', 'Jenis Ternak'];
    }

    protected function query(): Builder
    {
        return LokasiPeternakan::query()
            ->with('ternak.jenisTernak')
            ->withCount('ternak')
            ->orderBy('kode');
    }

    protected function baris(Model $l): array
    {
        return [
            $l->kode,
            $l->nama,
            $l->alamat,
            ucfirst($l->status),
            (int) $l->ternak_count,
            $l->ternak->pluck('jenisTernak.nama_jenis')->filter()->unique()->implode(', '),
        ];
    }
}