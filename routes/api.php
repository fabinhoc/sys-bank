<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

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
    $user = Auth::user();
    $user->account = Auth::user()->account;
    return response()->json($user);
});

Route::middleware('auth:api')->prefix('users')->group(function(){
    Route::post('/', [UserController::class, 'store']);
    Route::get('/', [UserController::class, 'index']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('expenses')->group(function(){
    Route::post('/', [ExpenseController::class, 'store']);
    Route::get('/', [ExpenseController::class, 'index']);
    Route::put('{id}', [ExpenseController::class, 'update']);
    Route::get('{id}', [ExpenseController::class, 'show']);
    Route::delete('{id}', [ExpenseController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('deposits')->group(function(){
    Route::post('/', [DepositController::class, 'store']);
    Route::get('/', [DepositController::class, 'index']);
    Route::put('{id}', [DepositController::class, 'update']);
    Route::get('{id}', [DepositController::class, 'show']);
    Route::delete('{id}', [DepositController::class, 'destroy']);
});

Route::middleware('auth:api')->prefix('accounts')->group(function(){
    Route::post('/', [AccountController::class, 'store']);
    Route::get('/', [AccountController::class, 'index']);
    Route::put('{id}', [AccountController::class, 'update']);
    Route::get('{id}', [AccountController::class, 'show']);
    Route::delete('{id}', [AccountController::class, 'destroy']);
});

