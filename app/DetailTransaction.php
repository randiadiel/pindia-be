<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
 protected $fillable =[
         'product_id','days','status'
 ];

 public function product(){
    return $this->hasOne('App\Product');
 }

 public function header_transaction(){
    return $this->hasOne('App\HeaderTransaction');
 }
    
}
