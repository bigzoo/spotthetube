@extends('layout')
@section('content')
<div>
    @foreach($access as $provider)
        @php($class = $provider["provider"] == 'spotify' ? 'success': 'danger')
        <p class="btn btn-{{$class}} btn-block logout-buttons">
            Connected to {{ $provider["provider"] }} as <u><b>{{ $provider["name"] }}</b></u>
            <i class="fas fa-sign-out-alt float-right logout-icons" data-toggle="tooltip" data-placement="top"
                title="Logout from {{ $provider["provider"] }}"
               onclick="window.location.href ='{{ route('logout')."?provider=".$provider["provider"] }}';">
            </i>
        </p>
    @endforeach
        @if( count($access) == 2)
    {{--@if( true )--}}
        <p>
            <a class="btn btn-block btn-light btn-outline-dark" href="{{ route('magic') }}">Proceed To The Magic</a>
        </p>
    @endif
    @if( !in_array(\App\Token::SPOTIFY_PROVIDER, array_column($access, 'provider')) )
        <a class="btn btn-success btn-block" href="{{ route('spotify.auth') }}">Connect To Spotify</a>
    @endif
    @if( !in_array(\App\Token::YOUTUBE_PROVIDER, array_column($access, 'provider')) )
        <a class="btn btn-danger btn-block mt-3" href="{{ route('youtube.auth') }}">Connect To Youtube</a>
    @endif
</div>
@endsection
@section('scripts')
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
@endsection