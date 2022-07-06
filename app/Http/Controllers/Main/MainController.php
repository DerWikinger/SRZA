<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Site;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use mysql_xdevapi\Exception;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use phpDocumentor\Reflection\Types\Object_;
use function Illuminate\Tests\Integration\Database\toArray;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectionName = $this->getModelCollectionName();
        $type = static::getClassName($collectionName);
        $collection = $type::all();
        $site = Site::all()->where('name', $collectionName)->first();

        return view('main.list')->with([
            'collectionName' => $collectionName,
            'type' => static::getSingular($collectionName),
            'data' => $collection,
            'back' => '/' . ($site->parent ? $site->parent->name : ''),
            'root' => !$site->parent
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $collectionName = $this->getModelCollectionName();
        $type = static::getClassName($collectionName);
        $model = $type::find($id);
        if (!$model) abort(500);
        $site = Site::all()->where('name', $collectionName)->first();
        $type = ($site->parent ? static::getClassName($site->parent->name) : '');
        $parent = null;
        if($type) {
            $key = $model[static::getSingular($site->parent->name) . '_' . 'id'];
            $parent = $type::find($key);
        }
        $children = $site->child ? $site->child->name : '';
        $captions = $this->getCaptions($model);
        return view('main.show')->with([
            'type' => static::getSingular($collectionName),
            'model' => $model,
            'children' => $children,
            'captions' => $captions,
            'back' => '/' . ($site->parent ? $site->parent->name : $collectionName) . ($parent ? '/' . $parent->id : ''),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $foreign_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $foreign_id = 0)
    {
        $collectionName = $this->getModelCollectionName();
        $type = static::getClassName($collectionName);
        $model = $type::make(['name' => '', 'avatar' => '', 'description' => '']);
        $site = Site::all()->where('name', $collectionName)->first();
        if($foreign_id) {
            $type = ($site->parent ? static::getSingular($site->parent->name) : '');
            $model[$type . '_id'] = $foreign_id;
        }
        $fields = collect(Schema::getColumnListing($collectionName));
        $captions = $this->getCaptions($model);
        return view('main.create')->with([
            'type' => static::getSingular($collectionName),
            'model' => $model,
            'fields' => collect($fields),
            'captions' => $captions,
            'back' => '/' . ($foreign_id ? $site->parent->name .  '/' . $foreign_id : $collectionName),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $collectionName = $this->getModelCollectionName();
        $type = static::getClassName($collectionName);
        $model = $type::make();
        $data = json_decode($request->data);

        return response($this->modelSave($data, $model), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $collectionName = $this->getModelCollectionName();
        $type = static::getClassName($collectionName);
        $model = $type::find($id);
        if (!$model) abort(500);
        $captions = $this->getCaptions($model);
        $fields = collect(Schema::getColumnListing($collectionName));
        $site = Site::all()->where('name', $collectionName)->first();
        $foreign_id = 0;
        if($site->parent) {
            $key = static::getSingular($site->parent->name) . '_id';
            $foreign_id = $model[$key];
        }
        return view('main.create')->with([
            'type' => static::getSingular($collectionName),
            'model' => $model,
            'fields' => collect($fields),
            'captions' => $captions,
            'back' => '/' . ($foreign_id ? $site->parent->name .  '/' . $foreign_id : $collectionName),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $collectionName = $this->getModelCollectionName();
        $type = static::getClassName($collectionName);
        $model = $type::find($id);
        $data = json_decode($request->data);

        $result = $this->modelSave($data, $model);
        return response($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $collectionName = $this->getModelCollectionName();
        $type = static::getClassName($collectionName);
        if ($type::destroy($id)) {
            $path = '/public/images/avatars/'. static::getSingular($collectionName) .'/' . $id;
            Storage::deleteDirectory($path);
            return response('Object has been deleted', 200);
        }
    }

    public function avatarChange(Request $request)
    {
        $model = $request->model;
        if (!$model) abort(500,'Model is not found!');
        $className = static::getClassName($model);
        if (!$className) abort(500,'Class name is invalid!');
        $obj = null;
        if ($request->id > 0) {
            try {
                $obj = $className::find($request->id);
            } catch (\Exception $exception) {
                abort(500, $exception->getMessage());
            }
        } else {
            try {
                $obj = $className::make();
            } catch (\Exception $exception) {
                abort(500, $exception->getMessage());
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
                return response()->json([
                    'error' => 'File is not put on server!',
                    'message' => $exception->getMessage()
                ]);
            }
            return response()->json([
                'success' => 'AJAX request success',
                'path' => '/storage/images/avatars/' . $model . '/' . ($obj->id ?? 0),
                'filename' => $fileName,
            ]);
        }
        return response(['error' => 'Avatar image is not uploaded'], 200);
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
        $className = static::getClassName($model);
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
            $className = static::getClassName($model);
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

    public function getModelCollectionName()
    {
        return preg_split('/\//', parse_url(URL::current(), PHP_URL_PATH))[1];
    }

    public static function getClassName($model)
    {
        $model = static::getSingular($model);
        $letter = $model[0];
        $letter = strtoupper($letter);
        $model = $letter . substr($model, 1);
        return 'App\\Models\\' . $model;
    }

    public static function getSingular($model)
    {
        if($model === '') throw new \Exception('Invalid class name');
        if($model[strlen($model) - 1] === 's') {
            $model = substr($model, 0, strlen($model) - 1);
        } else if(substr($model, strlen($model) - 2) === 'es') {
            $model = substr($model, 0, strlen($model) - 2);
        }
        return $model;
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
}
