<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembeli extends Model
{
    use HasFactory;

    protected $table = 'pembeli';

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
    ];

    /**
     * Satu pembeli dapat memiliki banyak pesanan.
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'pembeli_id');
    }
}