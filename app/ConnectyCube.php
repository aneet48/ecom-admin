<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ConnectyCube extends Model
{
    protected $fillable = [
        'email',
        'password',
        'user_id'
    ];

    public static function createSession()
    {

        $url = config('connectycube.api_url') . 'session';
        $timestamp = Carbon::now()->timestamp;
        $nonce = Str::random(16);
        $arr = [
            'application_id=' . config('connectycube.api_id'),
            'auth_key=' . config('connectycube.api_key'),
            'nonce=' .  $nonce,
            'timestamp=' . $timestamp
        ];
        $signature =  implode('&', $arr);

        $response = Http::post($url, [
            'application_id' => env('CONNECTYCUBE_APP_ID'),
            'auth_key' => env('CONNECTYCUBE_APP_KEY'),
            'timestamp' =>  $timestamp,
            'nonce' => $nonce,
            'signature' => hash_hmac('sha1', $signature, config('connectycube.api_secret'))
        ]);

        $response = $response->json();
        $token = isset($response['session']) && $response['session'] && $response['session']['token'] ? $response['session']['token'] : '';
        return $token;
    }

    public static function getSessionToken()
    {
        $value = Session::get(config('connectycube.session_token'));
        $expiry = Session::get(config('connectycube.session_token_expiry'));

        if (!$value || !$expiry || $expiry <= strtotime('-2 hours')) {
            $value = self::createSession();
            $expiry = Carbon::now()->timestamp;
            Session::put(config('connectycube.session_token'),  $value);
            Session::put(config('connectycube.session_token_expiry'), $expiry);
        }
        return $value;
    }


    public static function signUp($user)
    {
        $url = config('connectycube.api_url') . 'users';
        $session_token = self::getSessionToken();

        $response = Http::withHeaders([
            'CB-Token' => $session_token
        ])->post($url, [
            'user' => $user
        ]);
        $response = $response->json();
        if (isset($response['user'])) {
            ConnectyCube::create([
                'email' => $user['email'],
                'password' => $user['password'],
                'user_id' => $user['external_user_id'],
            ]);
        }

        return $response;
    }

    public static function generatePassword()
    {
        return config('connectycube.user_pass_initials') . Str::random(5);
    }
}
