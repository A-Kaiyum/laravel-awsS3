<?php

use App\Http\Controllers\PostController;
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
Route::post('/create-post',[PostController::class,'postStore']);
Route::get('/get-post',[PostController::class,'getPosts']);
Route::post('/delete-post/{id}',[PostController::class,'deletePost']);
Route::get('/show-post/{id}',[PostController::class,'showPost']);
Route::get('/edit-post/{id}',[PostController::class,'editPost']);
Route::post('/update-post/{id}',[PostController::class,'updatePost']);
