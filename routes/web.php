<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Notifications\NewPostNotification;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\User\PostController;

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
Route::post('/posts/{post}/reaction',[PostController::class,'toggle_react'])->middleware('auth');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix'=>'users','as'=>'users.','middleware'=>'auth'], function(){

    Route::resource('/posts',PostController::class);


    });

// Route::get('fff',[PostController::class,'pppp']);

