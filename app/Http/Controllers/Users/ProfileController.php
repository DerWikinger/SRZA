<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
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
            return view('cabinet.profile')->with(['user' => User::find($id), 'saved' => $saved]);
        }
        return response()->view('users.authorize', ['error' => 'Unauthorized'], 401);
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->id());
        $errors = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'nickname' => ['max:50'],
        ]);
        dump($errors);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->nickname = $request->input('nickname');
        if ($request->hasFile('avatar_image') && $request->file('avatar_image')->isValid()) {
            $this->updateAvatar($request->file('avatar_image'), $user);
        }
        $saved = $user->save();
        return response()->redirectToRoute('cabinet', ['id' => $user->id, 'saved' => $saved]);
//        return redirect()->back(302, ['saved' => $saved]);
    }

    protected function updateAvatar(UploadedFile $file, User $user)
    {
        $path = '/public/images/avatars/' . $user->id;
        $count = 1;
        // Get next number of picture by client uploaded
        if (($user->avatar) && preg_match('/^.*_(\d+).[a-z]{3,4}$/', $user->avatar, $data)) {
            $count = is_numeric($data[1]) ? (int)$data[1] + 1 : 1;
        }
        $this->deleteTempAvatars($path, '.tmp');
        if (!Storage::exists($path)) {
            Storage::makeDirectory($path);
        }
        $fileName = 'avatar_' . $count . '.' . $file->extension();
        // Delete previuos avatar of client
        if (Storage::exists($path . '/' . $user->avatar ?? '')) {
            Storage::delete($path . '/' . $user->avatar);
        }
        // Delete same file if exists from storage
        if (Storage::exists($path . '/' . $fileName)) {
            Storage::delete($path . '/' . $fileName);
        }
        Storage::putFileAs($path, new File($file), $fileName);
        dump($fileName);
        $user->avatar = $fileName;
        return;
    }

    public function upload(Request $request)
    {
        $user = User::find($request->userId ?? 0);
        if (!(is_null($user)) && $request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $file = $request->file('avatar');
            $path = '/public/images/avatars/' . $user->id;
            $this->deleteTempAvatars($path, '.tmp');
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            $fileName = 'temp_avatar_' . Carbon::now() . '.' . 'tmp';
            $fileName = str_replace([':', '\\'], '_', $fileName);
            try {
                Storage::putFileAs($path, new File($file), $fileName);
            } catch (\Exception $exception) {
                dump($exception);
                return response()->json(['error' => 'File is not put on server!']);
            }
            dump('A file is created');
            return response()->json([
                'success' => 'AJAX request success',
                'path' => '/storage/images/avatars/' . $user->id,
                'filename' => $fileName,
            ]);
        }
        return response()->json(['error' => 'Avatar image is not uploaded']);
    }

    public function reset($id)
    {
        $path = '/public/images/avatars/' . $id;
        $this->deleteTempAvatars($path, '.tmp');
    }

    public function deleteTempAvatars($path, $pattern)
    {
        foreach (Storage::allFiles($path) as $f) {
            if (str_contains($f, $pattern)) {
                Storage::delete($f);
            }
        }
    }
}
