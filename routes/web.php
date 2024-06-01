<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\FriendController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ImageController;
use App\Http\Controllers\Frontend\LikeController;
use App\Http\Controllers\Frontend\NotificationController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\TimeLineController;
use App\Http\Controllers\ProfileController;
use App\Models\Friend;
use App\Models\Image;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    //Home ___________________________________________________________________________________
    Route::get('/', [HomeController::class, 'index']);

    //Account setting _________________________________________________________________________
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'updateProfilePhoto'])->name('profile-photo.update');
    Route::put('/profile-bio', [ProfileController::class, 'UpdateBio'])->name('profile-bio.update');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //my timeLine profile ______________________________________________________________________
    Route::get('/time-line/{id}', [TimeLineController::class, 'index'])->name('time-line.index');

    //post ______________________________________________________________________________________
    Route::resource('/post', PostController::class);

    //comments ___________________________________________________________________________________
    Route::resource('/comment', CommentController::class);

    //like _______________________________________________________________________________________
    Route::resource('/like', LikeController::class);

    //friends ____________________________________________________________________________________
    Route::resource('/friend', FriendController::class);

    //notifications _______________________________________________________________________________
    Route::get('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
    Route::get('/notifications/clear-all', [NotificationController::class, 'clearAll'])->name('notifications.clear-all');

    //image ____________________________________________________________________________________
    Route::get('/image/{imageId}', [ImageController::class, 'deleteImage'])->name('delete.image');
});


require __DIR__ . '/auth.php';
