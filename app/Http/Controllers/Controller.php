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
use Illuminate\Support\Collection;
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
        if (!$model) abort(501);
        $className = $this->getClassName($model);
        if (!$className) abort(502);
        $obj = null;
        if ($request->id > 0) {
            try {
                $obj = $className::find($request->id);
            } catch (\Exception $exception) {
                abort(503);
            }
        } else {
            try {
                $obj = $className::make();
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
            $fileName = 'temp_avatar_' . Carbon::now() . '.' . $file->extension() . '.' . 'tmp';
            $fileName = str_replace([':', '\\'], '_', $fileName);
            try {
                Storage::putFileAs($path, new File($file), $fileName);
            } catch (\Exception $exception) {
                return response()->json(['error' => 'File is not put on server!']);
            }
            return response()->json([
                'success' => 'AJAX request success',
                'path' => '/storage/images/avatars/' . $model . '/' . ($obj->id ?? 0),
                'filename' => $fileName,
            ]);
        }
        return response()->json(['error' => 'Avatar image is not uploaded']);
    }

    protected function updateAvatar($file, $model, $id)
    {
        if (!$id) return false;
        $className = $this->getClassName($model);
        if (!$className) return false;

        $oldPath = '/public/images/avatars/' . $model . '/0';
        $tempFile =  $oldPath . '/' . $file;

        $newPath = '/public/images/avatars/' . $model . '/' . $id;
        if (!Storage::exists($newPath)) {
            Storage::makeDirectory($newPath);
        }
        $arr = [];
        $fileFullname = str_replace('.tmp', '', $file);

        preg_match('/[\.].{3,4}$/', $fileFullname, $arr);
        $extenssion = ($arr[0] ? $arr[0] : '.png');
        $fileName = 'avatar_' . $model . '_' . $id . $extenssion;

        $obj = null;
        try {
            $obj = $className::find($id);
            if(Storage::copy($tempFile, $newPath . '/' . $fileName)) {
                $obj->avatar = $fileName;
                $this->deleteTempAvatars($oldPath, '.tmp');
                return $obj->save();
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function reset(Request $request)
    {
        $model = $request->model;
        if (!$model) abort(501);
        $id = $request->id ?? 0;
        $path = '/public/images/avatars/' . $model . '/' . $id;
        $this->deleteTempAvatars($path, '.tmp');
        return response('', 200);
    }

    public function clearAvatar(Request $request)
    {
        $model = $request->model;
        if (!$model) abort(501);
        $id = $request->id ?? 0;
        if ($id) {
            $className = $this->getClassName($model);
            if (!$className) abort(502);
            $obj = null;
            try {
                $obj = $className::find($id);
                $obj->avatar = '';
                $obj->save();
            } catch (\Exception $exception) {
                abort(503);
            }
        }
        return $this->reset($request);
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
        return 'App\\Models\\' . $model;
    }

    public function getCaptions($model)
    {
        $collect = collect(__('caption'))->filter(function ($value, $key) use ($model) {
            return str_contains($key, $model . '-');
        });

        $arr = [];
        $collect->keys()->each(function ($key) use ($model, &$arr, $collect) {
            $arr[str_replace($model . '-', '', $key)] = $collect[$key];
        });

        return collect($arr);
    }
}
