<?php

namespace App\Services;

interface Provider
{
    public static function session();

    public static function authUrl();

    public static function authorize(string $code) : array;

    public function account();

    public function name();

}