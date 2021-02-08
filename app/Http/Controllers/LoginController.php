<?php

namespace App\Http\Controllers;

use App\Mail\PostDeleted;
use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $title = 'test product';
        Mail::to('rajneetkaur1511@gmail.com')->send(new PostDeleted($user, $title, 'Product'));

        echo "test";
    }
    /*
       * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword()
    {
        return view('changePassword');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updtaePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        Auth::logout();
        return redirect('/');
    }
}
