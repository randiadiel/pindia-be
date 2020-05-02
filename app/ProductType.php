<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function brand(){
        return $this->belongsTo('App\Brand');
    }
}
