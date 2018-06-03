<?php

namespace App\Http\Controllers;

use App\Services\Spotify;
use App\Session;
use App\Token as Access;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        if (session()->has('user_token')) {
            $session = Session::find($request->session()->get('user_token'));
        } else {
            $session = Session::create();
            session(['user_token' => $session->token]);
            session()->save();
        }
        $token = $session->token;
        $data['access'] = Access::where('session_token', $token)
            ->get()
            ->map(function ($access) {
                $name = '';
                if ($access->provider == Access::SPOTIFY_PROVIDER) {
                    $name = (new Spotify($access->session_token))->name();
                }
                return [
                    'provider' => $access->provider,
                    'name' => $name
                ];
            })
            ->toArray();
        return view('home', $data);
    }

    public function about()
    {
        return view('about');
    }
}