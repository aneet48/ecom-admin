<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name', 'city_id', 'active',
    ];

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }
}
