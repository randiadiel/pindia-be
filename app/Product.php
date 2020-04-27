<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'productType_id', 'shop_id', 'name', 'price', 'description'
    ];
}
