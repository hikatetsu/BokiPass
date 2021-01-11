<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/timeline', [App\Http\Controllers\PostController::class, 'index'])->name('timeline');

Route::get('/timeline/post/create', [App\Http\Controllers\PostController::class, 'showCreateForm'])->name('create');
Route::post('/timeline/post/create', [App\Http\Controllers\PostController::class, 'create']);

Route::get('/timeline/post/{post_id}', [App\Http\Controllers\PostController::class, 'showDetails'])->name('show');

Route::get('/timeline/post/{post_id}/edit', [App\Http\Controllers\PostController::class, 'showEditForm'])->name('edit');
Route::post('/timeline/post/{post_id}/edit', [App\Http\Controllers\PostController::class, 'edit']);