<?php

use Illuminate\Http\Request;

/** @var \Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    /** @var \Dingo\Api\Routing\Router $api */
    $api->get('search', \App\Http\Controllers\Api\MusicController::class . '@search');
    $api->get('cow', function(){
         return response()->json(['beware' => 'I gorra thing for cows!']);
    });
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
