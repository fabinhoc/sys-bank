<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function(){
    Route::middleware('auth:api')->post('/', [UserController::class, 'store']);
    Route::middleware('auth:api')->get('/', [UserController::class, 'index']);
    Route::middleware('auth:api')->put('{id}', [UserController::class, 'update']);
    Route::middleware('auth:api')->get('{id}', [UserController::class, 'show']);
    Route::middleware('auth:api')->delete('{id}', [UserController::class, 'destroy']);
});

