<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo('App\Category', 'product_category');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }
}
