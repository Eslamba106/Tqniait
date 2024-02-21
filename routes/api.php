<?php

use App\Http\Controllers\StatsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\PostController;

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


Route::post('/register' ,[RegisterController::class , 'register'] );
Route::controller(LoginController::class)->group(function(){
    Route::post('login','login');
    Route::post('logout', 'logout')->middleware('auth:sanctum');
});

Route::put('/verify-code', [RegisterController::class, 'verifyCode']);

Route::controller(TagController::class)->group(function(){
    Route::get('/tags' , 'show')->middleware('auth:sanctum');
    Route::post('/tags/create' , 'create')->middleware('auth:sanctum');
    Route::put('/tags/update' , 'update')->middleware('auth:sanctum');
    Route::post('/tags/delete' , 'delete')->middleware('auth:sanctum');

});

Route::controller(PostController::class)->group(function(){
    Route::get('/posts','index')->middleware('auth:sanctum');
    Route::post('/posts/create','create')->middleware('auth:sanctum');
    Route::post('/posts/update','update')->middleware('auth:sanctum');
    Route::post('/posts/delete','delete')->middleware('auth:sanctum');
});

Route::controller(StatsController::class)->group(function(){
    Route::get('stats' , 'stats')->middleware('auth:sanctum');
});