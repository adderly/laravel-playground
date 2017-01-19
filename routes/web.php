<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('main', ['users' => App\User::all()]);
})->middleware('auth');
Route::resource('users', 'UserController');
Route::post('/user/enable', "UserController@enable");
Route::post('/user/delete', "UserController@delete");

Auth::routes();

Route::get('/home', 'HomeController@index');
