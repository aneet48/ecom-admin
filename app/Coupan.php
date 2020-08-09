<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupan extends Model
{
    protected $fillable = [
        'code', 'expiry_date', 'users_can_use','amount'
    ];
    
}
