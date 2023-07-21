<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogController;



Route::middleware('auth:sanctum')->group(function () {
    //post
    Route::get('allPost', [PostController::class, 'getPost']);
    Route::post('post/search', [PostController::class, 'searchPost']);
    Route::get('catagory/all', [PostController::class, 'getPost']);
    Route::post('post/detail', [PostController::class, 'postDetail']);
    //get post like and dislike
    Route::post('post/reaction', [PostController::class, 'getReaction']);

    //category
    Route::get('allCategory', [CategoryController::class, 'getCategory']);
    Route::post('category/search', [CategoryController::class, 'searchCategory']);
});
//login || register
Route::post('user/login', [AuthController::class, 'login']);  //login and genereate token
Route::post('user/register', [AuthController::class, 'register']);

//contact
Route::post('user/contact', [ContactController::class, 'contact']);
