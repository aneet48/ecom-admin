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
            $imageName =time(). $imagePath->getClientOriginalName();

            $path = $request->file('image')->storeAs('products', $imageName, 'public');
            // dd($path);
        }

        $image = ProductImage::create([
            'name' => $imageName,
            'product_id' => $request->get('product'),
        ]);

        $msg = $image ? 'product updated successfully' : "product not Found";
        $error = $image ? false : true;
        $data=[
            'url'=>url('/storage/products/'.$imageName)
        ];

        return generate_response($error, $msg,$data);

    }
}
