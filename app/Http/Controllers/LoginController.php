<?php

namespace App\Http\Controllers;

use App\Mail\NewUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials + ["is_admin" => true])) {
            $token = Str::random(60);

            $user = Auth::user();
            $user->api_token = hash('sha256', $token);
            $user->save();

            return redirect('/#/login-redirect');
        }

        return redirect()->back();

    }

    public function dashboard()
    {
        return view('dashboard');

    }

    public function authUser()
    {
        $user = Auth::user();
        $user = User::find($user->id);
        $user->makeVisible(['api_token']);

        return response()->json($user);
    }

    public function logout()
    {
        $user = Auth::logout();
        return response()->json($user);

    }

    public function emailTest(Request $request)
    {
        $user = User::find(1);
        Mail::to('test@test.com')->send(new NewUser( $user));

        echo "test";
    }
}
