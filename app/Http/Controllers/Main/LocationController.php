<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class LocationController extends Controller
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
        $location = Location::make(['name' => '', 'avatar' => '', 'description'=>'']); // new Location([ 'name' => '' ]);
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
        $location = Location::make(['name' => '', 'avatar' => '', 'description'=>'']);
        $data = json_decode($request->data);

        if ($data) {
            $location->name = $data->name ?? '';
            $location->avatar = $data->avatar ?? '';
            $location->description = $data->description ?? '';
        } else {
            abort(500);
        }
        try {
            if(!$location->save() || !$this->updateAvatar($location->avatar, 'location', $location->id)) abort(501);
            return response('Data is saved!', 200);
        } catch (Exception $exception) {
            abort(502);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Show '.$id;
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
        if(!$location) abort(404);
        $captions = $this->getCaptions('location');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Location::destroy($id)) return response('Object has been deleted', 200);
        return ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function avatarChange(Request $request)
    {
        return $this->upload($request);
    }
}
