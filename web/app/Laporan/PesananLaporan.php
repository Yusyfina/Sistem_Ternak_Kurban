<?php

namespace App\Laporan;

use App\Models\Pesanan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PesananLaporan extends Laporan
{
    public function judul(): string
    {
        return 'Laporan Pesanan';
    }

    protected function kolomData(): array
    {
        return ['No. Pesanan', 'Tanggal', 'Pembeli', 'Telepon', 'Kategori', 'Harga (Rp)', 'Status', 'Ternak'];
    }

    protected function query(): Builder
    {
        return Pesanan::query()
            ->with(['pembeli', 'kategoriHarga', 'ternak.lokasi'])
            ->when($this->filter('dari'), fn ($q, $v) => $q->whereDate('created_at', '>=', $v))
            ->when($this->filter('sampai'), fn ($q, $v) => $q->whereDate('created_at', '<=', $v))
            ->when($this->filter('status'), fn ($q, $v) => $q->where('status', $v))
            ->orderByDesc('id');
    }

    protected function baris(Model $p): array
    {
        return [
            $p->no_pesanan,
            $this->tanggal($p->created_at),
            $p->pembeli->nama ?? null,
            $p->pembeli->telepon ?? null,
            $p->kategoriHarga->kategori ?? null,
            (int) $p->harga,
            ucfirst(str_replace('_', ' ', $p->status)),
            $p->ternak ? $p->ternak->kode_ternak.' ('.($p->ternak->lokasi->nama ?? '-').')' : null,
        ];
    }
}