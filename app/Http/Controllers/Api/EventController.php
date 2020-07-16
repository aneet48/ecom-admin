<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EventCategory;
use App\EventMedia;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function events(Request $request, $show_all = false)
    {
        $query = Event::with('category', 'images', 'university');
        if (!$show_all) {
            $query = $query->where('active', 1);
        }

        if ($request->has('category')) {
            $category = EventCategory::whereSlug($request->get('category'))->first();
            if ($category) {
                $query = $query->where('category_id', $category->id);

            }
        }

        if ($request->has('college')) {
            $college = $request->get('college');
            $query = $query->whereHas('university', function ($query) use ($college) {
                $query->where('name', 'LIKE', '%' . $college . '%');
                $query->orwhere('slug', 'LIKE', '%' . $college . '%');
            });
        }

        if ($request->has('s')) {
            $s = $request->get('s');
            $query = $query->where(function ($query) use ($s) {
                $query->where('title', 'LIKE', '%' . $s . '%')
                    ->orwhere('description', 'LIKE', '%' . $s . '%')
                    ->orwhere('price', 'LIKE', '%' . $s . '%')
                    ->orwhereHas('university', function ($query) use ($s) {
                        $query->where('name', 'LIKE', '%' . $s . '%');
                        $query->orwhere('slug', 'LIKE', '%' . $s . '%');

                    })
                    ->orwhereHas('category', function ($query) use ($s) {
                        $query->where('name', 'LIKE', '%' . $s . '%');
                    });
            });

        }
        $paginate = $request->has('paginate') ? $request->get('paginate') : 12;

        $events = $query->orderBy('id', 'DESC')->paginate($paginate);

        return response()->json($events);
    }

    public function event($id)
    {
        $event = Event::with('category', 'images', 'university')->find($id);
        $event->images->map(function ($item) {
            $path = public_path() . '/storage/events/' . $item->name;
            $mime = mime_content_type($path);
            $image = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
            $item->base64_data = $image;
            
            return $item;
        });

        return response()->json($event);

    }

    public function update(Request $request, $id)
    {
        $messages = [
            'university_id.required' => 'The college is required',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required',
            'university_id' => 'required',
            'price' => 'required',
            'event_date' => 'required',
            'event_time' => 'required',
            'contact_number' => 'required',
            'social_profiles'=> 'required',
            'book_event_link' => 'required',
            'visit_website_link' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $event = Event::where('id', $id)->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'university_id' => $request->get('university_id'),
            'price' => $request->get('price'),
            'event_date' => $request->get('event_date'),
            'event_time' => $request->get('event_time'),
            'contact_number' => $request->get('contact_number'),
            'social_profiles'=> json_encode($request->get('social_profiles')),
            'book_event_link' => $request->get('book_event_link'),
            'visit_website_link' => $request->get('visit_website_link'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        if ($event && $request->has('files')) {
            EventMedia::where('event_id', $id)->delete();
            $files = $request->get('files');
            foreach ($files as $key => $file) {
                EventMedia::saveBase64Media($file, $id);
            }
        }

        $msg = $event ? 'Event updated successfully' : "Event not Found";
        $error = $event ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {
        $messages = [
            'university_id.required' => 'The college is required',
        ];

        $validator = Validator::make($request->all(), [
            'title'         => 'required|string',
            'description'   => 'required|string',
            'category_id'   => 'required',
            'university_id' => 'required',
            'price'         => 'required',
            'event_date'    => 'required',
            'event_time'    => 'required',
            'contact_number'=> 'required',
            'book_event_link'=> 'required',
            'visit_website_link' => 'required',
            'social_profiles'=> 'required',
        ], $messages);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $event = Event::create([
            'title'         => $request->get('title'),
            'description'   => $request->get('description'),
            'category_id'   => $request->get('category_id'),
            'university_id' => $request->get('university_id'),
            'price'         => $request->get('price'),
            'event_date'    => $request->get('event_date'),
            'event_time'    => $request->get('event_time'),
            'contact_number'=> $request->get('contact_number'),
            'social_profiles'=> $request->get('social_profiles'),
            'book_event_link'=> $request->get('book_event_link'),
            'visit_website_link' => $request->get('visit_website_link'),
            'active'        => $request->has('active') ? $request->get('active') : false,
        ]);

        if ($event && $request->has('files')) {
            $files = $request->get('files');
            foreach ($files as $key => $file) {
                EventMedia::saveBase64Media($file, $event->id);
            }
        }
        $msg = $event ? 'Event created successfully' : "Event not Found";
        $error = $event ? false : true;
        $body = [
            'event' => $event,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $event = Event::where('id', $id)->delete();
        $msg = $event ? 'Event deleted successfully' : "Event not Found";
        $error = $event ? false : true;

        return generate_response($error, $msg);
    }
}
