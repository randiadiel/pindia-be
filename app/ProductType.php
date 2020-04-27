<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function product(){
        $this->belongsTo('App\Product');
    }
}
