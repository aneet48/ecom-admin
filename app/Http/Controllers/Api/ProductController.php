<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\ProductMedia;
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
        $query = Product::with('category', 'seller', 'seller.university', 'images', 'university');
        if (!$show_all) {
            $query = $query->where('active', 1);
        }

        if ($request->has('type')) {
            $type = $request->get('type');
            $query = $query->where('type', $type);
        }

        if ($request->has('category')) {
            $category = ProductCategory::whereSlug($request->get('category'))->first();
            if ($category) {
                $query = $query->where('category_id', $category->id);

            }
        }

        if ($request->has('seller_id')) {
            $query = $query->where('seller_id', $request->get('seller_id'));
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
                    ->orwhere('type', 'LIKE', '%' . $s . '%')
                    ->orwhereHas('seller', function ($query) use ($s) {
                        $query->where('first_name', 'LIKE', '%' . $s . '%');
                        $query->orwhere('last_name', 'LIKE', '%' . $s . '%');
                        $query->orwhere('email', 'LIKE', '%' . $s . '%');
                        $query->orwhere('branch', 'LIKE', '%' . $s . '%');
                    })
                    ->orwhereHas('university', function ($query) use ($s) {
                        $query->where('name', 'LIKE', '%' . $s . '%');
                    })
                    ->orwhereHas('category', function ($query) use ($s) {
                        $query->where('name', 'LIKE', '%' . $s . '%');
                    });
            });

        }
        $paginate = $request->has('paginate') ? $request->get('paginate') : 20;

        $products = $query->orderBy('id', 'DESC')->paginate($paginate);

        return response()->json($products);
    }

    public function product($id)
    {
        $product = Product::with('category', 'seller', 'seller.university', 'images', 'university')->find($id);
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
            'university_id' => 'required',
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
            'university_id' => $request->get('university_id'),
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
            'university_id' => 'required',
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
            'university_id' => $request->get('university_id'),
            'type' => $request->get('type'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);

        if ($product && $request->has('files')) {
            $files = $request->get('files');
            foreach ($files as $key => $file) {
                ProductMedia::saveBase64Media($file, $product->id);
            }
        }
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
