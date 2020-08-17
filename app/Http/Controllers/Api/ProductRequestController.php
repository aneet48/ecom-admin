<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductRequest;
use App\ProductCategory;
use App\ProductMedia;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductRequestController extends Controller
{

    
    public function list(Request $request){

        $query = ProductRequest::with('category', 'user', 'user.connectycube_user', 'user.university', 'university');
        

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

        if ($request->has('user_id')) {
            $query = $query->where('user_id', $request->get('user_id'));
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
                    ->orwhere('type', 'LIKE', '%' . $s . '%')
                    ->orwhereHas('user', function ($query) use ($s) {
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

        $requests = $query->orderBy('id', 'DESC')->paginate($paginate);

        return response()->json($requests);
    }
    public function userlist(Request $request,$user_id){

        $query = ProductRequest::with('category', 'user', 'user.connectycube_user', 'user.university', 'university')->where('user_id',$user_id);       

       
        $paginate = $request->has('paginate') ? $request->get('paginate') : 12;

        $requests = $query->orderBy('id', 'DESC')->paginate($paginate);

        return response()->json($requests);
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
            'type' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $product = ProductRequest::where('id', $id)->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'university_id' => $request->get('university_id'),
            'type' => $request->get('type'),
            'time_period' => $request->get('time_period'),
        ]);
        

        $msg = $product ? 'product request updated successfully' : "product request not Found";
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
            'user_id' => 'required',
            'category_id' => 'required',
            'type' => 'required',
            'university_id' => 'required',
        ], $messages);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $product = ProductRequest::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id'),
            'user_id' => $request->get('user_id'),
            'university_id' => $request->get('university_id'),
            'type' => $request->get('type'),
            'time_period' => $request->get('time_period'),
        ]);

     
        $msg = $product ? 'product request created successfully' : "product request not Found";
        $error = $product ? false : true;
        $body = [
            'product' => $product,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $product = ProductRequest::where('id', $id)->delete();
        $msg = $product ? 'product request deleted successfully' : "product request not Found";
        $error = $product ? false : true;

        return generate_response($error, $msg);
    }
    public function request($id){

        $request = ProductRequest::with('category', 'user', 'user.connectycube_user', 'user.university', 'university')->find($id);

        return response()->json($request);
    }
}
