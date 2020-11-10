<?php

namespace App\Http\Controllers\Api;

use App\Advert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function index()
    {
        $adverts = Advert::select('image','place','openlink')->get()->keyBy('place');
        return response()->json($adverts);
    }

    public function saveImage(Request $request)
    {
        $image = Advert::saveBase64Media($request->get('image'));
        $feedback = Advert::updateOrCreate([
            'place' => $request->get('place'),
        ], [
            'image' => $image,
            'openlink' => $request->get('openlink'),

        ]);
        $msg = $feedback ? 'Feedback created successfully' : "Something went wrong.";
        $error = $feedback ? false : true;

        $body = [
            'feedback' => $feedback,
        ];

        return generate_response($error, $msg, $body);

    }

    public function getAdd($place)
    {
        $error = true;
        $msg = 'Not found';
        $advert = Advert::where('place', $place)->first();
        $body = '';
        if ($advert) {

            $image = $advert->image;
            $path = url('/storage/adverts/' . $image);

            if (file_exists(public_path() . '/storage/adverts/' . $image)) {
                $error = false;
                $msg = 'found';
                $body = [
                    'image' => $path,
                    'openlink'=>$advert->openlink
                ];
            }
        }
        return generate_response($error, $msg, $body);

    }
}
