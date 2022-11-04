<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\TweetController;

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
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('{id}/index', [UserController::class, 'index'])->name('index');
    Route::get('{id}/following', [UserController::class, 'following'])->name('following');
    Route::get('{id}/followers', [UserController::class, 'followers'])->name('followers');
    Route::get('/follow', [FollowController::class, 'index'])->name('follow');
    Route::get('{id}/tweet', [TweetController::class, 'index'])->name('tweet');
});
