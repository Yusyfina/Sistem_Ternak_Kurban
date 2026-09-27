<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisTernak extends Model
{
    use HasFactory;

    protected $table = 'jenis_ternak';

    protected $fillable = [
        'spesies',
        'nama_jenis',
    ];

    /**
     * Satu jenis ternak dapat dimiliki banyak ternak.
     */
    public function ternak(): HasMany
    {
        return $this->hasMany(Ternak::class, 'jenis_ternak_id');
    }
}