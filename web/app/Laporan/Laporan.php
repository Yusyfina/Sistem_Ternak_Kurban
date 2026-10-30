<?php

namespace App\Laporan;

use App\Models\LokasiPeternakan;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class Laporan
{
    /**
     * Aktifkan atau nonaktifkan kolom timestamp
     * untuk seluruh laporan.
     */
    protected bool $denganTimestamp = true;

    public function __construct(
        protected User $user,
        protected Request $request,
    ) {}

    /** Judul laporan: header PDF/Word dan nama sheet Excel. */
    abstract public function judul(): string;

    /** Nama kolom data, tanpa kolom "No". */
    abstract protected function kolomData(): array;

    /** Query data yang sudah dibatasi hak akses dan filter. */
    abstract protected function query(): Builder;

    /** Satu baris data (tanpa nomor) untuk satu model. */
    abstract protected function baris(Model $model): array;

    /**
     * Menampilkan kolom laporan beserta timestamp.
     */
    final public function kolom(): array
    {
        $kolom = array_merge(['No'], $this->kolomData());

        if ($this->denganTimestamp) {
            array_push(
                $kolom,
                'Ditambahkan (WIB)',
                'Terakhir Diubah (WIB)'
            );
        }

        return $kolom;
    }

    /**
     * Mengambil data laporan beserta timestamp.
     */
    final public function data(): array
    {
        return $this->query()
            ->get()
            ->values()
            ->map(function (Model $m, int $i) {
                $baris = array_merge(
                    [$i + 1],
                    $this->baris($m)
                );

                if ($this->denganTimestamp) {
                    $baris[] = $this->waktuCatat($m->created_at);
                    $baris[] = $this->waktuCatat($m->updated_at);
                }

                return $baris;
            })
            ->all();
    }

    /**
     * Format timestamp ke zona waktu WIB.
     */
    protected function waktuCatat($waktu): ?string
    {
        return $waktu
            ? $waktu->copy()
                ->timezone('Asia/Jakarta')
                ->format('d/m/Y H.i.s')
            : null;
    }

    /** Keterangan yang tampil di bawah judul PDF/Word. */
    public function ringkasan(): array
    {
        return [
            'Dicetak oleh' => $this->user->name.' ('.Str::headline($this->user->role).')',
            'Cakupan data' => $this->user->bolehLihatSemuaLokasi()
                ? 'Semua lokasi'
                : ($this->user->lokasi->nama ?? '-'),
            'Waktu cetak' => now('Asia/Jakarta')->translatedFormat('d F Y, H.i').' WIB',
            ...$this->keteranganFilter(),
        ];
    }

    protected function keteranganFilter(): array
    {
        $ket = [];

        if ($v = $this->filter('dari')) {
            $ket['Dari tanggal'] = $v;
        }

        if ($v = $this->filter('sampai')) {
            $ket['Sampai tanggal'] = $v;
        }

        if ($v = $this->filter('lokasi_id')) {
            $ket['Lokasi'] = LokasiPeternakan::find($v)?->nama ?? $v;
        }

        foreach (['status', 'status_verifikasi'] as $k) {
            if ($v = $this->filter($k)) {
                $ket['Status'] = Str::headline($v);
            }
        }

        return $ket;
    }

    public function namaFile(): string
    {
        return Str::slug($this->judul()).'-'.now('Asia/Jakarta')->format('Ymd-His');
    }

    /** Ambil satu nilai filter dari query string; kosong dianggap tidak ada. */
    protected function filter(string $key): ?string
    {
        $nilai = $this->request->query($key);

        return is_string($nilai) && $nilai !== '' ? $nilai : null;
    }

    /** Format satu sel untuk PDF dan Word (Excel memakai angka asli). */
    public static function sel(mixed $nilai): string
    {
        return match (true) {
            $nilai === null || $nilai === '' => '-',
            is_int($nilai) => number_format($nilai, 0, ',', '.'),
            is_float($nilai) => number_format($nilai, 1, ',', '.'),
            default => (string) $nilai,
        };
    }

    protected function tanggal($waktu): ?string
    {
        return $waktu ? $waktu->format('d/m/Y H.i') : null;
    }

    protected function labelMetode(?string $v): string
    {
        return match ($v) {
            'manual' => 'Penimbangan manual',
            'estimasi' => 'Estimasi peternak',
            'otomatis_iot' => 'Otomatis IoT',
            default => '-',
        };
    }

    protected function labelSumber(?string $v): string
    {
        return match ($v) {
            'manual_entry' => 'Manual entry',
            'otomatis_iot' => 'Otomatis IoT',
            'data_manajemen' => 'Data manajemen',
            'tidak_ada_data' => 'Tidak ada data',
            default => '-',
        };
    }

    protected function labelVerifikasi(?string $v): string
    {
        return match ($v) {
            'menunggu' => 'Menunggu verifikasi',
            'valid' => 'Valid',
            'kurang_akurat' => 'Kurang akurat, diterima',
            'tidak_valid' => 'Tidak valid',
            default => '-',
        };
    }
}
