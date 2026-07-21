<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'phone',
        'shop_name',
        'city_area',
        'discount',
        'photo',
        'pin',
        'plain_pin',
        'status',
        'device_id',
        'device_change_allowed',
        'two_factor_secret',
        'two_factor_enabled',
        'role',
    ];

    protected $casts = [
        'device_change_allowed' => 'boolean',
        'two_factor_enabled' => 'boolean',
    ];

    protected $hidden = [
        'pin',
        'two_factor_secret',
        'remember_token',
    ];

    public function hasTwoFactorEnabled(): bool
    {
        return $this->two_factor_enabled && filled($this->two_factor_secret);
    }

    /**
     * Get all device change requests for the user.
     */
    public function deviceRequests()
    {
        return $this->hasMany(
            DeviceChangeRequest::class
        );
    }
}
