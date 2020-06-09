<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'active',
        'parent_id',
        'slug'
    ];
    protected $appends = ['fixed'];

    public function parent()
    {
        return $this->belongsTo('App\ProductCategory', 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany('App\ProductCategory', 'parent_id')->with('children');
    }

    public function getFixedAttribute()
    {
        $fixed_cats = config('constants.fixed_product_cats');
        return in_array($this->name, $fixed_cats);
    }
}
