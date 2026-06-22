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

    const ROLE_ADMIN = 'Admin';
    const ROLE_DEKAN = 'Dekan';
    const ROLE_LPPM = 'LPPM';
    const ROLE_KAPRODI = 'Kaprodi';

    const ROLES = [
        self::ROLE_ADMIN,
        self::ROLE_DEKAN,
        self::ROLE_LPPM,
        self::ROLE_KAPRODI,
    ];

    const STATUS_AKTIF = 'Aktif';
    const STATUS_NONAKTIF = 'Nonaktif';

    const STATUSES = [
        self::STATUS_AKTIF => 'Aktif',
        self::STATUS_NONAKTIF => 'Nonaktif',
    ];

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

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

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
        return $this->role === self::ROLE_ADMIN;
    }

    public function isDekan(): bool
    {
        return $this->role === self::ROLE_DEKAN;
    }

    public function isLppm(): bool
    {
        return $this->role === self::ROLE_LPPM;
    }

    public function isKaprodi(): bool
    {
        return $this->role === self::ROLE_KAPRODI;
    }

    public function canWrite(string $module): bool
    {
        $permissions = [
            'user'               => [self::ROLE_ADMIN],
            'fakultas'           => [self::ROLE_ADMIN],
            'prodi'              => [self::ROLE_ADMIN],
            'dosen'              => [self::ROLE_ADMIN, self::ROLE_KAPRODI],
            'bidang'             => [self::ROLE_ADMIN, self::ROLE_LPPM],
            'program'            => [self::ROLE_ADMIN, self::ROLE_LPPM],
            'renstra'            => [self::ROLE_ADMIN, self::ROLE_DEKAN],
            'hki'                => [self::ROLE_ADMIN, self::ROLE_LPPM, self::ROLE_KAPRODI],
            'buku'               => [self::ROLE_ADMIN, self::ROLE_LPPM, self::ROLE_KAPRODI],
            'artikel'            => [self::ROLE_ADMIN, self::ROLE_LPPM, self::ROLE_KAPRODI],
            'kegiatan'           => [self::ROLE_ADMIN, self::ROLE_LPPM, self::ROLE_KAPRODI],
            'kerjasama'          => [self::ROLE_ADMIN, self::ROLE_LPPM],
            'prestasi-akademik'  => [self::ROLE_ADMIN, self::ROLE_KAPRODI],
            'prestasi-non-akademik' => [self::ROLE_ADMIN, self::ROLE_KAPRODI],
        ];

        return in_array($this->role, $permissions[$module] ?? []);
    }
}
