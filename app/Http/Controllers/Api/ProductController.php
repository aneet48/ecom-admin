<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductCategory;
use App\ProductMedia;
use App\University;
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
        $query = Product::with('category', 'seller', 'seller.connectycube_user', 'seller.university', 'images', 'university');
        $university = '';
        $city = '';
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
        if ($request->has('m_cat') && $request->get('m_cat')) {
            $category = ProductCategory::wherein('name', explode(',', $request->get('m_cat')))->pluck('id');
            if ($category) {
                $query = $query->wherein('category_id', $category);
            }
        }
        if ($request->has('m_uni') && $request->get('m_uni')) {
            $university = University::wherein('name', explode(',', $request->get('m_uni')))->pluck('id');
            
            if ($university) {
                $query = $query->where(function ($query) use ($university) {
                    $query->orwherein('university_id', $university);
                });
            }
        }
        if ($request->has('m_city') && $request->get('m_city')) {
            $city = City::wherein('name', explode(',', $request->get('m_city')))->pluck('id');
            if ($city) {
                // $query = $query->where(function ($query) use ($city) {
                $query = $query->orwhereHas('university', function ($query) use ($city) {
                    $query->wherein('city_id', $city);
                });
                // });
            }
        }
        if ($request->has('cat_title')) {
            $category = ProductCategory::whereName($request->get('cat_title'))->first();
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
                        $query->orwhere('slug', 'LIKE', '%' . $s . '%');
                    })

                    ->orwhereHas('category', function ($query) use ($s) {
                        $query->where('name', 'LIKE', '%' . $s . '%');
                    });
            });
        }
        $paginate = $request->has('paginate') ? $request->get('paginate') : 12;

        $products = $query->orderBy('id', 'DESC')->paginate($paginate);
        if (!count($products) && $request->has('m_uni') && !$request->has('m_city')) {
            $city_ids = University::wherein('name', explode(',', $request->get('m_uni')))->pluck('city_id');
        //    dd($city_ids);

            if (count($city_ids)) {

                // $query = $query->where(function ($query) use ($city) {
                $query = $query->orwhereHas('university', function ($query) use ($city_ids) {
                    $query->wherein('city_id', $city_ids);
                });
                // });
            }
            $products = $query->orderBy('id', 'DESC')->paginate($paginate);


            // dd($query->tosql());
        }

        return response()->json($products);
    }

    public function product($id)
    {
        $product = Product::with('category', 'seller', 'seller.connectycube_user', 'seller.university', 'images', 'university')->find($id);
        $product->images->map(function ($item) {
            $path = public_path() . '/storage/products/' . $item->name;
            $mime = mime_content_type($path);
            $image = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
            $item->base64_data = $image;
            // return $image;

            // if ($item->type_id == $itemSpecial) {
            //     $item->discounted_price = ($item->discount * $item->price) / 100;
            // }
            return $item;
        });

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'university_id.required' => 'The college is required',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'university_id' => 'required',
            'type' => 'required',
        ], $messages);

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
            'time_period' => $request->get('time_period'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        if ($product && $request->has('files')) {
            ProductMedia::where('product_id', $id)->delete();
            $files = $request->get('files');
            foreach ($files as $key => $file) {
                ProductMedia::saveBase64Media($file, $id);
            }
        }

        $msg = $product ? 'product updated successfully' : "product not Found";
        $error = $product ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {
        $messages = [
            'university_id.required' => 'The college is required',
        ];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
            'seller_id' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'university_id' => 'required',
        ], $messages);

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
            'time_period' => $request->get('time_period'),
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
