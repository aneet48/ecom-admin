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
            FFMpeg::fromDisk('videos')
                ->open(public_path() . '/storage/products/' . $filename)
                ->getFrameFromSeconds(10)
                ->export()
                ->toDisk('thumnails')
                ->save( $thumbnail);
                dd( $thumbnail);

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
}
