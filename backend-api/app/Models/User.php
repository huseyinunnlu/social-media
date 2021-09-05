<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'phone_verified_at',
        'isPhoneVerified',
        'isEmailVerified',
        'birth',
        'gender',
        'bio',
        'acctype',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['isFollowing'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    public function authUserToken()
    {
        return $this->hasMany('App\Models\OAuthAccessToken');
    }

    public function followers()
    {
        return $this->hasMany('App\Models\Follow'::class, 'follow_id');
    }

    public function getIsfollowingAttribute(){
        return false;
    }
}
