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
        'category_id',
        'reciever_id',
        'active',
        'type',
        'university_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }

    public function images()
    {
        return $this->hasMany('App\ProductMedia', 'product_id');
    }

    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }

    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }

}
