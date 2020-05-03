<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'seller_id',
        'reciever_id',
        'active',
        'type',
    ];
}
