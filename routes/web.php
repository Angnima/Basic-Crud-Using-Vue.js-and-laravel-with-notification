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
Route::get('/home/all', 'ProductController@index')->name('data.all');
Route::post('/home/create', 'ProductController@create')->name('data.save');
Route::post('/home/delete/{id}', 'ProductController@delete')->name('data.delete');
Route::post('/home/update/{id}', 'ProductController@update')->name('data.update');
Route::get('/notif', 'ProductController@disNot')->name('notif');
Route::get('/show/data/{id}', 'ProductController@dataDis')->name('show.data');
Route::post('/markAsRead', 'ProductController@markAsRead')->name('mark.read');