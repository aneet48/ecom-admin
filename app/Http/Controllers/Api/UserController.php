<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $user = User::with('university')->where('email', $request->get('email'))->first();

        if ($user && !Hash::check($request->get('password'), $user->password)) {
            return generate_response(true, ['Credentials do not match']);
        }
        if ($user) {
            $user->makeVisible(['api_token']);
            $token = Str::random(60);
            $user->api_token = hash('sha256', $token);
            $user->save();

        }

        $body = [
            'user' => $user,
        ];
        $msg = $user ? 'User  Found' : ["User Not found"];
        $error = $user ? false : true;

        return generate_response($error, $msg, $body);
    }
    public function signUp(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required',
            'university_id.required' => 'The university is required',
            'string' => 'The :attribute must be text format',

        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'branch' => 'required',
            'university_id' => 'required',
            'email' => 'required|unique:users',

        ], $messages);
        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }
        $token = Str::random(60);

        $password = $request->get('password') ?: Str::random(8);
        $user = User::create([
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "phone_number" => $request->get('phone_number'),
            "branch" => $request->get('branch'),
            "university_id" => $request->get('university_id'),
            "email" => $request->get('email'),
            "password" => Hash::make($password),
            'api_token' => hash('sha256', $token),
        ]);
        $user->makeVisible(['api_token']);

        $body = [
            'user' => $user,
        ];
        $msg = "User is created successfully";

        Mail::send([], [], function ($message) use ($request, $password) {
            $message->to($request->get('email'))
                ->subject('Sign up complete')
            // here comes what you want
            // ->setBody('Hi, welcome user!') // assuming text/plain
            // or:
                ->setBody('<h1>Hi, welcome ' . $request->get('first_name') . '!</h1><p>An account has been created for you.</p>
                <p>Password:' . $password . '</p>
                ', 'text/html'); // for HTML rich messages
        });

        return generate_response(false, $msg, $body);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'branch' => 'required',
            'university_id' => 'required',
            // 'city_id' => 'required',
            'email' => 'required|unique:users,email,' . $id,

        ]);
        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $user = User::where('id', $id)->update([
            "first_name" => $request->get('first_name'),
            "last_name" => $request->get('last_name'),
            "phone_number" => $request->get('phone_number'),
            "branch" => $request->get('branch'),
            "university_id" => $request->get('university_id'),
            "email" => $request->get('email'),
        ]);
        $body = [
            'user' => $user,
        ];
        $msg = "User is created successfully";

        return generate_response(false, $msg, $body);
    }

    public function users()
    {
        $users = User::with('university')->where('is_admin', 0)->paginate(20);
        return response()->json($users);
    }

    public function user($id)
    {
        $user = User::with('university', 'university.city', 'university.city.state')->whereId($id)->first();
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
        $result = User::where('is_admin', 0)
            ->where(function ($query) use ($q) {
                $query->where('first_name', 'like', '%' . $q . '%')
                    ->orWhere('last_name', 'like', '%' . $q . '%')
                    ->orWhere('email', 'like', '%' . $q . '%');
            })
            ->paginate(30);
        return response()->json($result);
    }
}
