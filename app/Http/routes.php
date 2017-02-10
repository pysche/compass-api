<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace'=> 'Api'], function () {
    Route::match(['get', 'post'], '/api/v1/compass/{code}', [
        'as' => 'compass.index',
        'uses' => 'CompassController@index'
    ]);

    Route::match(['post'], '/api/v1/compass/{session_id}/upload', [
        'as' => 'compass.upload',
        'uses' => 'CompassController@upload'
    ])->where('session_id', '^([a-z0-9]{32})$');

    Route::match(['get'], '/api/v1/compass/{session_id}/report', [
        'as' => 'compass.report',
        'uses' => 'CompassController@report'
    ])->where('session_id', '^([a-z0-9]{32})$');

    Route::match(['get'], '/api/v1/compass/{session_id}/products', [
        'as' => 'compass.products',
        'uses' => 'CompassController@products'
    ])->where('session_id', '^([a-z0-9]{32})$');
});
