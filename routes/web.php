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

  Route::get('/', 'PagesController@home');

  Route::post('/upload', 'UploadController@upload');
  Route::get('/upload', 'UploadController@upload');

  Route::get('server-photos/{id}', ['uses' => 'UploadController@getServerPhotos']);

  Route::resource('types', 'TypeController');
  Route::resource('bids', 'BidController');

  Route::get('/logout', function () {
    cas()->logout();
  });
});

Auth::routes();
