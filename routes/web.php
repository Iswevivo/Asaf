<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\EventController;





// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('posts/categories', CategoryController::class);
Route::resource('posts/tags', TagController::class);
Route::resource('posts', PostController::class);
Route::post('posts/{post}/comment', [PostController::class, 'add_comment'])->name('post.add_comment');
Route::get('posts/{slug}/images/',[PostController::class, 'show_images'])->name('post.images');

Route::resource('centres', CenterController::class);
Route::resource('programs', ProgramController::class);
Route::resource('events', EventController::class);