<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    /**
     * list states
     */

    public function states($show_all = false)
    {
        if (!$show_all) {
            $states = State::where('active', 1)->orderBy('name')->get();
        } else {
            $states = State::orderBy('name')->get();

        }
        return response()->json($states);
    }

    public function state($id)
    {
        $state = State::find($id);
        return response()->json($state);

    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10|unique:states,code,' . $id,
            'name' => 'required|string|unique:states,name,' . $id,

        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $state = State::where('id', $id)->update([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $state ? 'State updated successfully' : "State not Found";
        $error = $state ? false : true;

        return generate_response($error, $msg);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code' => 'required|string|unique:states|max:10,',
            'name' => 'required|string|unique:states',

        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $state = State::create([
            'code' => $request->get('code'),
            'name' => $request->get('name'),
            'active' => $request->has('active') ? $request->get('active') : false,
        ]);
        $msg = $state ? 'State created successfully' : "State not Found";
        $error = $state ? false : true;
        $body = [
            'state' => $state,
        ];

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $state = State::where('id', $id)->delete();
        $msg = $state ? 'State deleted successfully' : "State not Found";
        $error = $state ? false : true;

        return generate_response($error, $msg);
    }
}
