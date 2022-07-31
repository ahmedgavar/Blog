<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Notifications\NewPostNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\CommentController;

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

// Auth::routes();
Route::post('/posts/{post}/reaction', [PostController::class, 'toggle_react'])->middleware('auth');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'auth'], function () {

    Route::resource('/posts', PostController::class);
    Route::resource('/comments', CommentController::class);
});


Route::middleware(['is_admin'])->prefix('admins')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admins.index')->middleware('notification.read');
});


// Route::group(['prefix'=>'admins','as'=>'admins.','middleware'=>'auth'], function(){

//     Route::resource('/posts',PostController::class);


//     });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
