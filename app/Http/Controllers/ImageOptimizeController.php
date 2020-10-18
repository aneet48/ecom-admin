<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageOptimizeController extends Controller
{
    public function resize(Request $request, $height, $width, $original_url)
    {
        $app_url = config('app.url');
        $file_path = str_replace($app_url, '', $original_url);
        $extension ='fdf';
        // $extension = pathinfo($file_path, PATHINFO_EXTENSION);
        if ($request->get($height) == 'test') {
            dd($height, $width, $original_url, $app_url, $file_path, $extension);

        }

        try {
            $img = Image::make(public_path($file_path))->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            return $img->response('jpg');

        } catch (\Throwable $th) {
            $img = Image::canvas($width, $height, '#e5dfdf');

            return $img->response('png');

        }

    }
}