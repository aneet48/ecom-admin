<?php

namespace App\Http\Controllers\Api;

use App\ConnectyCube;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

        $user = User::with('university', 'connectycube_user')->where('email', $request->get('email'))->first();

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
            'university_id.required' => 'The college is required',
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

        if ($user) {
            $c_user = [
                'email' => $user->email,
                'password' => ConnectyCube::generatePassword(),
                'external_user_id' => $user->id
            ];

            ConnectyCube::signUp($c_user);
            $user = User::with('university', 'connectycube_user')->where('id', $user->id)->first();

        }
        $user->makeVisible(['api_token']);
        $body = [
            'user' => $user,
        ];
        $msg = "User is created successfully";



        // Mail::send([], [], function ($message) use ($request, $password) {
        //     $message->to($request->get('email'))
        //         ->subject('Sign up complete')
        //     // here comes what you want
        //     // ->setBody('Hi, welcome user!') // assuming text/plain
        //     // or:
        //         ->setBody('<h1>Hi, welcome ' . $request->get('first_name') . '!</h1><p>An account has been created for you.</p>
        //         <p>Password:' . $password . '</p>
        //         ', 'text/html'); // for HTML rich messages
        // });

        return generate_response(false, $msg, $body);
    }

    public function simpleSignUp(Request $request)
    {
        $messages = [
            'required' => 'The :attribute is required',
            'string' => 'The :attribute must be text format',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users',
            'password' => 'required|min:8',

        ], $messages);
        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }
        $token = Str::random(60);
        $password = $request->get('password') ?: Str::random(8);
        $user = User::create([
            "email" => $request->get('email'),
            "password" =>   $password,
            "google_id"=> $request->get('google_id'),
            'api_token' => hash('sha256', $token),
        ]);

        if ($user) {

            $c_user = [
                'email' => $user->email,
                'password' => ConnectyCube::generatePassword(),
                'external_user_id' => $user->id
            ];

            ConnectyCube::signUp($c_user);
            $user = User::with('university', 'connectycube_user')->where('id', $user->id)->first();
        }
        $user->makeVisible(['api_token']);
        $body = [
            'user' => $user,
        ];
        $msg = "User is created successfully";



        // Mail::send([], [], function ($message) use ($request, $password) {
        //     $message->to($request->get('email'))
        //         ->subject('Sign up complete')
        //     // here comes what you want
        //     // ->setBody('Hi, welcome user!') // assuming text/plain
        //     // or:
        //         ->setBody('<h1>Hi, welcome ' . $request->get('first_name') . '!</h1><p>An account has been created for you.</p>
        //         <p>Password:' . $password . '</p>
        //         ', 'text/html'); // for HTML rich messages
        // });

        return generate_response(false, $msg, $body);
    }


    public function update(Request $request, $id)
    {
        $messages = [
            'university_id.required' => 'The college is required',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'branch' => 'required|string',
            'university_id' => 'required',
            // 'city_id' => 'required',
            'email' => 'required|unique:users,email,' . $id,

        ], $messages);
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
            'is_complete'=>true
        ]);
        $user = User::with('university', 'connectycube_user')->find($id);

        $user->makeVisible(['api_token']);

        $body = [
            'user' => $user,
        ];
        $msg = "User is updated successfully";

        return generate_response(false, $msg, $body);
    }

    public function users()
    {
        $users = User::with('university')->where('is_admin', 0)->paginate(15);
        return response()->json($users);
    }

    public function user($id)
    {
        $user = User::with('university', 'university.city', 'university.city.state', 'connectycube_user')->whereId($id)->where('is_admin', 0)->first();
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
            ->paginate(15);
        return response()->json($result);
    }

    public function profileImgUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            'img' => 'required',
        ]);
        $error = 'Oops!! there was some problem while updating. ';

        if ($validator->fails()) {

            return generate_response(true, $error);
        }

        $user = User::where('api_token', $request->get('api_token'))->first();
        if (!$user) {
            return generate_response(true, $error);
        }

        $image_64 = $request->get('img'); //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = 'profile_img' . Str::random(5) . time() . '.' . $extension;
        $data = Storage::disk('profile_img')->put($imageName, base64_decode($image));
        if ($data) {
            $user->profile_img = $imageName;
            $user->save();
            $user->makeVisible(['api_token']);

            $body = [
                'user' => $user,
            ];

            return generate_response(false, '', $body);
        }

        return generate_response(true, $error);
    }

    public function test()
    {
        ConnectyCube::getSessionToken();
        // $client = new \GuzzleHttp\Client();
        // $url = "https://api.connectycube.com/session";
        // $timestamp = Carbon::now()->timestamp;
        // $nonce = Str::random(16);
        // $arr = [
        //     'application_id=' . env('CONNECTYCUBE_APP_ID'),
        //     'auth_key=' . env('CONNECTYCUBE_APP_KEY'),
        //     'nonce=' .  $nonce,
        //     'timestamp=' . $timestamp
        // ];
        // $signature =  implode('&', $arr);

        // $response = Http::post($url, [
        //     'application_id' => env('CONNECTYCUBE_APP_ID'),
        //     'auth_key' => env('CONNECTYCUBE_APP_KEY'),
        //     'timestamp' =>  $timestamp,
        //     'nonce' => $nonce,
        //     'signature' => hash_hmac('sha1', $signature, env('CONNECTYCUBE_APP_SECRET'))
        // ]);
        // 86a3167672a5f10b478951f12dd4e9c478000ad1

        // $url = "https://api.connectycube.com/users";


        // $response = Http::withHeaders([
        //     'CB-Token' => '86a3167672a5f10b478951f12dd4e9c478000ad1'
        // ])->post($url, [
        //     'user' => [
        //         'email' => 'test@test.com',
        //         'password' => '12345678',
        //         'external_user_id' => 11
        //     ]
        //     ]);



        // dd($response->json());
    }
}
