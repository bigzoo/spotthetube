<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * General Routes
 */
Route::get('/', 'HomeController@home')->name('home');
Route::get('about', 'HomeController@about')->name('about');

/**
 * Spotify and Youtube Authentication Routes
 */
Route::get('auth/spotify','AuthController@spotifyAuth')->name('spotify.auth');
Route::get('auth/youtube','AuthController@youtubeAuth')->name('youtube.auth');


/**
 * Spotify and Youtube Authentication Callback Routes
 */
Route::get('callback/spotify','AuthController@spotifyCallback')->name('spotify.callback');
Route::get('callback/youtube','AuthController@youtubeCallback')->name('youtube.callback');
