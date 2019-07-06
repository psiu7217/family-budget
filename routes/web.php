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


//Если авторизированы
Route::middleware('auth')->group(function () {

    Route::resource('profile', 'ProfilesController');
    Route::resource('purses', 'PursesController');

    Route::get('/', 'HomeController@index')->name('home');

    //Добавить в друзья
    Route::get('/add_friend/{id}', 'ProfilesController@add_friend')->name('add_friend');
    //Удалить из друзей
    Route::get('/delete_friend/{id}', 'ProfilesController@delete_friend')->name('delete_friend');
});


Auth::routes();