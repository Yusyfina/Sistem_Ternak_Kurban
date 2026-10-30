<?php
namespace App\Models;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'kode',
    'email',
    'password',
    'role',
    'lokasi_id',
    'status',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /**
     * @use HasFactory<UserFactory>
     */
    use HasFactory, Notifiable;

    /**
     * Role yang boleh melihat data semua lokasi.
     */
    public const ROLE_GLOBAL = [
        'super_admin',
        'admin_pusat',
    ];

    /**
     * Memeriksa apakah user boleh melihat semua lokasi.
     */
    public function bolehLihatSemuaLokasi(): bool
    {
        return in_array($this->role, self::ROLE_GLOBAL, true);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke lokasi peternakan.
     */
    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(
            LokasiPeternakan::class,
            'lokasi_id'
        );
    }

    /**
     * Relasi penimbangan yang dilakukan operator.
     */
    public function penimbangan(): HasMany
    {
        return $this->hasMany(
            Penimbangan::class,
            'operator_id'
        );
    }

    /**
     * Relasi penimbangan yang diverifikasi user.
     */
    public function verifikasiPenimbangan(): HasMany
    {
        return $this->hasMany(
            Penimbangan::class,
            'diverifikasi_oleh'
        );
    }
}
