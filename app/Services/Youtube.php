<?php

namespace App\Services;
use Google_Client;
use App\Token as Access;

class Youtube implements Provider
{
    const OPTIONS = [
        'profile',
        'https://www.googleapis.com/auth/youtube'
    ];
    protected $client;
    protected $userData;

    public function __construct($token)
    {
        $auth = Access::where([
            ['session_token', $token],
            ['provider', Access::YOUTUBE_PROVIDER]
        ])
            ->get()
            ->first()
            ->access_token;
        $auth = json_decode($auth);
        $this->client = static::session();
        $this->client->setAccessToken($auth->access_token);
        $this->userData = $this->client->verifyIdToken($auth->id_token);
    }

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
        return $this->userData['name'];
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