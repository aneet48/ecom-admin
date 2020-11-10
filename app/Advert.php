<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Advert extends Model
{
    protected $fillable = ['image', 'place', 'openlink'];
    protected $appends = ['link'];
    public function getLinkAttribute()
    {
        return url('storage/adverts/' . $this->image);
    }
    public static function saveBase64Media($data)
    {
        $image_64 = $data; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = 'adverts' . Str::random(5) . time() . '.' . $extension;
        $data = Storage::disk('adverts')->put($imageName, base64_decode($image));
        $mime = mime_content_type(public_path() . '/storage/adverts/' . $imageName);
        $type = '';
        $thumbnail = $imageName;

        $type = 'image';

        return $imageName;
    }

}
