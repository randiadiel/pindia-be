<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
 protected $fillable =[
         'product_id','days','status'
 ];
 
}
