<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('pages.home');
    });
   // Route::get('{zip}/{street}', ['as' => 'flyers.show', 'uses' => 'FlyersController@show']);
    Route::resource('flyers', 'FlyersController');
    Route::get('{zip}/{street}', 'FlyersController@show');
    Route::post('{zip}/{street}/photos', ['as' => 'store_photo_path', 'uses' => 'PhotosController@store']);
});
