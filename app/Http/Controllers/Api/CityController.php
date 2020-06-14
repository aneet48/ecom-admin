<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{

    public function cities($show_all = false)
    {
        if (!$show_all) {
            $cities = City::with('state')->where('active', 1)->orderBy('name')->paginate(15);
        } else {
            $cities = City::with('state')->orderBy('name')->paginate(15);

        }
        return response()->json($cities);
    }

    public function city($id)
    {
        $city = City::with('state')->find($id);
        return response()->json($city);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            // 'code' => 'required|string|max:10|unique:cities,code,' . $id,
            // 'name' => 'required|string|unique:cities,name,' . $id,
            'name' => 'required|string|unique:states,name,' . $id,
            'state_id' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $city = City::where('id', $id)->update([
            'state_id' => $request->get('state_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $city ? 'City updated successfully' : "City not Found";
        $error = $city ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:states',
            'state_id' => 'required',

        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $city = City::create([
            'state_id' => $request->get('state_id'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $city ? 'City created successfully' : "City not Found";
        $error = $city ? false : true;
        $body = [
            'city' => $city,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $city = City::where('id', $id)->delete();
        $msg = $city ? 'City deleted successfully' : "City not Found";
        $error = $city ? false : true;

        return generate_response($error, $msg);
    }

    public function search($q)
    {
        $result = City::with('state')->where('name','like','%'.$q.'%')->paginate(15);
        return response()->json($result);
    }
}
