<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FollowController;
use Carbon\Carbon;

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

Route::group(['prefix' => 'v1'], function () {

    Route::get('/health', function (Request $request) {
        return response()->json(['status' => true, 'timestamp' => Carbon::now()]);
    });

    Route::post('/test', [AuthController::class, 'test']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('/user', [AuthController::class, 'user']);

        Route::resource('tweets', TweetController::class)->only([
            'index', 'store', 'create'
        ]);

        Route::get('/feed', [TweetController::class, 'feed']);

        Route::get('{id}/follow', [FollowController::class, 'follow'])->name('api.get.follow');
        Route::post('/followUsername', [FollowController::class, 'followUsername'])->name('api.followUsername');
        Route::post('/follow', [FollowController::class, 'store'])->name('api.follow');
        Route::get('/following', [FollowController::class, 'following']);
        Route::get('/followers', [FollowController::class, 'followers']);
    });
});
