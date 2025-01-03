<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPERADMIN = 'SUPER ADMIN';
    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';
    const ROLE_DEFAULT = self::ROLE_USER;
    
    const ROLES = [
        self::ROLE_SUPERADMIN => 'Super Admin',
        self::ROLE_ADMIN => 'Admin',
        self::ROLE_USER => 'User',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->isSuperadmin() || $this->isAdmin();
    }

    public function isSuperadmin(){
        return $this->role === self::ROLE_SUPERADMIN;
    }

    public function isAdmin(){
        return $this->role === self::ROLE_ADMIN;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
}
