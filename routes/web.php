<?php

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

use App\Http\Controllers\MessageController;

use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MDBController;
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

Route::get('/', function () {
    if (Auth::user()) return redirect()->route('mdb.index');
    else return view('welc');
});

require_once __DIR__ . '/route_parts/mdb.php';

require_once __DIR__ . '/route_parts/users.php';



Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', function () {
        return redirect()->route('mdb.index');
    })->name('home');


});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
