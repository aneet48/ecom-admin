<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function list($show_all = false)
    {
        if (!$show_all) {
            $cities = ProductCategory::with('children','parent')->where('active', 1)->orderBy('name')->paginate(15);
        } else {
            $cities = ProductCategory::with('children','parent')->orderBy('name')->paginate(15);

        }
        return response()->json($cities);
    }

    public function productCategory($id)
    {
        $category = ProductCategory::find($id);
        return response()->json($category);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:product_categories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $category = ProductCategory::where('id', $id)->update([
            'parent_id' => $request->get('parent_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $category ? 'Category updated successfully' : "Category not Found";
        $error = $category ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:product_categories',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $category = ProductCategory::create([
            'parent_id' => $request->get('parent_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $category ? 'Category created successfully' : "Category not Found";
        $error = $category ? false : true;
        $body = [
            'category' => $category,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $category = ProductCategory::where('id', $id)->delete();
        $msg = $category ? 'Category deleted successfully' : "Category not Found";
        $error = $category ? false : true;

        return generate_response($error, $msg);
    }

    public function search($q)
    {
        $result = ProductCategory::where('name', 'like', '%' . $q . '%')->paginate(30);
        return response()->json($result);
    }
}
