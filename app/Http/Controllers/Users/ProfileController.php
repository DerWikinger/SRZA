<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function show(Request $request, $id)
    {
        $saved = null;
        if ($request->has('saved')) {
            $saved = $request->only('saved')['saved'];
        }

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
        if($request->hasFile('avatar_image') && $request->file('avatar_image')->isValid()) {
            $this->updateAvatar($request->file('avatar_image'), $user);
        }
        $saved = $user->save();
        dump($user->avatar);
        return response()->redirectToRoute('profile', ['id' => $user->id, 'saved' => $saved]);
    }

    protected function updateAvatar(UploadedFile $file, User $user)
    {
        $path = '/public/images/avatars/' . $user->id;
        $count = 1;
        // Get next number of picture by client uploaded
        if (($user->avatar) && preg_match('/^.*_(\d+).[a-z]{3,4}$/', $user->avatar, $data)) {
            $count = is_numeric($data[1]) ? (int)$data[1] + 1 : 1;
        }
        if(! Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
        $fileName = 'avatar_' . $count . '.' . $file->extension();
        // Delete previuos avatar of client
//        if (Storage::exists($path . '/' . $user->avatar ?? '')) {
//            Storage::delete($path . '/' . $user->avatar);
//        }
        // Delete same file if exists from storage
        if (Storage::exists($path . '/' . $fileName)) {
            Storage::delete($path . '/' . $fileName);
        }
        Storage::putFileAs($path, new File($file), $fileName);
        dump($fileName);
        $user->avatar = $fileName;
        return;
    }
}
