<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
Route::post('admin/update', [ProfileController::class, 'accountUpdate'])->name('Admin@accoutUpdate');

//admin
Route::prefix('admin')->group(function () {
    //password
    Route::get('password/page', [ProfileController::class, 'passwordPage'])->name('admin#passwordPage');
    Route::post('password/page', [ProfileController::class, 'changePassword'])->name('Admin@changePassword');

    //admin list
    Route::get('list', [ListController::class, 'index'])->name('admin#list');
    Route::get('delete/{id}', [ListController::class, 'deleteUser'])->name('Admin@delete');
    Route::get('search/list', [ListController::class, 'searchUser'])->name('Admin@serchList');
});

//category
Route::prefix('category')->group(function () {

    Route::get('/', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('create', [CategoryController::class, 'create'])->name('Catogory@create');
    Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('Category@delete');
    Route::get('search/list', [CategoryController::class, 'searchCategory'])->name('Category@serchList');
    Route::get('edit/page/{id}', [CategoryController::class, 'editPage'])->name('category#editPage');
    Route::post('update/{id}', [CategoryController::class, 'update'])->name('Catogory@edit');
});

//post
Route::prefix('post')->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('admin#post');
    Route::post('create', [PostController::class, 'create'])->name('Post@create');
    Route::get('delete/{id}', [PostController::class, 'delete'])->name('Post@delete');
    Route::get('search/list', [PostController::class, 'searchPost'])->name('Post@searchList');
    Route::get('edit/page/{id}', [PostController::class, 'editPage'])->name('post#editPage');
    Route::post('update/{id}', [PostController::class, 'update'])->name('Post@update');
});

//contact
Route::get('contact/list', [ContactController::class, 'index'])->name('admin#contact');
Route::get('contact/detail/{id}', [ContactController::class, 'detail'])->name('contact#detail');
Route::get('contact/delete/{id}', [ContactController::class, 'delete'])->name('contact#delete');
