<?php

namespace App\Laporan;

use App\Models\Penimbangan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RiwayatLaporan extends Laporan
{
    public function judul(): string
    {
        return 'Riwayat Penimbangan';
    }

    protected function kolomData(): array
    {
        return ['Ditimbang', 'Kode Ternak', 'Jenis', 'Lokasi', 'Bobot (kg)', 'Metode', 'Sumber', 'Operator', 'Verifikasi'];
    }

    protected function query(): Builder
    {
        return Penimbangan::query()
            ->with(['ternak.jenisTernak', 'ternak.lokasi', 'operator'])
            ->untukUser($this->user)
            ->when($this->user->role === 'operator', fn ($q) => $q->where('operator_id', $this->user->id))
            ->when($this->filter('dari'), fn ($q, $v) => $q->whereDate('ditimbang_at', '>=', $v))
            ->when($this->filter('sampai'), fn ($q, $v) => $q->whereDate('ditimbang_at', '<=', $v))
            ->when($this->filter('lokasi_id'), fn ($q, $v) => $q->whereHas('ternak', fn ($t) => $t->where('lokasi_id', $v)))
            ->when($this->filter('status_verifikasi'), fn ($q, $v) => $q->where('status_verifikasi', $v))
            ->orderByDesc('ditimbang_at');
    }

    protected function baris(Model $p): array
    {
        return [
            $this->tanggal($p->ditimbang_at),
            $p->ternak->kode_ternak ?? null,
            $p->ternak->jenisTernak->nama_jenis ?? null,
            $p->ternak->lokasi->nama ?? null,
            (float) $p->bobot,
            $this->labelMetode($p->metode),
            $this->labelSumber($p->sumber),
            $p->operator->kode ?? $p->operator->name ?? null,
            $this->labelVerifikasi($p->status_verifikasi),
        ];
    }
}