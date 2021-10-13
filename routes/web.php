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

Route::redirect('/', '/home');

//Route::get('/', function () {
//    return view('welcome');
//})->middleware('guest');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::resource('users', 'App\Http\Controllers\Users\UsersController');

Route::prefix('users')->name('users')->group(function() {
    Route::get('/', 'App\Http\Controllers\Users\UsersController@index');
    Route::post('update', 'App\Http\Controllers\Users\UsersController@update')->name('.update');
});

Route::middleware('auth')->middleware('role:admin')->group(function () {
    Route::get('admin', function () {
        return view('admin.index');
    })->name('admin.index');
});

Route::prefix('chats')->name('chats')->middleware('auth')->group(function () {
    Route::get('/{id}', 'App\Http\Controllers\Chats\ChatsController@index');
});

Route::prefix('cabinet')->name('cabinet')->group(function () {
    Route::get('/{id}', function ($id) {
        $saved = null;
        if (\Illuminate\Support\Facades\Request::query('saved')) {
            $saved = \Illuminate\Support\Facades\Request::query('saved');
        }
        $user = App\Models\User::find($id);
        if($user) {
            if(auth()->check()) {
                return view('cabinet.cabinet')->with(['user' => $user, 'saved' => $saved]);
            } else {
                return redirect('login');
            }
        } else {
            abort('401');
        }
    });
});

Route::prefix('profile')->name('profile')->group(function () {
    Route::get('/{id}', 'App\Http\Controllers\Users\ProfileController@show');
    Route::put('/update', 'App\Http\Controllers\Users\ProfileController@update')->name('.update');
    Route::post('/upload', 'App\Http\Controllers\Users\ProfileController@upload')->name('.upload');
});

Auth::routes(['verify' => true]);
