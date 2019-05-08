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

Route::group(['prefix' => 'admin','middleware'=>'is_admin'], function () {
    Route::resource('/tasks', 'Admin\TasksController',['as' => 'admin']);
    Route::resource('/users', 'Admin\UsersController',['as' => 'admin']);
});

Route::group(['middleware'=>'auth'], function () {
    Route::resource('/tasks', 'User\TasksController')->only(['index']);
    Route::post('/task/{task}/complete', 'User\TasksController@taskComplete')->name('task.complete');
});


