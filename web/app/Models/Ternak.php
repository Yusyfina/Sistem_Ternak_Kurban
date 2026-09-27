<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ternak extends Model
{
    use HasFactory;

    protected $table = 'ternak';

    protected $fillable = [
        'kode_ternak',
        'jenis_ternak_id',
        'lokasi_id',
        'kode_rfid',
        'status',
        'bobot_terakhir',
    ];

    protected $casts = [
        'bobot_terakhir' => 'decimal:1',
    ];

    /**
     * Ternak memiliki satu jenis ternak.
     */
    public function jenisTernak(): BelongsTo
    {
        return $this->belongsTo(JenisTernak::class, 'jenis_ternak_id');
    }

    /**
     * Ternak berada di satu lokasi peternakan.
     */
    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(
            LokasiPeternakan::class,
            'lokasi_id'
        );
    }

    /**
     * Satu ternak dapat memiliki banyak riwayat penimbangan.
     */
    public function penimbangan(): HasMany
    {
        return $this->hasMany(
            Penimbangan::class,
            'ternak_id'
        );
    }

    /**
     * Menampilkan kode ternak + nama lokasi.
     *
     * Contoh:
     * D-1 · Kampung Ternak A
     */
    public function getLabelAttribute(): string
    {
        return "{$this->kode_ternak} · {$this->lokasi->nama}";
    }
}