<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function signUp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'branch' => 'required',
            'university_id' => 'required',
            // 'city_id' => 'required',
            'email' => 'required|unique:users',

        ]);
        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $password = '123456';
        $user = User::create([
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "phone_number" => $request->get('phone_number'),
            "branch" => $request->get('branch'),
            "university_id" => $request->get('university_id'),
            "email" => $request->get('email'),
            "password" => Hash::make($password),
        ]);
        $body = [
            'user' => $user,
        ];
        $msg = "User is created successfully";

        return generate_response(false, $msg, $body);

    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'branch' => 'required',
            'university_id' => 'required',
            // 'city_id' => 'required',
            'email' => 'required|unique:users,email,'.$id,

        ]);
        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $password = '123456';
        $user = User::where('id',$id)->update([
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "phone_number" => $request->get('phone_number'),
            "branch" => $request->get('branch'),
            "university_id" => $request->get('university_id'),
            "email" => $request->get('email'),
            // "password" => Hash::make($password),
        ]);
        $body = [
            'user' => $user,
        ];
        $msg = "User is created successfully";

        return generate_response(false, $msg, $body);

    }

    public function users()
    {
        $users = User::with('university')->where('is_admin',0)->paginate(20);
        return response()->json($users);
    }

    public function user($id)
    {
        $user = User::with('university','university.city','university.city.state')->whereId($id)->first();
        return response()->json($user);
    }

     public function delete($id)
    {

        $city = User::where('id', $id)->delete();
        $msg = $city ? 'User deleted successfully' : "User not Found";
        $error = $city ? false : true;

        return generate_response($error, $msg);
    }

    public function search($q)
    {
        $result = User::where('name','like','%'.$q.'%')->paginate(30);
        return response()->json($result);
    }
}
