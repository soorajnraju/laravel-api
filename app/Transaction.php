<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = "transaction";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_trans_id','user_id', 'order_id', 'status'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }

    public function order(){
        return $this->belongsTo('App\Order', 'id');
    }
}
