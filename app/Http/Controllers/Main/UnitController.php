<?php

namespace App\Http\Controllers\Main;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;

class UnitController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $foreign_id
     * @return \Illuminate\Http\Response
     */
    public function index(int $foreign_id)
    {
        $location = Location::find($foreign_id);
        if(!$location) abort(500);
        return view('main.units.list')->with([
            'units' => $location->units,
            'foreign_id' => $foreign_id,
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
        $unit = Unit::make(
            [
                'name' => '',
                'avatar' => '',
                'description' => '',
            ]);
        $unit->location_id = $foreign_id ?? 0;
        $captions = $this->getCaptions($unit);
        return view('main.units.create')->with([
            'unit' => $unit,
            'captions' => $captions,
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
        $data = json_decode($request->data);
        dump($data);
        $unit = Unit::make(
            [
                'name' => '',
                'avatar' => '',
                'description' => '',
            ]);
        $unit->location_id = $data->location_id ?? 0;
        dump($unit);
        return response($this->modelSave($data, $unit), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return 'Show ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $unit = Unit::find($id);
        if (!$unit) abort(404);
        $captions = $this->getCaptions($unit);
        return view('main.units.create')->with([
            'unit' => $unit,
            'captions' => $captions,
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
        $unit = Unit::find($id);
        $data = json_decode($request->data);

        return response($this->modelSave($data, $unit), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (Unit::destroy($id)) {
            $path = '/public/images/avatars/unit/' . $id;
            Storage::deleteDirectory($path);
            return response('Object has been deleted', 200);
        }
    }
}
