<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['name', 'product_id'];
    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return url('storage/products/' . $this->name);
    }

}
