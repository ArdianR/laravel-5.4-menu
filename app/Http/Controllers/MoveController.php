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
use App\DetailMove;
use Illuminate\Support\Facades\DB;


class MoveController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('move');
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
        $product = DB::table('product_store')
        ->leftjoin('product', 'product_store.product_id', '=', 'product.id')
        ->where('store_id', $id)
        ->get();
        $store2 = ProductStore::where('store_id',$id)->get();
        $store = Store::where('area_id',Auth::user()->detailuser->area_id)->get();
        return view('move.create',compact('from','store','product','store2'))->with('i');
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
            'from_store_id' => 'required|integer',
            'user_id' => 'required|integer',
            'area_id' => 'required|integer',
            'note' => 'required|string',
            'status_id' => 'required|integer',
            'to_store_id' => 'required|integer',
            'product_id' => 'required|array:integer',
            'qty' => 'required|array:integer',
            'active' => 'required|boolean'
        ]);
        $move = Move::create($request->all());
        if($move->save())
        {
            $id = $move->id;
            $input = $request->all();
            for ($i=0; $i < count($input['product_id']); ++$i)
            {
                $detailmove= new DetailMove;
                $detailmove->move_id = $id;
                $detailmove->product_id = $input['product_id'][$i];
                $detailmove->qty= $input['qty'][$i];
                $detailmove->save();  
            }
        }
        return redirect()->action('MoveController@index')
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
        $move = Move::find($id);
        return view('move.show',compact('move'));
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

    public function list() // list move for move group
    {
        $move = Move::orderBy('created_at', 'desc')->with('user','area','status','fromstore','tostore')->get();
        return view('move.list',compact('move'))
            ->with('i');
    }
}
