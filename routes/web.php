<?php
Route::post('/test', 'PostsController@test');
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

Route::get('/', 'PostsController@index');
Route::resource('/discussions','PostsController');
Route::resource('/comment','CommentsController');

Route::group([ 'prefix'=>'user'],function(){
    Route::get('login', 'UsersController@login');//登录页面
    Route::get('avatar', 'UsersController@avatar');//更换头像page
    Route::get('register', 'UsersController@register');
    Route::post('register', 'UsersController@store');
    Route::post('login', 'UsersController@signing');//登录page
    Route::post('avatar', 'UsersController@changeAvatar');//更换头像
});
Route::post('/post/upload','PostsController@upload');
Route::get('/logout','UsersController@logout');//退出登录
