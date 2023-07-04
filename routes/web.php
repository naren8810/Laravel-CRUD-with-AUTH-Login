<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlluserAjaxController;
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

Route::get('/', function () {
    return view('fillform');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'login_view'])->name('login');
    // Route::get('login', [AuthController::class, 'login_view'])->name('login')->middleware('throttle:2,1');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('fillformdata', [AlluserAjaxController::class, 'fillformdata'])->name('fillformdata');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'home_view'])->name('home');
    Route::get('profile', [AuthController::class, 'profile_view'])->name('profile');
    Route::post('profile/{user}', [AuthController::class, 'update'])->name('profile.update');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('ajaxposts', AlluserAjaxController::class);
    Route::get('adduser', [HomeController::class, 'add_user_view'])->name('adduser');
    Route::get('edituser', [HomeController::class, 'edit_user_view'])->name('edituser');
});
