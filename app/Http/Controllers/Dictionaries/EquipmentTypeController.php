<?php

namespace App\Http\Controllers\Dictionaries;

use App\Http\Controllers\Controller;
use App\Models\Dictionaries\EquipmentType;
use Illuminate\Http\Request;

class EquipmentTypeController extends DictionaryController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dictionary.list')->with([
            'objects' => EquipmentType::all(),
            'back' => '/',
        ]);
    }
}
