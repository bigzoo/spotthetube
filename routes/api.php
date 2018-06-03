<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/** @var \Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    /** @var \Dingo\Api\Routing\Router $api */
    $api->get('spotify', \App\Http\Controllers\Api\SpotifyController::class . '@index');
    $api->get('cow', function(){
         return response()->json(['beware' => 'I gorra thing for cows!']);
    });
});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
