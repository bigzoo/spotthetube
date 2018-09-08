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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="m-b-md">
            <p><a href="{{ route('home') }}" class="title">Spot The Tube</a></p>
            <p>
                <small><a href="{{ route('about') }}">about</a></small>
            </p>
        </div>
    </div>
    <div id="app" class="container">@yield('content')</div>
</div>
<footer>
    <b><span class="flex-center">Created with love by&nbsp;<a target="_blank" href="http://bigzoo.me">bigzoo</a></span></b>
</footer>
<script src="{{ asset('/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>