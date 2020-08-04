<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'reciept_id',
        'rzp_order_id',
        'rzp_transaction_id',
        'status',
        'price',
        'user_id',
        'type',
    ];
}
