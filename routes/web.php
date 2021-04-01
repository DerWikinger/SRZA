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

Route::get('/', function () {
    return view('home');
});

Route::get('login', function () {
    return 'Login';
});

Route::resource('users', 'App\Http\Controllers\UsersController');
//Route::get('users', 'App\Http\Controllers\UsersController@index');

Route::middleware('auth')->group(function () {
    Route::get('admin', function () {
        return view('admin');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
