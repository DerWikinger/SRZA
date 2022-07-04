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
use Illuminate\Support\Facades\URL;
use mysql_xdevapi\Exception;

class LocationController extends MainController
{
    protected $location;

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
            'back' => '/locations',
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
            'back' => '/locations',
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

        $result = $this->modelSave($data, $location);
//        dump($result->avatar);
        return response($result, 200);
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
}
