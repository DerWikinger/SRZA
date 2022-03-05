<?php

namespace App\Http\Controllers\Main;

use App\Models\Cell;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\Storage;

class CellController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $foreign_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $foreign_id)
    {
        $unit = Unit::find($foreign_id);
        dump($unit);
        if(!$unit) abort(500);
        return view('main.cells.list')->with([
            'cells' => $unit->cells,
            'foreign_id' => $foreign_id,
            'back' => '/locations/' . $unit->location->id,
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
        $cell = Cell::make(
            [
                'number' => 0,
                'name' => '',
                'avatar' => '',
                'description' => '',
            ]);
        $cell->unit_id = $data->unit_id ?? 0;
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
        if (!$cell) abort(500);
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
