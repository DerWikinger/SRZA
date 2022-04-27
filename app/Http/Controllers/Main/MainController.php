<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class MainController extends Controller
{
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
            $this->deleteAvatars($path, '.tmp');
            if (!Storage::exists($path)) {
                Storage::makeDirectory($path);
            }
            $fileName = 'temp_avatar_' . Carbon::now()->timestamp . '.' . $file->extension() . '.' . 'tmp';
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

    /**
     * Update the specified avatar in storage.
     *
     * @param string $file
     * @param string $model
     * @param int $id
     * @param string $sourcePath
     * @return string
     */
    protected function updateAvatar($file, $model, $id, $sourcePath)
    {
        if (!$id) return '';
        $className = $this->getClassName($model);
        if (!$className) return '';
        $tempFile = $sourcePath . '/' . $file;

        $newPath = '/public/images/avatars/' . $model . '/' . $id;
        if (!Storage::exists($newPath)) {
            Storage::makeDirectory($newPath);
        }

        $arr = [];
        $fileFullname = str_replace('.tmp', '', $file);

        preg_match('/[\.].{3,4}$/', $fileFullname, $arr);
        $extenssion = ($arr[0] ? $arr[0] : '.png');
        $pattern = 'avatar_' . $model . '_' . $id;
        $fileName = $pattern . '_' . Carbon::now()->timestamp . $extenssion;

        try {
            $this->deleteAvatars($newPath, $pattern);
            if (Storage::copy($tempFile, $newPath . '/' . $fileName)) {
                $this->deleteAvatars($sourcePath, '.tmp');
                return $fileName;
            }
            return '';
        } catch (\Exception $exception) {
            return '';
        }
    }

    public function reset(Request $request)
    {
        $model = $request->model;
        if (!$model) abort(501);
        $id = $request->id ?? 0;
        $path = '/public/images/avatars/' . $model . '/' . $id;
        $this->deleteAvatars($path, '.tmp');
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

    public function deleteAvatars($path, $pattern = '')
    {
        foreach (Storage::allFiles($path) as $f) {
            if ($pattern && !str_contains($f, $pattern)) continue;
            Storage::delete($f);
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
        $model_type = strtolower(class_basename($model));
        $collect = collect(__('caption'))->filter(function ($value, $key) use ($model_type) {
            return str_contains($key, $model_type . '-');
        });
        $arr = [];
        $collect->keys()->each(function ($key) use ($model_type, &$arr, $collect) {
            $arr[str_replace($model_type . '-', '', $key)] = $collect[$key];
        });
        $arr['avatarConfirmMessage'] = __('caption.avatarConfirmMessage');
        return collect($arr);
    }
    /**
     * Save the specified object in database.
     *
     * @param object $data
     * @param Model $object
     * @return Model
     */
    protected function modelSave($data, $object)
    {
        if ($data) {
            $properties = collect($data)->keys();
            $source = collect($data);
            foreach($properties as $property) {
                if(!is_object($object[$property])) $object[$property] = $source[$property];
            }
        } else {
            abort(500);
        }

        $className = strtolower(class_basename($object));

        try {
            $srcPath = '';
            $arr = [];
            preg_match('/[\.].{3,4}$/', $object->avatar ?? '', $arr);
            $extenssion = (count($arr) && $arr[0] ? $arr[0] : '');
            if ($extenssion == '.tmp') {
                if (!$object->id) {
                    $srcPath = '/public/images/avatars/'. $className .'/0';
                    if (!$object->save()) abort(500);
                } else {
                    $srcPath = '/public/images/avatars/' . $className . '/' . $object->id;
                }
            }
            if ($srcPath) {
                if (!($object->avatar = $this->updateAvatar($object->avatar, $className, $object->id, $srcPath))) {
                    abort(500);
                }
            }
            $object->save();
            return json_encode($object);
        } catch (Exception $exception) {
            abort($exception->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function avatarChange(Request $request)
    {
        return $this->upload($request);
    }
}
