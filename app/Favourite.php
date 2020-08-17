<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $fillable = [
        'type', 'type_id', 'user_id',
    ];

    public function event()
    {
        return $this->belongsTo('App\Event', 'type_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product', 'type_id');
    }
    
}
