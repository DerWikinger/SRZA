<?php

namespace App\Http\Controllers\Main;

use App\Models\Cell;
use App\Models\Dictionaries\EquipmentType;
use App\Models\Dictionaries\VoltageTransformer;
use App\Models\Dictionaries\VoltageClass;
use App\Models\Dictionaries\CurrentTransformer;
use App\Models\Dictionaries\CurrentClass;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class EquipmentController extends MainController
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @param int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function index(int $id = 0)
//    {
//        $cell = Cell::find($id);
//        if(!$cell) abort(500);
//        return view('main.equipments.list')->with([
//            'equipments' => $cell->equipments,
//            'foreign_id' => $id,
//            'back' => '/units/' . $cell->unit->id,
//        ]);
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int  $id)
    {
        $equipment = Equipment::find($id);
        return $this->getCreateView($equipment);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $foreign_id
     * @return \Illuminate\Http\Response
     */
    public function create(int $foreign_id = 0)
    {
        $equipment = Equipment::make(
            [
                'number' => null,
                'name' => '',
                'avatar' => '',
                'mark' => '',
                'model' => '',
                'schema_label' => '',
                'production_date' => null,
                'description' => '',
            ]);
        $equipment->cell_id = $foreign_id ?? 0;
        return $this->getCreateView($equipment);
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
        $equipment = Equipment::make(
            [
                'number' => null,
                'name' => '',
                'avatar' => '',
                'mark' => '',
                'model' => '',
                'schema_label' => '',
                'production_date' => null,
                'description' => '',
            ]);
        $equipment->cell_id = $data->cell_id ?? 0;
        return response($this->modelSave($data, $equipment), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $equipment = Equipment::find($id);
        return $this->getCreateView($equipment);
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
        $equipment = Equipment::find($id);
        $data = json_decode($request->data);

        return response($this->modelSave($data, $equipment), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        if (Equipment::destroy($id)) {
            $path = '/public/images/avatars/equipment/' . $id;
            Storage::deleteDirectory($path);
            return response('Object has been deleted', 200);
        }
    }

    /**
     * Return the 'CreateView'.
     *
     * @param  Equipment $equipment
     * @return View
     */
    private function getCreateView(Equipment $equipment){
        if (!$equipment) abort(500);
        $captions = $this->getCaptions($equipment);
        $equipmentTypes = EquipmentType::all()->sortBy('order_index');
        $voltageTransformer = VoltageTransformer::all();
        $voltageClass = VoltageClass::all();
        $currentTransformer = CurrentTransformer::all();
        $currentClass = CurrentClass::all();
        return view('main.equipments.create')->with([
            'equipment' => $equipment,
            'equipmentTypes' => $equipmentTypes,
            'voltageTransformer' => $voltageTransformer,
            'voltageClass' => $voltageClass,
            'currentTransformer' => $currentTransformer,
            'currentClass' => $currentClass,
            'captions' => $captions,
            'back' => '/cells/' . $equipment->cell->id,
        ]);
    }
}
