<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;

Route::group([
    'middlware' => 'api',
    'prefix' => 'auth',
],function($router){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
});

Route::group([
    'middlware' => 'api',
    'prefix' => 'user',
],function($router){
    Route::get('/index', [UserController::class, 'index']);
    Route::get('/show/{slug}', [UserController::class, 'show']);
    Route::post('/store', [UserController::class, 'store']);
    Route::put('/update/{slug}', [UserController::class, 'update']);
    Route::delete('/delete/{slug}', [UserController::class, 'delete']);
});

Route::get('/search', [SearchController::class, 'search']);
// bài viết
Route::apiResource('posts', PostController::class);
// danh mục
Route::apiResource('categories', CategoryController::class);