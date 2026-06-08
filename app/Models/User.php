<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'status',
        'last_login_at',
        'prodi_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

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

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'Admin';
    }

    public function isDekan(): bool
    {
        return $this->role === 'Dekan';
    }

    public function isLppm(): bool
    {
        return $this->role === 'LPPM';
    }

    public function isKaprodi(): bool
    {
        return $this->role === 'Kaprodi';
    }

    public function canWrite(string $module): bool
    {
        $permissions = [
            'user'               => ['Admin'],
            'fakultas'           => ['Admin'],
            'prodi'              => ['Admin'],
            'dosen'              => ['Admin', 'Kaprodi'],
            'bidang'             => ['Admin', 'LPPM'],
            'program'            => ['Admin', 'LPPM'],
            'renstra'            => ['Admin', 'Dekan'],
            'hki'                => ['Admin', 'LPPM', 'Kaprodi'],
            'buku'               => ['Admin', 'LPPM', 'Kaprodi'],
            'artikel'            => ['Admin', 'LPPM', 'Kaprodi'],
            'kegiatan'           => ['Admin', 'LPPM', 'Kaprodi'],
            'kerjasama'          => ['Admin', 'LPPM'],
            'prestasi-akademik'  => ['Admin', 'Kaprodi'],
            'prestasi-non-akademik' => ['Admin', 'Kaprodi'],
        ];

        return in_array($this->role, $permissions[$module] ?? []);
    }
}
