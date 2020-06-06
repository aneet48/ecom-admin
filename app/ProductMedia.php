<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model
{
    protected $fillable = ['name', 'product_id', 'type', 'thumbnail'];
    protected $appends = ['link','thumbnail_link'];

    public function getLinkAttribute()
    {
        return url('storage/products/' . $this->name);
    }

    public function getThumbnailLinkAttribute()
    {
        return url('storage/products/' . $this->thumbnail);
    }

}
