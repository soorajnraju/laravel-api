<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','product_id', 'quantity', 'status'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function product(){
        return $this->belongsTo('App\product', 'product_id', 'id');
    }

}
