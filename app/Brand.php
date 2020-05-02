<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'product_type_id', 'name'
    ];

    public function productType(){
        $this->hasMany("App\ProductType");
    }
}
