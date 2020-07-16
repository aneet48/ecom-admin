<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class EventMedia extends Model
{
    protected $fillable = ['name', 'event_id', 'type', 'thumbnail'];
    protected $appends = ['link', 'thumbnail_link'];

    public function getLinkAttribute()
    {
        return url('storage/events/' . $this->name);
    }
    public function getBase64DataAttribute()
    {
        $path = public_path().'/storage/events/' . $this->name;
        $mime = mime_content_type( $path);
        $image = 'data:'. $mime.';base64,'.base64_encode(file_get_contents($path));

        return  $image;
    }

    public function getThumbnailLinkAttribute()
    {
        return url('storage/events/' . $this->thumbnail);
    }

    public static function saveBase64Media($data, $event_id)
    {
        $image_64 = $data; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = 'events' . Str::random(5) . time() . '.' . $extension;
        $data = Storage::disk('events')->put($imageName, base64_decode($image));
        $mime = mime_content_type(public_path() . '/storage/events/' . $imageName);
        $type = '';
        $thumbnail = $imageName;
        if (strstr($mime, "video/")) {
            $thumbnail = rand(1000, 10000) . '_' . time() . '.png';
            // dd(base_path());
            FFMpeg::fromDisk('events')
                ->open($imageName)
                ->getFrameFromSeconds(1)
                ->export()
                ->toDisk('events')
                ->save($thumbnail);

            $type = 'video';
            // this code for video
        } else if (strstr($mime, "image/")) {
            $type = 'image';

        }

        $image = EventMedia::create([
            'name' => $imageName,
            'type' => $type,
            'thumbnail' => $thumbnail,
            'event_id' => $event_id,
        ]);
        return $image;
    }

}
