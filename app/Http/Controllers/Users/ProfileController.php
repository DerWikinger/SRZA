<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function show(Request $request, $id)
    {
        dump($id);
        $saved = null;
        if($request->has('saved')) {
            $saved = $request->only('saved')['saved'];
        }

        dump($saved);
        if (auth()->id() == $id) {
            return view('users.profile')->with(['user' => User::find($id), 'saved' => $saved]);
        }
        return response()->view('users.authorize', ['error' => 'Unauthorized'], 401);
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->id());
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nickname = $request->input('nickname');
        $saved = $user->save();
        return response()->redirectToRoute('profile', ['id' => $user->id, 'saved' => $saved]);
    }
}
