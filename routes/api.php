<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\FriendshipController;
use App\Http\Controllers\Api\likeController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\TimelineController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Route::get('/user/{id}', [TimelineController::class, 'index']);
Route::get('/profile/{id}', [ProfileController::class, 'index']);

//Auth________________________________________________________________________
Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    //profiles ___________________________________________________________________
    Route::get('/profile/{id}', [ProfileController::class, 'index']);

    //post ___________________________________________________________________
    Route::apiResource('/post', PostController::class);

    //post ___________________________________________________________________
    Route::apiResource('/like', likeController::class);

    //comment ___________________________________________________________________
    Route::apiResource('/comment', CommentController::class);

    //search ___________________________________________________________________
    Route::get('/search', SearchController::class);

    //friendship ___________________________________________________________________
    Route::apiResource('/friendship', FriendshipController::class);
});
