<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
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
        'email',
        'password',
        'nickname',
        'dt_reg', // 가입일
        'dt_upt', // 수정일
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
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false; // 기본 timestamps 비활성화

    /**
     * Automatically cast these fields as dates.
     *
     * @var array
     */
    protected $dates = ['dt_reg', 'dt_upt']; // 가입일 및 수정일

    /**
     * Boot method to handle dt_reg and dt_upt fields automatically.
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            $user->dt_reg = now(); // 생성 시점에 가입일 설정
            $user->dt_upt = now(); // 생성 시점에 수정일 설정
        });

        static::updating(function ($user) {
            $user->dt_upt = now(); // 수정 시점에 수정일 업데이트
        });
    }

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
