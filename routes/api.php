<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register-user', [AuthController::class, 'registerUser']);
Route::post('/loggin-user', [AuthController::class, 'logginUser']);
Route::post('/loggout-user', [AuthController::class, 'loggOutUser'])->middleware('auth:sanctum');



// Route::group(['middleware' => ['auth:sanctum'], function (Request $request) {
    Route::get('/get-all-posts', [PostController::class, 'getAllPosts'])->middleware('auth:sanctum');
    Route::post('/create-post', [PostController::class, 'createPost'])->middleware('auth:sanctum');
    Route::post('/update-post/{id}', [PostController::class, 'updatePost'])->middleware('auth:sanctum');
    Route::post('/delete-post/{id}', [PostController::class, 'deletePost'])->middleware('auth:sanctum');
// }]);
