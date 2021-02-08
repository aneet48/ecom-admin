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
        'user_id',
        'connectycube_id',
    ];

    public static function createSession()
    {

        $url = config('connectycube.api_url') . 'session';
        $timestamp = Carbon::now()->timestamp;
        $nonce = Str::random(16);
        $arr = [
            'application_id=' . config('connectycube.api_id'),
            'auth_key=' . config('connectycube.api_key'),
            'nonce=' . $nonce,
            'timestamp=' . $timestamp,
        ];
        $signature = implode('&', $arr);

        $response = Http::post($url, [
            'application_id' => env('CONNECTYCUBE_APP_ID'),
            'auth_key' => env('CONNECTYCUBE_APP_KEY'),
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'signature' => hash_hmac('sha1', $signature, config('connectycube.api_secret')),
        ]);

        $response = $response->json();
        $token = isset($response['session']) && $response['session'] && $response['session']['token'] ? $response['session']['token'] : '';
        return $token;
    }
    public static function createUserSession($user)
    {

        $url = config('connectycube.api_url') . 'session';
        $timestamp = Carbon::now()->timestamp;
        $nonce = Str::random(16);

        $arr = [
            'application_id=' . config('connectycube.api_id'),
            'auth_key=' . config('connectycube.api_key'),
            'nonce=' . $nonce,
            'timestamp=' . $timestamp,
            'user[email]=' . $user->email,
            'user[password]=' . $user->password,
        ];

        $signature = implode('&', $arr);

        $response = Http::post($url, [
            'application_id' => env('CONNECTYCUBE_APP_ID'),
            'auth_key' => env('CONNECTYCUBE_APP_KEY'),
            'timestamp' => $timestamp,
            'nonce' => $nonce,
            'signature' => hash_hmac('sha1', $signature, config('connectycube.api_secret')),
            'user' => [
                'email' => $user->email,
                'password' => $user->password,
            ],
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
            Session::put(config('connectycube.session_token'), $value);
            Session::put(config('connectycube.session_token_expiry'), $expiry);
        }
        return $value;
    }

    public static function signUp($user)
    {
        $url = config('connectycube.api_url') . 'users';
        $session_token = self::getSessionToken();

        $response = Http::withHeaders([
            'CB-Token' => $session_token,
        ])->post($url, [
            'user' => $user,
        ]);
        $response = $response->json();
        if (isset($response['user'])) {
            ConnectyCube::create([
                'email' => $user['email'],
                'password' => $user['password'],
                'user_id' => $user['external_user_id'],
                'connectycube_id' => $response['user']['id'],
            ]);
        }

        return $response;
    }

    public static function remove($user)
    {
        $url = config('connectycube.api_url') . 'users/' . $user['connectycube_id'];
        $session_token  = self::createUserSession($user);

        $response = Http::withHeaders([
            'CB-Token' => $session_token,
        ])->delete($url);
        $response = $response->json();

        return $response;
    }

    public static function generatePassword()
    {
        return config('connectycube.user_pass_initials') . Str::random(5);
    }

    public static function createDialog($occupants_ids, $user, $name)
    {
        $url = config('connectycube.api_url') . 'chat/Dialog';
        $token = self::createUserSession($user);

        $response = Http::withHeaders([
            'CB-Token' => $token,
        ])->post($url, [
            'type' => 2,
            'occupants_ids' => $occupants_ids,
            'name' => $name,
        ]);
        $response = $response->json();
        $dialog_id = isset($response['_id']) && $response['_id'] ? $response['_id'] : '';
        $xmpp_room_jid = isset($response['xmpp_room_jid']) && $response['xmpp_room_jid'] ? $response['xmpp_room_jid'] : '';
        $data = [
            'xmpp_room_jid' => $xmpp_room_jid,
            'dialog_id' => $dialog_id,
        ];
        return $data;
    }
}
