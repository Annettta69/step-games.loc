<?php

use App\Http\Controllers\RoomController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:sanctum')->get('/login', function (Request $request) {
    return response()->json(['login' => $request->user()->login]);
});

Route::group(['prefix' => 'auth'], function () {
    Route::Post('/registration', \App\Http\Controllers\RegisterController::class);
    Route::Post('/login', \App\Http\Controllers\LoginController::class);
});

Route::resource('/rooms', \App\Http\Controllers\RoomController::class)->middleware('auth:sanctum');
Route::get('/me',\App\Http\Controllers\MeController::class)->middleware('auth:sanctum');

Route::get('/list', [RoomController::class, 'index'])->middleware('auth:sanctum');
