<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','amount', 'category'
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'id');
    }
}
