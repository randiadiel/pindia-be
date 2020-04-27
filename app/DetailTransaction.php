<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
 protected $fillable =[
         'product_id','days','status'
 ];

 public function product(){
     $this->hasOne('App\Product');
 }

 public function header_transaction(){
     $this->hasOne('App\HeaderTransaction');
 }
    
}
