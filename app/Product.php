<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'productType_id', 'shop_id', 'name', 'price', 'description'
    ];

    public function images(){
        $this->hasMany('App\Image');
    }

    public function detail_transactions(){
        $this->belongsToMany('App\DetailTransaction');
    }

    public function product_type(){
        $this->hasOne('App\ProductType');
    }

    public function shop(){
        $this->belongsTo('App\Shop');
    }
}
