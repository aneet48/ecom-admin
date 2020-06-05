<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $fillable = ['name', 'product_id', 'type', 'thumbnail'];
    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return url('storage/products/' . $this->name);
    }

}
