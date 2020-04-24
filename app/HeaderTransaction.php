<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeaderTransaction extends Model
{
    protected $fillable =[
        'user_id', 'start_date', 'end_date', 'payment'
    ];
}
