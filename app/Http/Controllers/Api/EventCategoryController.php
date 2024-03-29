<?php

namespace App\Http\Controllers\Api;

use App\EventCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of category
     */
    function list($show_all = false, $cat_id = 0) 
    {
        if (!$show_all) {
            $categories = EventCategory::with('children', 'parent')
                ->where(['active' => 1, 'parent_id' => $cat_id])
                ->orderBy('name')->paginate(15);
        } else {
            $categories = EventCategory::with('children', 'parent')->where('parent_id', $cat_id)->orderBy('name')->paginate(15);
        }
        $main_cat = EventCategory::with('parent')->find($cat_id);
        $body = [
            'categories' => $categories,
            'main_cat' => $main_cat,
        ];
        
        return response()->json($body);
    }

    public function eventCategory($id)
    {
        $category = EventCategory::with('children', 'parent')->find($id);
        return response()->json($category);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:event_categories,name,' . $id,
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }
        $slug = Str::slug($request->get('name'));

        $category = EventCategory::where('id', $id)->update([
            'parent_id' => $request->get('parent_id') ? $request->get('parent_id') : 0,
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
            'slug' => $slug,
        ]);
        $msg = $category ? 'Category updated successfully' : "Category not Found";
        $error = $category ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:event_categories',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }
        $slug = Str::slug($request->get('name'));

        $category = EventCategory::create([
            'parent_id' => $request->get('parent_id') ? $request->get('parent_id') : 0,
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
            'slug' => $slug,
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

        $category = EventCategory::where('id', $id)->delete();
        $msg = $category ? 'Category deleted successfully' : "Category not Found";
        $error = $category ? false : true;

        return generate_response($error, $msg);
    }

    public function search($q)
    {
        $result = EventCategory::with('children', 'parent')
            ->where('name', 'like', '%' . $q . '%')
            ->orwhere('slug', 'like', '%' . $q . '%')
            ->paginate(15);
        return response()->json($result);
    }
}
