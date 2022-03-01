<?php

namespace App\Http\Controllers\Dictionaries;

use App\Http\Controllers\Controller;
use App\Models\Dictionaries\Dictionary;
use App\Models\Dictionaries\EquipmentType;
use Illuminate\Http\Request;

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
}
