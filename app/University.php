<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable = [
        'name', 'city_id', 'active', 'slug',
    ];

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function students()
    {
        return $this->hasMany('App\User', 'university_id');
    }

    public function newStudents()
    {
        return $this->hasMany('App\User', 'university_id')->whereDate('created_at', Carbon::today());
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'university_id');
    }
}
