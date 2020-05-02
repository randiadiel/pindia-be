<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'product_type_id', 'name'
    ];

    public function productTypes(){
       return $this->hasMany("App\ProductType");
    }

    public function product(){
       return $this->belongsTo('App\Product');
    }
}
