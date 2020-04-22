<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'state_id', 'name', 'active',
    ];

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }
}
