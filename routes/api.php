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

Route::group(['prefix' => 'auth'], function () {
    Route::Post('/registration', \App\Http\Controllers\RegisterController::class);
    Route::Post('/login', \App\Http\Controllers\LoginController::class);
});

//rooms
Route::group(['prefix' => 'rooms', 'middleware' => 'auth:sanctum'], function () {
    Route::post('{room}/step', [RoomController::class, 'createStep']);
    Route::resource('/', RoomController::class);
    Route::post('/enter/{room}', [RoomController::class, 'enter']);
    Route::post('/leave/{room}', [RoomController::class, 'leave']);
});


Route::get('/me',\App\Http\Controllers\MeController::class)->middleware('auth:sanctum');

Route::get('/list', [RoomController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/login', function (Request $request) {
    return response()->json(['login' => $request->user()->login]);
});
