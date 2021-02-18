<?php

namespace App\Http\Controllers\Api;

use App\EventMedia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FFMpeg;
use Illuminate\Support\Facades\Validator;

class EventMediaController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'event' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        // dd($request->get('event'));

        $imagePath = $request->file('image');
        $filename = rand(10, 1000) . time() . $imagePath->getClientOriginalName();
        $path = $request->file('image')->storeAs('events', $filename, 'public');
        $mime = mime_content_type(public_path() . '/storage/events/' . $filename);
        $type = '';
        $thumbnail = $filename;
        if (strstr($mime, "video/")) {
            $thumbnail = rand(1000, 10000) . '_' . time() . '.png';
            // dd(base_path());
            FFMpeg::fromDisk('events')
                ->open($filename)
                ->getFrameFromSeconds(1)
                ->export()
                ->toDisk('events')
                ->save($thumbnail);
            // FFMpeg::fromDisk('public')
            //     ->open('/events/' . $filename)
            //     ->getFrameFromSeconds(5)
            //     ->export()
            //     ->toDisk('public')
            //     ->save('/events/' .$thumbnail);
            // dd($thumbnail);

            $type = 'video';
            // this code for video
        } else if (strstr($mime, "image/")) {
            $type = 'image';

        }

        $image = EventMedia::create([
            'name' => $filename,
            'type' => $type,
            'thumbnail' => $thumbnail,
            'event_id' => $request->get('event'),
        ]);

        $msg = $image ? 'Event updated successfully' : "Event not Found";
        $error = $image ? false : true;
        $data = [
            'url' => url('/storage/events/' . $filename),
        ];

        return generate_response($error, $msg, $data);

    }

    public function delete($id)
    {

        $event = EventMedia::where('id', $id)->delete();
        $msg = $event ? 'Event image deleted successfully' : "Event image not Found";
        $error = $event ? false : true;

        return generate_response($error, $msg);
    }

    public function eventMedias($event_id)
    {
        $images = EventMedia::where('event_id', $event_id)->get();
        return response()->json($images);

    }
    
    public function eventMediasBase64(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            'img' => 'required',
            'event_id' => 'required',
        ]);
        $error = 'Oops!! there was some problem while updating. ';

        if ($validator->fails()) {

            return generate_response(true,$validator->errors()->all());
        }

        $user = User::where('api_token', $request->get('api_token'))->first();
        if (!$user) {
            return generate_response(true, $error);
        }

        $image_64 = $request->get('img'); //your base64 encoded data

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
            // FFMpeg::fromDisk('public')
            //     ->open('/events/' . $imageName)
            //     ->getFrameFromSeconds(5)
            //     ->export()
            //     ->toDisk('public')
            //     ->save('/events/' .$thumbnail);
            // dd($thumbnail);

            $type = 'video';
            // this code for video
        } else if (strstr($mime, "image/")) {
            $type = 'image';

        }

        $image = EventMedia::create([
            'name' => $imageName,
            'type' => $type,
            'thumbnail' => $thumbnail,
            'event_id' => $request->get('event'),
        ]);

        $msg = $image ? 'Event updated successfully' : "Event not Found";
        $error = $image ? false : true;
        $data = [
            'url' => url('/storage/events/' . $imageName),
        ];

        return generate_response($error, $msg, $data);

    }
}
