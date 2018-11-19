<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\UserProfile', 'user_id', 'id');
    }

    public function cart(){
        return $this->hasMany('App\Cart', 'user_id', 'id');
    }

    public function orders(){
        return $this->hasMany('App\Order', 'user_id', 'id');
    }

    public function transactions(){
        return $this->hasMany('App\Transaction', 'user_id', 'id');
    }

    public function userUploads(){
        return $this->hasMany('App\UserUploads', 'user_id', 'id');
    }
}
