<?php

namespace App\Http\Controllers;

use App\Session;
use App\Token as Access;
use App\Services\Spotify;
use App\Services\Youtube;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function spotifyAuth()
    {
        return redirect(Spotify::authUrl());
    }

    public function youtubeAuth()
    {
        return redirect(Youtube::authUrl());
    }

    public function spotifyCallback(Request $request)
    {
        $code = $request->get('code');
        $token = $request->session()->get('user_token');
        $authorization = Spotify::authorize($code);
        Access::updateAccess(Access::SPOTIFY_PROVIDER, $token,
            $authorization['access_token'], $authorization['refresh_token']);
        return redirect()->route('home');
    }

    public function youtubeCallback(Request $request)
    {
        $code = $request->get('code');
        $token = $request->session()->get('user_token');
        $authorization = Youtube::authorize($code);
        Access::updateAccess(Access::YOUTUBE_PROVIDER, $token,
            json_encode([
                'id_token' => $authorization['id_token'],
                'access_token' => $authorization['access_token']
            ]));
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        $token = Session::find($request->session()->get('user_token'))
                        ->token;
        $provider = $request->get('provider');
        Access::where(
            ['session_token' =>$token],
            ['provider' => $provider])
            ->first()->delete();
        return redirect()->route('home');
    }
}