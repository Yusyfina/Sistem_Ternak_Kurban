<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LokasiPeternakan extends Model
{
    use HasFactory;

    protected $table = 'lokasi_peternakan';

    protected $fillable = [
        'kode',
        'nama',
        'alamat',
        'status',
    ];

    /**
     * Satu lokasi memiliki banyak ternak.
     */
    public function ternak(): HasMany
    {
        return $this->hasMany(Ternak::class, 'lokasi_id');
    }

    /**
     * Satu lokasi memiliki banyak pengguna.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'lokasi_id');
    }
}