<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\DetailUser;
use App\Store;
use App\Area;


class StoreController extends Controller
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
        // $area = Area::all();
        $DetailUser = DetailUser::where('user_id',Auth::id())->first();
        $store = Store::with('area')->get();
        return view('store.index',compact('store','area','DetailUser'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $area = Area::all();
        $DetailUser = DetailUser::where('user_id',Auth::id())->first();
        return view('store.create',compact('DetailUser','area'));
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
            'dealer_id' => 'required|string',
            'address' => 'required|string',
            'area_id' => 'required|integer',
            'grade' => 'required|string',
            'active' => 'required|boolean'
        ]);
        Store::create($request->all());
        return redirect()->route('store.index')
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
        $store = Store::find($id);
        $area = Area::all();
        return view('store.show',compact('store','area','DetailUser'));
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
        $store = Store::find($id);
        $area = Area::all();
        return view('store.edit',compact('store','area','DetailUser'));
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
            'dealer_id' => 'required|string',
            'address' => 'required|string',
            'area_id' => 'required|integer',
            'grade' => 'required|string',
            'active' => 'required|boolean'
        ]);
        Store::find($id)->update($request->all());
        return redirect()->route('store.index')
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
        Store::find($id)->delete();
        return redirect()->route('store.index')
            ->with('success','deleted successfully');
    }
}
