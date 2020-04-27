<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'productType_id', 'name'
    ];

    public function productType(){
        $this->hasOne("App\ProductType");
    }
}
