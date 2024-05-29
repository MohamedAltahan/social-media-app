<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TimeLineController;
use App\Http\Controllers\ProfileController;
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
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //my timeLine profile ______________________________________________________________________
    Route::get('/time-line/{id}', [TimeLineController::class, 'index'])->name('time-line.index');
});

require __DIR__ . '/auth.php';
