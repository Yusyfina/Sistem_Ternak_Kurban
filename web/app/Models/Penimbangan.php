<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Penimbangan extends Model
{
    use HasFactory;

    protected $table = 'penimbangan';

    protected $fillable = [
        'ternak_id',
        'bobot',
        'metode',
        'sumber',
        'operator_id',
        'status_verifikasi',
        'catatan_verifikasi',
        'diverifikasi_oleh',
        'diverifikasi_at',
        'ditimbang_at',
    ];

    protected $casts = [
        'bobot' => 'decimal:1',
        'diverifikasi_at' => 'datetime',
        'ditimbang_at' => 'datetime',
    ];

    /**
     * Penimbangan dimiliki oleh satu ternak.
     */
    public function ternak(): BelongsTo
    {
        return $this->belongsTo(Ternak::class, 'ternak_id');
    }

    /**
     * Penimbangan dilakukan oleh seorang operator.
     */
    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    /**
     * Penimbangan diverifikasi oleh user tertentu.
     */
    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    /**
     * Membatasi data penimbangan berdasarkan lokasi user.
     */
    public function scopeUntukUser(Builder $query, User $user): Builder
    {
        // Super Admin dan Admin Pusat dapat melihat semua lokasi.
        if ($user->bolehLihatSemuaLokasi()) {
            return $query;
        }

        // Jika user tidak memiliki lokasi, jangan tampilkan data.
        if (! $user->lokasi_id) {
            return $query->whereRaw('1 = 0');
        }

        // Memeriksa lokasi melalui relasi ternak.
        return $query->whereHas(
            'ternak',
            fn (Builder $q) => $q->where('lokasi_id', $user->lokasi_id)
        );
    }
}