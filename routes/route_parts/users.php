<?php


use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;


Route::group(['middleware' => 'auth'], function () {

    Route::get('/users/profile', [UserController::class, 'show'])->name('users.show');
});
