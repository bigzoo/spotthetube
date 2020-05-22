<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\UnsupportedLink;
use Illuminate\Database\Eloquent\Collection;
use App\Transformers\PlaylistTransformer;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use App\Services\Spotify;
use App\Services\Youtube;
use App\Token as Access;

class MusicController extends Controller
{
    use Helpers;
    public function search(Request $request)
    {
        $link = $request->get('link');
        $session = $request->get('session');
        /** @var Collection $access */
        $access = Access::where('session_token', $session)
            ->get();
        $provider = $this->checkProvider($link);
        if ($provider == Access::SPOTIFY_PROVIDER){
            $access = $access->filter(function ($token){
                return $token->provider == Access::SPOTIFY_PROVIDER;
            })->first();
            $client = new Spotify($access->session_token);
        }else if($provider == Access::YOUTUBE_PROVIDER) {
            $access = $access->filter(function ($token){
                return $token->provider == Access::YOUTUBE_PROVIDER;
            })->first();
            $client = new Youtube($access->session_token);
        }else{
            $this->response->error('Unsupported URL Passed!', 400);
        }
        $playlist = $client->playlist($link);
        return $this->response->item($playlist, new PlaylistTransformer);
    }


    /**
     * @param string $link
     * @return string
     * @throws UnsupportedLink
     */
    private function checkProvider(string $link): string
    {
        $matches = [];
        preg_match_all('/open\.spotify\.com/m', $link,
            $matches, PREG_SET_ORDER, 0);
        $matches = array_flatten($matches);
        if ($matches){
            return Access::SPOTIFY_PROVIDER;
        }
        preg_match_all('/youtube\.com/m', $link,
            $matches, PREG_SET_ORDER, 0);
        if ($matches){
            return Access::YOUTUBE_PROVIDER;
        }
        throw new UnsupportedLink();
    }

}
