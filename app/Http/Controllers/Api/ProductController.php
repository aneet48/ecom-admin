<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function products(Request $request, $show_all = false)
    {
        // if (!$show_all) {
        //     $products = Product::with('category','images')->where('active', 1)->orderBy('id', 'DESC')->paginate(20);
        // } else {
        //     $products = Product::with('category','images')->orderBy('id', 'DESC')->paginate(20);

        // }
        $query = Product::with('category', 'images');
        if (!$show_all) {
            $query = $query->where('active', 1);
        }

        if ($request->get('s')) {
            $s = $request->get('s');
            $query = $query->where(function ($query) use ($s) {
                $query->where('title', 'LIKE', '%' . $s . '%')
                    ->orwhere('description', 'LIKE', '%' . $s . '%')
                    ->orwhere('price', 'LIKE', '%' . $s . '%')
                    ->orwhere('type', 'LIKE', '%' . $s . '%');
            });

        }

        $products = $query->orderBy('id', 'DESC')->paginate(20);

        return response()->json($products);
    }

    public function product($id)
    {
        $product = Product::find($id);
        return response()->json($product);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $product = Product::where('id', $id)->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'seller_id' => $request->get('seller_id'),
            'category_id' => $request->get('category_id'),
            'type' => $request->get('type'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $product ? 'product updated successfully' : "product not Found";
        $error = $product ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $product = Product::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'price' => $request->get('price'),
            'seller_id' => $request->get('seller_id'),
            'category_id' => $request->get('category_id'),
            'type' => $request->get('type'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $product ? 'product created successfully' : "product not Found";
        $error = $product ? false : true;
        $body = [
            'product' => $product,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $product = Product::where('id', $id)->delete();
        $msg = $product ? 'product deleted successfully' : "product not Found";
        $error = $product ? false : true;

        return generate_response($error, $msg);
    }
}
