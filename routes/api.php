<?php

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\DynastyController;
use App\Http\Controllers\Api\HostSearchController;
use App\Http\Controllers\Api\PoetController;
use App\Http\Controllers\Api\PoetryController;
use App\Http\Controllers\Api\VerseController;
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
            Route::get('/me',[UserController::class, 'me'])->name('user.me');
            //退出
            Route::post('/logout',[LogoutController::class, 'logout'])->name('user.logout');

            //朝代列表
            Route::get('/dynasties', [DynastyController::class, 'index'])->name('dynasties.index');
            //名句列表
            Route::get('/verses', [VerseController::class, 'index'])->name('verses.index');

            //今日名句
            Route::get('/verses/today', [VerseController::class, 'today'])->name('verses.today');

            //诗词列表
            Route::get('/poetries', [PoetryController::class, 'index'])->name('poetries.index');
            //诗词详情
            Route::get('/poetries/{id}', [PoetryController::class, 'show'])->name('poetries.show');

            //诗人的诗
            Route::get('/poets/{id}/poetry', [PoetryController::class, 'poetryList'])->name('poet.poetries');

            //诗人列表
            Route::get('/poets', [PoetController::class, 'index'])->name('poets.index');
            //诗人详情
            Route::get('/poets/{poet}', [PoetController::class, 'show'])->name('poets.show');

            //热门搜索
            Route::get('/hosts', [HostSearchController::class, 'index'])->name('hosts.index');
        });
    });



});
