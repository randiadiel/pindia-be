<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $fillable =[
        'productId', 'days', 'status'
    ];
}
