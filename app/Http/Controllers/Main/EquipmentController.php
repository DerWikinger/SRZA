<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cell;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EquipmentController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $foreign_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $foreign_id)
    {
        $cell = Cell::find($foreign_id);
        dump($cell);
        if(!$cell) abort(500);
        return view('main.equipments.list')->with([
            'equipments' => $cell->equipments,
            'foreign_id' => $foreign_id,
            'back' => '/units/' . $cell->unit->id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $foreign_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $foreign_id)
    {
        $cell = Cell::make(
            [
                'number' => 0,
                'name' => '',
                'avatar' => '',
                'description' => '',
            ]);
        $cell->unit_id = $foreign_id ?? 0;
        $captions = $this->getCaptions($cell);
        return view('main.cells.create')->with([
            'cell' => $cell,
            'captions' => $captions,
            'back' => '/units/' . $foreign_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->data);
        dump($data);
        $cell = Cell::make(
            [
                'number' => 0,
                'name' => '',
                'avatar' => '',
                'description' => '',
            ]);
        $cell->unit_id = $data->unit_id ?? 0;
        dump($cell);
        return response($this->modelSave($data, $cell), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int  $id)
    {
        $cell = Cell::find($id);
        if (!$cell) abort(500);
        $captions = $this->getCaptions($cell);
        return view('main.cells.show')->with([
            'cell' => $cell,
            'captions' => $captions,
            'back' => '/units/' . $cell->unit->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $cell = Cell::find($id);
        if (!$cell) abort(404);
        $captions = $this->getCaptions($cell);
        return view('main.cells.create')->with([
            'cell' => $cell,
            'captions' => $captions,
            'back' => '/units/' . $cell->unit->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $cell = Cell::find($id);
        $data = json_decode($request->data);

        return response($this->modelSave($data, $cell), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (Cell::destroy($id)) {
            $path = '/public/images/avatars/cell/' . $id;
            Storage::deleteDirectory($path);
            return response('Object has been deleted', 200);
        }
    }
}
