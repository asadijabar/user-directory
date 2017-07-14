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

// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// Route::get('/profile', 'HomeController@index')->name('home')->middleware('auth');

/*Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        // Uses first & second Middleware
    });


});*/


Route::group(['prefix' => 'home', 'middleware' => ['before' => 'auth']], function () {

    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);


    Route::group(['prefix' => 'profile'], function () {

        Route::get('/view', [
            'uses' => 'Profile\ProfileController@view',
            'as' => 'profile.view'
        ]);

        Route::get('/edit', [
            'uses' => 'Profile\ProfileController@edit',
            'as' => 'profile.edit'
        ]);

    });

});