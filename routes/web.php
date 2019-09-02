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
//页面
Route::get('/','StaticPagesController@home')->name('home');
Route::get('/help','StaticPagesController@help')->name('help');
Route::get('/about','StaticPagesController@about')->name('about');
//用户
Route::get('signup','UsersController@create')->name('signup');
Route::resource('users','UsersController');
//用户登录处理
Route::get('login','SessionsController@create')->name('login');
Route::post('login','SessionsController@store')->name('login');
Route::delete('login','SessionsController@destroy')->name('logout');

//邮件激活接口
Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');

//找回密码
//显示重置密码的邮件发送页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//邮箱发送重置链接
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//密码更新页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//执行密码更新操作
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//微博发送和删除
Route::resource('statuses','StatusesController',['only'=>['store','destroy']]);

//粉丝页面和关注页面
//关注
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
//粉丝
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');