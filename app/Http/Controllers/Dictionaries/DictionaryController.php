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
        return view('dictionary.list')->with([
            'dictionary' => $dictionary,
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
        $captions = collect([
            'id' => __('caption.dictionary-id'),
            'name' => __('caption.dictionary-name'),
            'btnSave' => __('caption.btnSave'),
            'btnReset' => __('caption.btnReset'),
        ]);
        return view('dictionary.create')->with([
            'object' => $object,
            'captions' => $captions,
            'back' => '/dictionaries/' . $id,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $id, Request $request) {
        $data = json_decode($request->data);
        dump($data);
        $dictionary = Dictionary::findOrFail($id);
        $className = 'App\\Models\\Dictionaries\\' . $dictionary->class;
        $object = $className::make([
            'name' => $data->name,
        ]);
        dump($object);
        try {
            if($object->save()) return response($object, 200);
        } catch (Exception $ex) {
            return response($ex, 200);
            abort(500);
        }
    }
}
