<?php

/**
 * General Routes
 */
Route::get('/', 'HomeController@home')->name('home');
Route::get('about', 'HomeController@about')->name('about');
Route::get('magic', 'MagicController@index')->name('magic');

/**
 * Spotify and Youtube Authentication Routes
 */
Route::get('auth/spotify','AuthController@spotifyAuth')->name('spotify.auth');
Route::get('auth/youtube','AuthController@youtubeAuth')->name('youtube.auth');
Route::get('logout', 'AuthController@logout')->name('logout');

/**
 * Spotify and Youtube Authentication Callback Routes
 */
Route::get('callback/spotify','AuthController@spotifyCallback')->name('spotify.callback');
Route::get('callback/youtube','AuthController@youtubeCallback')->name('youtube.callback');
