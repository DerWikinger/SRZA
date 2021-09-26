<?php

namespace App\Http\Controllers\Users;

use Illuminate\Database\Eloquent\Casts\ArrayObject;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Array_;
use PhpParser\Node\Expr\Cast\Object_;
use SebastianBergmann\Type\ObjectType;
use Symfony\Component\Translation\Util\ArrayConverter;
use function Psy\debug;

class UsersController extends \App\Http\Controllers\Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:admin', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Позволяет поменять local
//        App::setLocale('ru');
        $page = $request->has('page') ? $request->page : 1;
        $perPage = 10;
        $count = User::all('id')->count();
        $totalPages = (int)($count / $perPage);
        $totalPages = $totalPages + ($count % $perPage == 0 ? 0 : 1);
        return view('users.index')->with([
            'users' => User::all()->forPage($page, $perPage),
            'page' => $page,
            'totalPages' => $totalPages,
        ]);

        //Data 'users' are defined in method boot() in App\Providers\AppServiceProvider.php
//        return view('users.index');
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show')->with('user', User::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dump('users.update method is called!');
        $user = User::find(json_decode($request->userData) ? json_decode($request->userData)->id : 0);
        dump(json_decode($request->userData));
        if($user) {
            return "New data of user '$user->name' is recieved!";
        }
        else {
            //back();
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
