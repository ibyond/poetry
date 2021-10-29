<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
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

Route::prefix('v1')->group(function () {
    //测试
    Route::get('/test', [UserController::class, 'test'])->name('test');

    Route::middleware('api.guard')->group(function () {
        //注册
        Route::post('/register', [RegisterController::class, 'register'])->name('user.register');
        //登陆
        Route::post('/login',[LoginController::class, 'login'])->name('user.login');

        Route::middleware('token.refresh')->group(function () {
            //用户资料
            Route::get('/me',[UserController::class, 'me'])->name('users.me');
            //退出
            Route::post('/logout',[LogoutController::class, 'logout'])->name('users.logout');
        });
    });



});
