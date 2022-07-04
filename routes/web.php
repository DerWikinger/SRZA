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

//Route::any('{model}/{id2?}/{method?}', function ($url) {
//    $uri = parse_url(\Illuminate\Support\Facades\URL::current(), PHP_URL_PATH );
////    foreach (parse_url(\Illuminate\Support\Facades\URL::current(), PHP_URL_PATH ) as $s) {
////        $uri = $uri . ' : ' . $s;
////    }
//   return 'Hello ' . $uri;
//});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dictionaries')->name('dictionaries')->middleware('auth')->group(function () {
    Route::get('/', 'App\Http\Controllers\Dictionaries\DictionaryController@index')->name('.all');
    Route::get('/{id}', 'App\Http\Controllers\Dictionaries\DictionaryController@list')->name('.list');
    Route::prefix('/{id}')->group(function() {
        Route::get('/create', 'App\Http\Controllers\Dictionaries\DictionaryController@create')->name('.create');
        Route::get('/edit/{object_id}', 'App\Http\Controllers\Dictionaries\DictionaryController@edit')->name('.edit');
        Route::post('/store', 'App\Http\Controllers\Dictionaries\DictionaryController@store')->name('.store');
        Route::post('/update', 'App\Http\Controllers\Dictionaries\DictionaryController@update')->name('.update');
        Route::post('/delete/{object_id}', 'App\Http\Controllers\Dictionaries\DictionaryController@destroy')->name('.delete');
    });
});

Route::prefix('locations')->name('locations')->middleware('auth')->group(function () {
    Route::get('/', 'App\Http\Controllers\Main\LocationController@index')->name('.list');
    Route::get('/create', 'App\Http\Controllers\Main\LocationController@create')->name('.create');
    Route::post('/{id}/delete', 'App\Http\Controllers\Main\LocationController@destroy')->name('.delete');
    Route::post('/{id}/update', 'App\Http\Controllers\Main\LocationController@update')->name('.update');
    Route::get('/{id}/edit', 'App\Http\Controllers\Main\LocationController@edit')->name('.edit');
    Route::get('/{id}', 'App\Http\Controllers\Main\LocationController@show')->name('.show');
    Route::post('/store', 'App\Http\Controllers\Main\LocationController@store')->name('.store');
    Route::post('/reset', 'App\Http\Controllers\Main\LocationController@reset')->name('.reset');
    Route::post('/avatar-change', 'App\Http\Controllers\Main\LocationController@avatarChange')->name('.avatar-change');
    Route::post('/edit/avatar-change', 'App\Http\Controllers\Main\LocationController@avatarChange')->name('.edit.avatar-change');

//    Route::prefix('/{location_id}/units')->name('.units')->middleware('auth')->group(function () {
//        Route::get('/','App\Http\Controllers\Main\UnitController@index')->name('.list');
//    });
});

Route::prefix('units')->name('units')->middleware('auth')->group(function () {
//    Route::get('/', 'App\Http\Controllers\Main\UnitController@index')->name('.list');
    Route::get('/create/{location_id}', 'App\Http\Controllers\Main\UnitController@create')->name('.create');
    Route::post('/delete/{unit_id}', 'App\Http\Controllers\Main\UnitController@destroy')->name('.delete');
    Route::post('/update/{unit_id}', 'App\Http\Controllers\Main\UnitController@update')->name('.update');
    Route::get('/edit/{unit_id}', 'App\Http\Controllers\Main\UnitController@edit')->name('.edit');
    Route::get('/{unit_id}', 'App\Http\Controllers\Main\UnitController@show')->name('.show');
    Route::post('/store', 'App\Http\Controllers\Main\UnitController@store')->name('.store');
    Route::post('/reset', 'App\Http\Controllers\Main\UnitController@reset')->name('.reset');
    Route::post('/avatar-change', 'App\Http\Controllers\Main\UnitController@avatarChange')->name('.avatar-change');
    Route::post('/edit/avatar-change', 'App\Http\Controllers\Main\UnitController@avatarChange')->name('.edit.avatar-change');
//
//    Route::prefix('/{uint_id}/cells')->name('.cells')->middleware('auth')->group(function () {
//        Route::get('/','App\Http\Controllers\Main\CellController@index')->name('.list');
//    });
});

Route::prefix('cells')->name('cells')->middleware('auth')->group(function () {
//    Route::get('/', 'App\Http\Controllers\Main\UnitController@index')->name('.list');
    Route::get('/create/{unit_id}', 'App\Http\Controllers\Main\CellController@create')->name('.create');
    Route::post('/delete/{cell_id}', 'App\Http\Controllers\Main\CellController@destroy')->name('.delete');
    Route::post('/update/{cell_id}', 'App\Http\Controllers\Main\CellController@update')->name('.update');
    Route::get('/edit/{cell_id}', 'App\Http\Controllers\Main\CellController@edit')->name('.edit');
    Route::get('/{cell_id}', 'App\Http\Controllers\Main\CellController@show')->name('.show');
    Route::post('/store', 'App\Http\Controllers\Main\CellController@store')->name('.store');
    Route::post('/reset', 'App\Http\Controllers\Main\CellController@reset')->name('.reset');
    Route::post('/avatar-change', 'App\Http\Controllers\Main\CellController@avatarChange')->name('.avatar-change');
    Route::post('/edit/avatar-change', 'App\Http\Controllers\Main\CellController@avatarChange')->name('.edit.avatar-change');

//    Route::prefix('/{cell_id}/equipments')->name('.equipments')->middleware('auth')->group(function () {
//        Route::get('/','App\Http\Controllers\Main\EquipmentController@index')->name('.list');
//    });
});

Route::prefix('equipments')->name('equipments')->middleware('auth')->group(function () {
//    Route::get('/', 'App\Http\Controllers\Main\UnitController@index')->name('.list');
    Route::get('/create/{cell_id}', 'App\Http\Controllers\Main\EquipmentController@create')->name('.create');
    Route::post('/delete/{equipment_id}', 'App\Http\Controllers\Main\EquipmentController@destroy')->name('.delete');
    Route::post('/update/{equipment_id}', 'App\Http\Controllers\Main\EquipmentController@update')->name('.update');
    Route::get('/edit/{equipment_id}', 'App\Http\Controllers\Main\EquipmentController@edit')->name('.edit');
    Route::get('/{equipment_id}', 'App\Http\Controllers\Main\EquipmentController@show')->name('.show');
    Route::post('/store', 'App\Http\Controllers\Main\EquipmentController@store')->name('.store');
    Route::post('/reset', 'App\Http\Controllers\Main\EquipmentController@reset')->name('.reset');
    Route::post('/avatar-change', 'App\Http\Controllers\Main\EquipmentController@avatarChange')->name('.avatar-change');
    Route::post('/edit/avatar-change', 'App\Http\Controllers\Main\EquipmentController@avatarChange')->name('.edit.avatar-change');

//    Route::prefix('/{cell_id}/equipments')->name('.equipments')->middleware('auth')->group(function () {
//        Route::get('/','App\Http\Controllers\Main\EquipmentController@index')->name('.list');
//    });
});

Route::prefix('users')->name('users')->group(function () {
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

        if ($user) {
            if (auth()->check()) {
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
