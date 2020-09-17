<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'university_id',
        'title',
        'description',
        'price',
        'event_date',
        'event_time',
        'contact_number',
        'social_profiles',
        'book_event_link',
        'visit_website_link',
        'active',
        'event_price',
        'seller_id',
        'coupan_id',
    ];
    protected $appends = ['thumbnail_image'];

    public function getThumbnailImageAttribute()
    {
        return EventMedia::where('event_id', $this->id)->first();
    }

    public function seller()
    {
        return $this->belongsTo('App\User', 'seller_id');
    }

    protected $casts = [
        'social_profiles' => 'array',
    ];

    // protected $appends = ['images', 'category', 'university', 'seller'];

    public function category()
    {
        return $this->belongsTo('App\EventCategory', 'category_id');
    }

    public function images()
    {
        return $this->hasMany('App\EventMedia', 'event_id');
    }

    public function university()
    {
        return $this->belongsTo('App\University', 'university_id');
    }
}
