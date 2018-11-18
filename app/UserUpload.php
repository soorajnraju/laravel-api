<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserUpload extends Model
{
    protected $table = "user_uploads";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'upload_path','type'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }
}
