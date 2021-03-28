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
    return response()->json($request->user());
});

Route::middleware('auth:api')->prefix('users')->group(function(){
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

