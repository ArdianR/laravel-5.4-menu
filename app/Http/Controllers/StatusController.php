<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\DetailUser;
use App\Status;

class StatusController extends Controller
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
        $status = Status::all();
        return view('status.index',compact('status','DetailUser'))
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
        return view('status.create',compact('DetailUser'));
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
        Status::create($request->all());
        return redirect()->route('status.index')
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
        $status = Status::find($id);
        return view('status.show',compact('status','DetailUser'));
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
        $status = Status::find($id);
        return view('status.edit',compact('status','DetailUser'));
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
        Status::find($id)->update($request->all());
        return redirect()->route('status.index')
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
        Status::find($id)->delete();
        return redirect()->route('status.index')
            ->with('success','deleted successfully');
    }
}
