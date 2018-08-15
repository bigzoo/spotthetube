<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    const SPOTIFY_PROVIDER = 'spotify';
    const YOUTUBE_PROVIDER = 'youtube';
    protected $fillable = ['access_token', 'refresh_token', 'provider', 'session_token'];

    public static function updateAccess($provider, $session, $access, $refresh = '')
    {
        static::updateOrCreate([
            ['session_token', $session],
            ['provider', $provider],
        ],[
            'provider' => $provider,
            'session_token' => $session,
            'access_token' => $access,
            'refresh_token' => $refresh
        ]);
    }
}
