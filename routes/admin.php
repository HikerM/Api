<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Admin Login
Route::get('user' ,'Api\ApiController@user');

//需要验证session的
Route::middleware(['JwtAuth'])->group(function () {
    // 登录注销
    Route::post('logins', 'Admin\LoginController@store')->name('title:登录到管理后台');
    Route::delete('logins', 'Admin\LoginController@destroy')->name('title:注销登录');

    Route::group(['middleware' => ['AdminAuth']], function () {
        // 后台管理人员
         Route::resource('adminuser', 'Admin\AdminUserController');

    });


});