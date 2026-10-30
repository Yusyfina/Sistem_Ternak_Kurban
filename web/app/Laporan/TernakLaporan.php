<?php

namespace App\Laporan;

use App\Models\Ternak;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class TernakLaporan extends Laporan
{
    public function judul(): string
    {
        return 'Data Ternak';
    }

    protected function kolomData(): array
    {
        return ['Kode', 'Jenis', 'Spesies', 'Lokasi', 'Kode RFID', 'Status', 'Bobot Terakhir (kg)'];
    }

    protected function query(): Builder
    {
        return Ternak::query()
            ->with(['jenisTernak', 'lokasi'])
            ->untukUser($this->user)
            ->when($this->filter('lokasi_id'), fn ($q, $v) => $q->where('lokasi_id', $v))
            ->when($this->filter('status'), fn ($q, $v) => $q->where('status', $v))
            ->orderBy('lokasi_id')
            ->orderBy('kode_ternak');
    }

    protected function baris(Model $t): array
    {
        return [
            $t->kode_ternak,
            $t->jenisTernak->nama_jenis ?? null,
            ucfirst($t->jenisTernak->spesies ?? ''),
            $t->lokasi->nama ?? null,
            $t->kode_rfid,
            ucfirst($t->status),
            $t->bobot_terakhir !== null ? (float) $t->bobot_terakhir : null,
        ];
    }
}