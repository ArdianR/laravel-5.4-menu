<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use Auth;
use App\DetailUser;

class AreaController extends Controller
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
        $DetailUser = DetailUser::where('user_id',Auth::id())->first();
        $area = Area::all();
        return view('area.index',compact('area','DetailUser'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $DetailUser = DetailUser::where('user_id',Auth::id())->first();
        return view('area.create',compact('DetailUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'alias' => 'required|string|max:5',
            'active' => 'required|boolean'
        ]);
        Area::create($request->all());
        return redirect()->route('area.index')
                        ->with('success','created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $DetailUser = DetailUser::where('user_id',Auth::id())->first();
        $area = Area::find($id);
        return view('area.show',compact('area','DetailUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DetailUser = DetailUser::where('user_id',Auth::id())->first();
        $area = Area::find($id);
        return view('area.edit',compact('area','DetailUser'));
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
        $this->validate($request, [
            'name' => 'required|string',
            'alias' => 'required|string|max:5',
            'active' => 'required|boolean'
        ]);
        Area::find($id)->update($request->all());
        return redirect()->route('area.index')
                        ->with('success','updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Area::find($id)->delete();
        return redirect()->route('area.index')
            ->with('success','deleted successfully');
    }
}
