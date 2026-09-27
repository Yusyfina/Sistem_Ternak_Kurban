<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'no_pesanan',
        'pembeli_id',
        'kategori_harga_id',
        'harga',
        'status',
        'ternak_id',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Pesanan dimiliki oleh satu pembeli.
     */
    public function pembeli(): BelongsTo
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id');
    }

    /**
     * Pesanan menggunakan satu kategori harga.
     */
    public function kategoriHarga(): BelongsTo
    {
        return $this->belongsTo(
            KategoriHarga::class,
            'kategori_harga_id'
        );
    }

    /**
     * Pesanan dapat dipasangkan dengan satu ternak.
     *
     * ternak_id nullable karena saat pesanan
     * pertama kali dibuat belum tentu ada ternak.
     */
    public function ternak(): BelongsTo
    {
        return $this->belongsTo(Ternak::class, 'ternak_id');
    }
}