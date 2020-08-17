<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRequest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'user_id',
        'type',
        'university_id',
        'time_period'
    ];

    
    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }

   
    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
