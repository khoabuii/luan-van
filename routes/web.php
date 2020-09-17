<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@getIndex');
// admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login','AdminController@getLogin');
    Route::post('/login','AdminController@postLogin');

    Route::get('/dashboard','AdminController@getDashboard');
    Route::group(['prefix' => 'categories'], function () {

    });
});
// parent
Route::group(['prefix' => 'parent'], function () {

});

//babysitter
Route::group(['prefix' => 'babysitter'], function () {

});
