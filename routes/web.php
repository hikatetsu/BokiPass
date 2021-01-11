<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/timeline', [App\Http\Controllers\PostController::class, 'timeline'])->name('timeline');

Route::get('/timeline/post/create', [App\Http\Controllers\PostController::class, 'showCreateForm'])->name('create');
Route::post('/timeline/post/create', [App\Http\Controllers\PostController::class, 'create']);

Route::get('/timeline/post/{post_id}', [App\Http\Controllers\PostController::class, 'show'])->name('show');

Route::get('/timeline/post/{post_id}/edit', [App\Http\Controllers\PostController::class, 'showEditForm'])->name('edit');
Route::post('/timeline/post/{post_id}/edit', [App\Http\Controllers\PostController::class, 'edit']);

Route::post('/timeline/post/{post_id}/delete', [App\Http\Controllers\PostController::class, 'delete'])->name('delete');

Route::post('/timeline/post/{post_id}/comment/create', [App\Http\Controllers\CommentController::class, 'create'])->name('commentCreate');

Route::post('/timeline/post/{post_id}/comment/delete', [App\Http\Controllers\CommentController::class, 'delete'])->name('commentDelete');