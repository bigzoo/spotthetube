<?php

namespace App\Services;

use App\Music\Artist;
use App\Music\Image;
use App\Music\Playlist;
use App\Music\Track;
use App\Token as Access;
use Illuminate\Support\Collection;
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

    public function playlist(string $link): Playlist
    {
        $explodedLink = explode('/', $link);
        $userId = $explodedLink[4];
        $playlistId = $explodedLink[6];
        $playlist = $this->client->getUserPlaylist($userId, $playlistId);
        $image = new Image($playlist->images[1]->url);
        $tracks = collect($playlist->tracks->items)->map(function ($track){
            $track = $track->track;
            $artists = $this->getArtists($track);
            return new Track($track->name, $track->preview_url, $artists);
        });
        return new Playlist($link, $playlist->name, $playlist->description, $playlist->owner->display_name
            , $playlist->tracks->total, $image, $tracks);
    }

    private function getArtists($track) : Collection
    {
        return collect($track->artists)->map(function ($artist){
            return new Artist($artist->name);
        });
    }
}