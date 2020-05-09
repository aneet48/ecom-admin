<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductImageController extends Controller
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

        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = time() . $imagePath->getClientOriginalName();

            $path = $request->file('image')->storeAs('products', $imageName, 'public');
            // dd($path);
        }

        $image = ProductImage::create([
            'name' => $imageName,
            'product_id' => $request->get('product'),
        ]);

        $msg = $image ? 'product updated successfully' : "product not Found";
        $error = $image ? false : true;
        $data = [
            'url' => url('/storage/products/' . $imageName),
        ];

        return generate_response($error, $msg, $data);

    }

    public function delete($id)
    {

        $product = ProductImage::where('id', $id)->delete();
        $msg = $product ? 'product image deleted successfully' : "product image not Found";
        $error = $product ? false : true;

        return generate_response($error, $msg);
    }


    public function productImages($product_id)
    {
        $images = ProductImage::where('product_id',$product_id)->get();
        return response()->json($images);


    }
}
