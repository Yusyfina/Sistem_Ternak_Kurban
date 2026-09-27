<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriHarga extends Model
{
    use HasFactory;

    protected $table = 'kategori_harga';

    protected $fillable = [
        'kategori',
        'spesies',
        'bobot_min',
        'bobot_max',
        'harga',
        'status',
    ];

    protected $casts = [
        'bobot_min' => 'decimal:1',
        'bobot_max' => 'decimal:1',
        'harga' => 'decimal:2',
    ];

    /**
     * Satu kategori harga dapat digunakan oleh banyak pesanan.
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'kategori_harga_id');
    }
}