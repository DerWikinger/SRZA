<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use PhpParser\Builder\Class_;
use Prophecy\Doubler\Generator\ClassCreator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upload(Request $request)
    {
        $model = $request->model;
        if(!$model) abort(501);
        $className = $this->getClassName($model);
        if(!$className) abort(502);
        $obj = null;
        if($request->id == 0)
        {
            try {
                $obj = $className::make();
            } catch (\Exception $exception) {
                abort(503);
            }
        } else {
            try {
                $obj = $className::find($request->id);
            } catch (\Exception $exception) {
                abort(503);
            }
        }
        if (!(is_null($obj)) && $request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $file = $request->file('avatar');
            $path = '/public/images/avatars/' . $model . '/' . ($obj->id ?? 0);
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
                'path' => '/storage/images/avatars/' . $model . '/' . ($obj->id ?? 0),
                'filename' => $fileName,
            ]);
        }
        return response()->json(['error' => 'Avatar image is not uploaded']);
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

    public function reset()
    {
        $path = '/public/images/avatars/' . auth()->id();
        $this->deleteTempAvatars($path, '.tmp');
        return response('', 200);
    }

    public function deleteTempAvatars($path, $pattern)
    {
        foreach (Storage::allFiles($path) as $f) {
            if (str_contains($f, $pattern)) {
                Storage::delete($f);
            }
        }
    }

    public function getClassName($model)
    {
        $letter = $model[0];
        $letter = strtoupper($letter);
        $model = $letter . substr($model, 1);
        return 'App\\Models\\'.$model;
    }
}
