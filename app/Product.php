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
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'category_id');
    }
    public function images()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }


}
