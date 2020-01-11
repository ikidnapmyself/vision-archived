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

Auth::routes();
Route::get('/', 'WelcomeController@welcome')->name('welcome');
Route::middleware('auth')->group(function () {
//    Route::resource('/board', 'BoardController');
    Route::resource('/assignee', 'AssigneeController');
    Route::resource('/board', 'BoardController');
    Route::get('/friendship/list', 'FriendshipController@list')->name('friend.list');
    Route::get('/friendship/{user}/list', 'FriendshipController@showList')->name('friend.user.list');
    Route::resource('/friendship', 'FriendshipController');
    Route::get('/home', 'HomeController@index')->name('home');
//    Route::resource('/project', 'ProjectController');
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('/task/list', 'TaskController@list')->name('task.list');
    Route::resource('/task', 'TaskController');
    Route::post('/task/{task}/assign/{user}', 'TaskController@assign');
    Route::delete('/task/{task}/assign/{user}', 'TaskController@unassign');
    Route::put('/task/{task}/status/{status}', 'TaskController@status');
    Route::get('/user/list', 'UserController@list')->name('user.list');
    Route::resource('/user', 'UserController');
});
