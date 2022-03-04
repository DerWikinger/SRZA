<?php

namespace App\Http\Controllers\Dictionaries;

use App\Http\Controllers\Controller;
use App\Models\Dictionaries\Dictionary;
use App\Models\Dictionaries\EquipmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DictionaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dictionaries = Dictionary::all()->map(function ($dictionary) {
//            $arr = collect(explode('-', $dictionary->table));
//            $name = $arr->reduce(function($result, $part) {
//                if($result) {
//                    return $result = $result . ' ' . $part;
//                } else {
//                    $first_letter = substr($part, 0, 1);
//                    return $result = strtoupper($first_letter) . substr($part, 1);
//                }
//            }, '');
            $dictionary->name = __('caption.' . $dictionary->class);
            return $dictionary;
        });

        return view('dictionary.all')->with([
            'dictionaries' => $dictionaries,
            'back' => '/',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function list(int $id)
    {
        $dictionary = Dictionary::findOrFail($id);
        $objects = collect(('App\\Models\\Dictionaries\\' . $dictionary->class)::all())->
        sortBy(['order_index', 'name'])->
        map( function ($object) {
            return [
                'id' => $object->id,
                'name' => $object->name,
            ];
        } );
        return view('dictionary.list')->with([
            'dictionary' => $dictionary,
            'objects' => $objects,
            'back' => '/dictionaries',
        ]);
//        return Redirect::route( $dictionary->table . '.list');
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create(int $id)
    {
        $dictionary = Dictionary::findOrFail($id);
        $className = 'App\\Models\\Dictionaries\\' . $dictionary->class;
        $object = $className::make([
            'name' => '',
        ]);
        $captions = $this->getCaptions($id);
        dump($captions);
        return view('dictionary.create')->with([
            'object' => $object,
            'captions' => $captions,
            'dictionaryId' => $id,
            'back' => '/dictionaries/' . $id,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $id, Request $request)
    {
        $data = json_decode($request->data);
        $dictionary = Dictionary::findOrFail($id);
        $className = 'App\\Models\\Dictionaries\\' . $dictionary->class;
        $object = $className::make([
            'name' => $data->name,
        ]);
        try {
            if ($object->save()) return response($object, 200);
        } catch (Exception $ex) {
            return response($ex, 200);
            abort(500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $dictionaryId
     * @param int $objectId
     * @return \Illuminate\Http\Response
     */
    public function edit(int $dictionaryId, int $objectId)
    {
        $dictionary = Dictionary::findOrFail($dictionaryId);
        $className = 'App\\Models\\Dictionaries\\' . $dictionary->class;
        $object = $className::findOrFail($objectId);
        $captions = $this->getCaptions($dictionaryId);
        return view('dictionary.create')->with([
            'object' => $object,
            'captions' => $captions,
            'dictionaryId' => $dictionaryId,
            'back' => '/dictionaries/' . $dictionaryId,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $dictionaryId
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(int $dictionaryId, Request $request)
    {
        $data = json_decode($request->data);
        $dictionary = Dictionary::findOrFail($dictionaryId);
        $className = 'App\\Models\\Dictionaries\\' . $dictionary->class;
        $object = $className::findOrFail($data->id);
        $object->name = $data->name;
        try {
            if ($object->save()) return response($object, 200);
        } catch (Exception $ex) {
            return response($ex, 200);
            abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $dictionaryId
     * @param int $objectId
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $dictionaryId, int $objectId)
    {
        $dictionary = Dictionary::findOrFail($dictionaryId);
        $className = 'App\\Models\\Dictionaries\\' . $dictionary->class;
        if ($className::destroy($objectId)) {
            return response('Object has been deleted', 200);
        }
    }

    protected function getCaptions(int $dictionaryId) {
        $captions = collect([
            'id' => __('caption.dictionary-id'),
            'name' => __('caption.dictionary-name'),
            'btnSave' => __('caption.btnSave'),
            'btnReset' => __('caption.btnReset'),
        ]);
        if ($dictionaryId == 2) {
            $captions['name'] = __('caption.voltage-transformer-name');
        }
        return $captions;
    }
}
