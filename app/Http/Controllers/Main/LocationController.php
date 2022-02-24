<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Main\MainController;
use App\Models\Location;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class LocationController extends MainController
{
    protected $location;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('main.locations.list')->with([
            'locations' => Location::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location = Location::make(['name' => '', 'avatar' => '', 'description' => '']); // new Location([ 'name' => '' ]);
        $captions = $this->getCaptions('location');
        return view('main.locations.create')->with([
            'location' => $location,
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
        $location = Location::make(['name' => '', 'avatar' => '', 'description' => '']);
        $data = json_decode($request->data);

        return response($this->modelSave($data, $location), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id); // new Location([ 'name' => '' ]);
        if (!$location) abort(500);
        $captions = $this->getCaptions($location);
        return view('main.locations.show')->with([
            'location' => $location,
            'captions' => $captions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id); // new Location([ 'name' => '' ]);
        if (!$location) abort(500);
        $captions = $this->getCaptions($location);
        return view('main.locations.create')->with([
            'location' => $location,
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
    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $data = json_decode($request->data);

        return response($this->modelSave($data, $location), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Location::destroy($id)) {
            $path = '/public/images/avatars/location/' . $id;
            Storage::deleteDirectory($path);
            return response('Object has been deleted', 200);
        }
    }

//    protected function modelSave($data, $location)
//    {
//        if ($data) {
//            $location->name = $data->name ?? '';
//            $location->avatar = $data->avatar ?? '';
//            $location->description = $data->description ?? '';
//        } else {
//            abort(500);
//        }
//
//        try {
//            $srcPath = '';
//            $arr = [];
//            preg_match('/[\.].{3,4}$/', $location->avatar ?? '', $arr);
//            $extenssion = (count($arr) && $arr[0] ? $arr[0] : '');
//            if ($extenssion == '.tmp') {
//                if (!$location->id) {
//                    $srcPath = '/public/images/avatars/location/0';
//                    if (!$location->save()) abort(501);
//                } else {
//                    $srcPath = '/public/images/avatars/location/' . $location->id;
//                }
//            }
//            if ($srcPath) {
//                if (!($location->avatar = $this->updateAvatar($location->avatar, 'location', $location->id, $srcPath))) {
//                    abort(502);
//                }
//            }
//            $location->save();
//            return $location;
//        } catch (Exception $exception) {
//            abort(503);
//        }
//    }
}
