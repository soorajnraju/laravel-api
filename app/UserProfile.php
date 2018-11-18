<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = "user_profile";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','first_name', 'last_name',
        'address', 'street', 'city', 'state',
        'zip', 'country', 'profile_pic'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }
}
