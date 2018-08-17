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

Route::resource('/task', 'TasksController')
  ->middleware('auth');

Route::get('/task/check/{id}', 'TasksController@check')
  ->middleware('auth');

Route::get('/task/destroy/{id}', 'TasksController@destroy')
  ->middleware('auth');

Route::resource('/tab', 'TabsController')
  ->middleware('auth');

Route::get('/tab/destroy/{id}', 'TabsController@destroy')
  ->middleware('auth');

Auth::routes();
