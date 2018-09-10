<?php

namespace App\Services;

use App\Music\Playlist;

interface Provider
{
    public static function session();

    public static function authUrl();

    public static function authorize(string $code) : array;

    public function revoke(): void;

    public function account();

    public function name();

    public function playlist(string $link): Playlist;

}