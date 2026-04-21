<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\EncryptableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, EncryptableTrait;

    protected string $guard_name = 'api';

    protected $encryptable = [
        'document',
        'first_name',
        'second_name',
        'first_last_name',
        'second_last_name',
        'address',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'document',
        'first_name',
        'second_name',
        'first_last_name',
        'second_last_name',
        'address',
        'phone',
        'phone_ext',
        'birth_day',
        'lang',
        'active',
        'imagen',
        'last_notification',
        'two_factor_secret',
        'two_factor_confirmed_at',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at'      => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
        'password'               => 'hashed',
    ];
}
