<?php

use App\Http\Controllers\Api\Admin\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

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
//my apis
Route::group(['middleware' => ['api', 'select_lang'], 'namespace' => 'Api'], function () {

    Route::post('get_all_posts', [PostController::class, 'get_all_posts']);
    Route::post('get_post', [PostController::class, 'get_post_by_id']);
});

//admin

Route::group(['middleware' => ['select_lang', 'check_guard:admin_api'], 'namespace' => 'Api', 'prefix' => 'admin'], function () {
    Route::post('get_five_posts', [PostController::class, 'get_five_posts']);

    Route::post('login_for_admin', [AuthController::class, 'admin_login']);
    Route::post('register_for_admin', [AuthController::class, 'admin_register']);
    Route::post('logout_for_admin', [AuthController::class, 'admin_logout']);
});
// user
