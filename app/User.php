<?php

namespace App;

use App\Notifications\PasswordResetNotification;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use  HasApiTokens, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password'
    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
