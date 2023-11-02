<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\UpdateController;
use App\Http\Controllers\Post\DestroyController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->group(function ($router) {
    Route::prefix('auth')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('login', 'login');
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
            Route::post('me', 'me');
        });
    });
});

Route::middleware('jwt.auth')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('/', IndexController::class);
        Route::get('/create', CreateController::class);
        
        Route::post('/', StoreController::class);
        Route::get('/{post}', ShowController::class);
        Route::get('/{post}/edit', EditController::class);
        Route::patch('/{post}', UpdateController::class);
        Route::delete('/{post}', DestroyController::class);
    });
});