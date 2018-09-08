<?php

namespace App\Services;

use App\Token as Access;
use SpotifyWebAPI\Session as SpotifySession;
use SpotifyWebAPI\SpotifyWebAPI as Api;

class Spotify implements Provider
{

    const OPTIONS = [
        'scope' => [
            'playlist-read-private',
            'playlist-modify-public',
            'playlist-modify-private',
            'playlist-read-collaborative'
        ],
    ];
    protected $client;

    public function __construct($token)
    {
        $access_token = Access::where([
            ['session_token', $token],
            ['provider', Access::SPOTIFY_PROVIDER]
        ])
            ->get()
            ->first()
            ->access_token;
        $this->client = new Api();
        $this->client->setAccessToken($access_token);
    }

    public static function session()
    {
        return new SpotifySession(
            env('SPOTIFY_CLIENT_ID'),
            env('SPOTIFY_CLIENT_SECRET'),
            route('spotify.callback')
        );
    }

    public function account()
    {
        return $this->client->me();
    }

    public function name()
    {
        return $this->client->me()->display_name;
    }

    public static function authUrl()
    {
        return static::session()->getAuthorizeUrl(Spotify::OPTIONS);
    }

    public static function authorize(string $code): array
    {
        $session = static::session();
        $session->requestAccessToken($code);
        return [
            'access_token' => $session->getAccessToken(),
            'refresh_token' => $session->getRefreshToken()
        ];
    }

    public function revoke(): void
    {
        // TODO: Implement revoke() method.
    }
}