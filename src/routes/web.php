<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

# Middleware ~~ will not allow any users that are not authenticated/logged in.
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');

    // POST - This Route Group will organize or group all routes related to POST
    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::get('/create', [PostController::class, 'create'])->name('create'); // post.create
        Route::post('/store', [PostController::class, 'store'])->name('store'); // post.store
        Route::get('/{id}/show', [PostController::class, 'show'])->name('show'); // post.show
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit'); // post.edit
        Route::patch('/{id}/update', [PostController::class, 'update'])->name('update'); // post.update
        Route::delete('/{id}/destroy', [PostController::class, 'destroy'])->name('destroy'); // post.destroy
    });

    // COMMENT
    Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
        Route::post('/{post_id}/store', [CommentController::class, 'store'])->name('store'); // comment.store
        Route::delete('/{comment_id}/destroy', [CommentController::class, 'destroy'])->name('destroy'); // comment.destroy
    });

    // USER
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('/{id}/show', [UserController::class, 'show'])->name('show'); // profile.show
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit'); // profile.edit
        Route::patch('/{id}/update', [UserController::class, 'update'])->name('update'); // profile.update
    });
});
