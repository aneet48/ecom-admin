<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductMedia;
use FFMpeg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductMediaController extends Controller
{
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'product' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        // dd($request->get('product'));

        $imagePath = $request->file('image');
        $filename = rand(10, 1000) . time() . $imagePath->getClientOriginalName();
        $path = $request->file('image')->storeAs('products', $filename, 'public');
        $mime = mime_content_type(public_path() . '/storage/products/' . $filename);
        $type = '';
        $thumbnail = $filename;
        if (strstr($mime, "video/")) {
            $thumbnail = rand(1000, 10000) . '_' . time() . '.png';
            // dd(base_path());
            FFMpeg::fromDisk('products')
                ->open($filename)
                ->getFrameFromSeconds(1)
                ->export()
                ->toDisk('products')
                ->save($thumbnail);
            // FFMpeg::fromDisk('public')
            //     ->open('/products/' . $filename)
            //     ->getFrameFromSeconds(5)
            //     ->export()
            //     ->toDisk('public')
            //     ->save('/products/' .$thumbnail);
            // dd($thumbnail);

            $type = 'video';
            // this code for video
        } else if (strstr($mime, "image/")) {
            $type = 'image';

        }

        $image = ProductMedia::create([
            'name' => $filename,
            'type' => $type,
            'thumbnail' => $thumbnail,
            'product_id' => $request->get('product'),
        ]);

        $msg = $image ? 'product updated successfully' : "product not Found";
        $error = $image ? false : true;
        $data = [
            'url' => url('/storage/products/' . $filename),
        ];

        return generate_response($error, $msg, $data);

    }

    public function delete($id)
    {

        $product = ProductMedia::where('id', $id)->delete();
        $msg = $product ? 'product image deleted successfully' : "product image not Found";
        $error = $product ? false : true;

        return generate_response($error, $msg);
    }

    public function productMedias($product_id)
    {
        $images = ProductMedia::where('product_id', $product_id)->get();
        return response()->json($images);

    }
    
    public function productMediasBase64(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            'img' => 'required',
            'product_id' => 'required',
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

        $imageName = 'products' . Str::random(5) . time() . '.' . $extension;
        $data = Storage::disk('products')->put($imageName, base64_decode($image));
        $mime = mime_content_type(public_path() . '/storage/products/' . $imageName);
        $type = '';
        $thumbnail = $imageName;
        if (strstr($mime, "video/")) {
            $thumbnail = rand(1000, 10000) . '_' . time() . '.png';
            // dd(base_path());
            FFMpeg::fromDisk('products')
                ->open($imageName)
                ->getFrameFromSeconds(1)
                ->export()
                ->toDisk('products')
                ->save($thumbnail);
            // FFMpeg::fromDisk('public')
            //     ->open('/products/' . $imageName)
            //     ->getFrameFromSeconds(5)
            //     ->export()
            //     ->toDisk('public')
            //     ->save('/products/' .$thumbnail);
            // dd($thumbnail);

            $type = 'video';
            // this code for video
        } else if (strstr($mime, "image/")) {
            $type = 'image';

        }

        $image = ProductMedia::create([
            'name' => $imageName,
            'type' => $type,
            'thumbnail' => $thumbnail,
            'product_id' => $request->get('product'),
        ]);

        $msg = $image ? 'product updated successfully' : "product not Found";
        $error = $image ? false : true;
        $data = [
            'url' => url('/storage/products/' . $imageName),
        ];

        return generate_response($error, $msg, $data);

    }
}
