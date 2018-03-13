<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Store;
use App\DetailUser;
use Auth;

class PopController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $store = Store::all();
        return view('pop.index',compact('store'))
            ->with('i');
    }

    public function indexHq()
    {
        $area = Area::all();
        return view('pop.indexHq',compact('area'))
            ->with('i');
    }

    public function indexHr()
    {
        $users = Auth::user()->detailuser()->get();
        $area = Area::find($users[0]->area_id);
        $store = Store::where('area_id','=',$users[0]->area_id)->get();
        return view('pop.indexhr',compact('store','area'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ('oke');
    }

    public function createHr($id)
    {
        $user_id = Auth::id();
        $detailuser = DetailUser::where('user_id',$user_id)->first();
        $area = Area::all();
        $store_id = $id;
        $store = Store::all();
        return view('pop.createHr',compact('user_id','store_id','area','detailuser','store'))
            ->with('i');
    }

    public function createArea()
    {
        $id = Auth::id();
        return view('pop.createArea',compact('id'))
            ->with('i');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ('oke');
    }

    public function storeArea(Request $request)
    {
        return ('oke');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ('oke');
    }

    public function showAreaHq($id)
    {
        $area = Area::find($id);
        $store = Store::where('area_id','=',$id)->get();
        return view('pop.showAreaHq',compact('store','area'))
            ->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ('oke');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return ('oke');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return ('oke');
    }
}
