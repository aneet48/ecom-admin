<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UniversityController extends Controller
{
    public function universities($show_all = false)
    {
        if (!$show_all) {
            $universities = University::with('city')->where('active', 1)->orderBy('name')->paginate(15);
        } else {
            $universities = University::with('city')->orderBy('name')->paginate(15);

        }
        return response()->json($universities);
    }

    public function university($id)
    {
        $university = University::find($id);
        return response()->json($university);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:states,name,' . $id,
            'city_id' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $university = University::where('id', $id)->update([
            'city_id' => $request->get('city_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
            'slug' => Str::slug($request->get('name')),

        ]);
        $msg = $university ? 'University updated successfully' : "University not Found";
        $error = $university ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:states',
            'city_id' => 'required',

        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $university = University::create([
            'city_id' => $request->get('city_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
             'slug' => Str::slug($request->get('name')),
        ]);
        $msg = $university ? 'University created successfully' : "University not Found";
        $error = $university ? false : true;
        $body = [
            'university' => $university,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $university = University::where('id', $id)->delete();
        $msg = $university ? 'University deleted successfully' : "University not Found";
        $error = $university ? false : true;

        return generate_response($error, $msg);
    }

    public function search($q)
    {
        $result = University::with('city', 'city.state')->where('name', 'like', '%' . $q . '%')->paginate(30);
        return response()->json($result);
    }

    public function searchGlobal($q)
    {
        $result = University::with('city', 'city.state')
            ->where('name', 'like', '%' . $q . '%')
            ->where('active', '!=', 0)
            ->take(30)->get();
        return response()->json($result);
    }
}
