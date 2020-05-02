<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable =[
        'user_id', 'name', 'address'
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function users(){
        return $this->hasOne('App\User');
    }
}
