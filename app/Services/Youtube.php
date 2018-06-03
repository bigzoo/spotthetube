<?php

namespace App\Services;
use Google_Client;


class Youtube implements Provider
{

    const OPTIONS = [
        'https://www.googleapis.com/auth/youtube'
    ];
    protected $client;

    public static function session()
    {
        return new Google_Client([
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => route('youtube.callback')
        ]);
    }

    public function account()
    {
        // TODO: Implement account() method.
    }

    public function name()
    {
        // TODO: Implement name() method.
    }

    public static function authUrl()
    {
        $client = static::session();
        $client->setScopes(Youtube::OPTIONS);
        return $client->createAuthUrl();
    }

    public static function authorize(string $code): array
    {
        return static::session()->fetchAccessTokenWithAuthCode($code);
    }
}