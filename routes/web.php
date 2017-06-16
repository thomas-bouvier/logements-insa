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

Route::group(['middleware' => ['cas.auth', 'register']], function() {

    Route::get('/', 'PagesController@welcome');
    Route::get('home', 'PagesController@home');
    Route::get('about', 'PagesController@about');

    Route::post('upload', 'UploadController@upload');
    Route::post('upload/delete', 'UploadController@delete');

    Route::get('server-photos/{id}', ['uses' => 'UploadController@getServerPhotos']);

    Route::resource('bids', 'BidController');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
    {
        Route::resource('types', 'TypeController');
        Route::resource('bids', 'BidController');
    });

    Route::post('logout', function() {
        cas()->logout();
    });
});
