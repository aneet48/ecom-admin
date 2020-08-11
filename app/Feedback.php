<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Feedback extends Model
{
    protected $fillable = [
        'name', 'rating', 'text','image'
    ];
    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return url('storage/feedback/' . $this->image);
    }

    public static function saveBase64Media($data)
    {
        $image_64 = $data; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = 'feedback' . Str::random(5) . time() . '.' . $extension;
        $data = Storage::disk('feedback')->put($imageName, base64_decode($image));
        $mime = mime_content_type(public_path() . '/storage/feedback/' . $imageName);
        $type = '';
        $thumbnail = $imageName;
      
        $type = 'image';

        return $imageName;
    }
    
}
