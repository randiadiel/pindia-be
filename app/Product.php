<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id', 'shop_id', 'name', 'price', 'description'
    ];

    public function images(){
       return $this->hasMany('App\Image');
    }

    public function detail_transactions(){
       return $this->belongsToMany('App\DetailTransaction');
    }

    public function product_type(){
       return $this->hasOne('App\ProductType');
    }

    public function shop(){
       return $this->belongsTo('App\Shop');
    }

    public function brand(){
       return $this->hasOne('App\Brand');
    }
}
