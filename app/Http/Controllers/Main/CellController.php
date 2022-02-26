<?php

namespace App\Http\Controllers\Main;

use App\Models\Cell;
use Illuminate\Http\Request;

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
        if(!$unit) abort(500);
        return view('main.units.list')->with([
            'units' => $unit->cells,
            'foreign_id' => $foreign_id,
            'back' => 'locations' . $unit->location->id . '/units',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function show(Cell $cell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function edit(Cell $cell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cell $cell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cell  $cell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cell $cell)
    {
        //
    }
}
