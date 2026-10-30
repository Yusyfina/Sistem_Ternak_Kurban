<?php

namespace App\Laporan;

use App\Models\Penimbangan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VerifikasiLaporan extends Laporan
{
    public function judul(): string
    {
        return 'Laporan Verifikasi';
    }

    protected function kolomData(): array
    {
        return [
            'Ditimbang', 'Kode Ternak', 'Jenis', 'Lokasi', 'Bobot (kg)', 'Operator',
            'Status Verifikasi', 'Diverifikasi Oleh', 'Waktu Verifikasi', 'Catatan',
        ];
    }

    protected function query(): Builder
    {
        return Penimbangan::query()
            ->with(['ternak.jenisTernak', 'ternak.lokasi', 'operator', 'verifikator'])
            ->untukUser($this->user)
            ->when($this->filter('dari'), fn ($q, $v) => $q->whereDate('ditimbang_at', '>=', $v))
            ->when($this->filter('sampai'), fn ($q, $v) => $q->whereDate('ditimbang_at', '<=', $v))
            ->when($this->filter('lokasi_id'), fn ($q, $v) => $q->whereHas('ternak', fn ($t) => $t->where('lokasi_id', $v)))
            ->when($this->filter('status_verifikasi'), fn ($q, $v) => $q->where('status_verifikasi', $v))
            ->orderByRaw("status_verifikasi = 'menunggu' DESC")
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
            $p->operator->kode ?? $p->operator->name ?? null,
            $this->labelVerifikasi($p->status_verifikasi),
            $p->verifikator->name ?? null,
            $this->tanggal($p->diverifikasi_at),
            $p->catatan_verifikasi,
        ];
    }
}