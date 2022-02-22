<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

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

Route::prefix('locations')->name('locations')->middleware('auth')->group(function() {
    Route::get('/', 'App\Http\Controllers\Main\LocationController@index')->name('.list');
    Route::get('/create', 'App\Http\Controllers\Main\LocationController@create')->name('.create');
    Route::post('/delete/{id}', 'App\Http\Controllers\Main\LocationController@destroy')->name('.delete');
    Route::post('/update/{id}', 'App\Http\Controllers\Main\LocationController@update')->name('.update');
    Route::get('/edit/{id}', 'App\Http\Controllers\Main\LocationController@edit')->name('.edit');
    Route::get('/{id}', 'App\Http\Controllers\Main\LocationController@show')->name('.show');
    Route::post('/store', 'App\Http\Controllers\Main\LocationController@store')->name('.store');
    Route::post('/reset', 'App\Http\Controllers\Main\LocationController@reset')->name('.reset');
    Route::post('/avatar-change', 'App\Http\Controllers\Main\LocationController@avatarChange')->name('.avatar-change');
    Route::post('/edit/avatar-change', 'App\Http\Controllers\Main\LocationController@avatarChange')->name('.edit.avatar-change');
});

Route::prefix('users')->name('users')->group(function() {
    Route::get('/', 'App\Http\Controllers\Users\UsersController@index');
    Route::post('update', 'App\Http\Controllers\Users\UsersController@update')->name('.update');
});

Route::middleware('auth')->middleware('role:admin')->group(function () {
    Route::get('admin', function () {
        return view('admin.index');
    })->name('admin.index');
});

Route::prefix('chats')->name('chats')->group(function () {
//    Route::get('/0?', 'App\Http\Controllers\Chats\ChatsController@index')->middleware(['auth', 'member']);
    Route::get('/{id?}', 'App\Http\Controllers\Chats\ChatsController@index')->middleware(['member']);
    Route::post('/{chatId}/message', 'App\Http\Controllers\Chats\ChatsController@broadcast')->name('.{chatId}.message');
    Route::get('/{chatId}/messages', 'App\Http\Controllers\Chats\ChatsController@all')->middleware(['member'])->name('.messages');
});

Route::post('/pusher/auth', 'App\Http\Controllers\Auth\PusherController@pusherAuth')
    ->middleware('auth');

Route::prefix('cabinet')->name('cabinet')->middleware('owner:cabinet')->group(function () {
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
    Route::get('/{id}', 'App\Http\Controllers\Users\ProfileController@show')->middleware('owner:profile');
    Route::post('/reset', 'App\Http\Controllers\Users\ProfileController@reset')->name('.reset');
    Route::put('/update', 'App\Http\Controllers\Users\ProfileController@update')->name('.update');
    Route::post('/upload', 'App\Http\Controllers\Users\ProfileController@upload')->name('.upload');
});

Auth::routes(['verify' => true]);
