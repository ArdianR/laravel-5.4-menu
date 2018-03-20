<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Move;
use App\User;
use App\DetailUser;
use App\Area;
use App\Store;
use Auth;
use App\ProductStore;
use App\Status;


class MoveController extends Controller
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

    public function index() // for move group
    {
        $detailuser = User::find(Auth::id())->detailuser;
        $area = Area::find($detailuser->area_id);
        $store = Store::where('area_id','=',$detailuser->area_id)->with('area','pop','productstore')->get();

        // dd($store);exit;
        // $pop = Pop::where('area_id','=',$detailuser->area_id)->get();
        // $alls = DB::table('pop')
        // ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        // ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        // ->where('area_id', $detailuser->area_id)
        // ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        // ->groupBy('product.id','product.name')
        // ->get();
        return view('move.index',compact('store','area'))
            ->with('i');
    }
    // public function index()
    // {
    //     $area = Area::all();
    //     return view('area.index',compact('area'))
    //         ->with('i');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $from = Store::find($id);
        $product = ProductStore::where('store_id',$id)->with('product')->get();
        $store = Store::all();
        $status = Status::all();
        return view('move.create',compact('from','store','status','product'));
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
        $area = Area::find($id);
        return view('area.show',compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Area::find($id);
        return view('area.edit',compact('area'));
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
