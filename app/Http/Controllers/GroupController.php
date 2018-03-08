<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\DetailUser;
use Auth;

class GroupController extends Controller
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
        $group = Group::all();
        return view('group.index',compact('group','DetailUser'))
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
        return view('group.create',compact('DetailUser'));
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
            'active' => 'required|boolean'
        ]);
        Group::create($request->all());
        return redirect()->route('group.index')
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
        $group = Group::find($id);
        return view('group.show',compact('group','DetailUser'));
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
        $group = Group::find($id);
        return view('group.edit',compact('group','DetailUser'));
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
            'active' => 'required|boolean'
        ]);
        Group::find($id)->update($request->all());
        return redirect()->route('group.index')
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
        Group::find($id)->delete();
        return redirect()->route('group.index')
            ->with('success','deleted successfully');
    }
}