<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function checkAdmin(){
        return $this->usertype === 'admin';
    }

    public function attendedParties(){  //กำหนดความสัมพันธ์attendedกับParties
        return $this->belongsToMany(Party::class, 'attendances')
                    ->withTimestamps();
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }


    protected $fillable = [
        'username',
        'fristname',
        'lastname',
        'email',
        'password',
        'usertype',
        'gender',
        'birthday',
        'phone',
        'Introduction',
        'profile_photo_path',
        'current_team_id',

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
