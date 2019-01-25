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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>['auth','web']],function(){
    Route::get('/editprofile/{id}', [
        'uses' => 'DashboardController@editProfile',
        'as' => 'editprofile'
    ]);
    Route::get('/changePassword/{id}',[
    	'uses' => 'DashboardController@changePassword',
    	'as' => 'change.Password'
    ]);
    Route::post('/changePasswordUpdate/{id}',[
    	'uses' => 'DashboardController@changePasswordUpdate',
    	'as' => 'change.PasswordUpdate'
    ]);
});
