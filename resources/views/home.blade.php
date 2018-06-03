<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Spot The Tube</title>
    <meta name="description" content="If spotify and youtube had a baby.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md">
            <p class="title">Spot The Tube</p>
            <p>
                <small><a href="{{ route('about') }}">about</a></small>
            </p>
        </div>
    </div>
    <div id="app" class="container">
        {{--        @dd($access)--}}
        @if( in_array(\App\Token::SPOTIFY_PROVIDER, array_column($access, 'provider')) )
            <a class="btn btn-success btn-block">Connected to Spotify as <u><b>'name'</b></u> </a>
        @else
            <a class="btn btn-success btn-block" href="{{ route('spotify.auth') }}">Connect To Spotify</a>
        @endif
        @if( in_array(\App\Token::YOUTUBE_PROVIDER, array_column($access, 'provider')) )
            <a class="btn btn-danger btn-block">Connected to Youtube as <u><b>'name'</b></u> </a>
        @else
            <a class="btn btn-danger btn-block mt-3" href="{{ route('youtube.auth') }}">Connect To Youtube</a>
        @endif
    </div>
</div>
<footer>
    <b><span class="flex-center">Created with love by&nbsp;<a target="_blank" href="http://bigzoo.me">bigzoo</a></span></b>
</footer>
<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>