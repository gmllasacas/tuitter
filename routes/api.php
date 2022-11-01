<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
});
