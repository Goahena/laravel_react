<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth',
],function($router){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api');
    Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:api');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/send-verification-code', [AuthController::class, 'sendVerificationCode']);
    Route::post('/verify-code', [AuthController::class, 'verifyCode']);
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

Route::group([
    'middlware' => 'api',
    'prefix' => 'comment',
], function($router){
    Route::get('/', [CommentController::class, 'index']);
    Route::post('/', [CommentController::class, 'store']);
    Route::get('/{id}', [CommentController::class, 'show']);
    Route::put('/{id}', [CommentController::class, 'update']);
    Route::delete('/{id}', [CommentController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'contact',
], function ($router) {
    Route::get('/', [ContactController::class, 'index']);
    Route::post('/', [ContactController::class, 'store']);
    Route::get('/{id}', [ContactController::class, 'show']);
    Route::put('/{id}', [ContactController::class, 'update']);
    Route::delete('/{id}', [ContactController::class, 'destroy']);
});
// bài viết
Route::apiResource('posts', PostController::class);
// danh mục
Route::apiResource('categories', CategoryController::class);