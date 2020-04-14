<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->intended('dashboard');
        }

        return redirect()->back();

    }

    public function dashboard()
    {
        return view('dashboard');

    }
}
