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

Route::redirect('/','/home');

//Route::get('/', function () {
//    return view('welcome');
//})->middleware('guest');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('users', 'App\Http\Controllers\Users\UsersController')->middleware('verified');

Route::middleware('auth')->group(function () {
    Route::get('admin', function () {
        return view('admin');
    });
});

Auth::routes(['verify' => true]);
