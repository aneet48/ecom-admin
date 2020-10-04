<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVisits extends Model
{
    protected $fillable = ['user_id', 'feature'];
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
