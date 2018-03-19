<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Area;
use App\Product;
use App\ProductStore;
use Datatables;

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
        $store = Store::with('area')->limit(10)->get();
        return view('store.index',compact('store'))
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
        return view('store.create',compact('area'));
    }

    public function create1($id)
    {
        $store = Store::find($id);
        $area = Area::all();
        $product = Product::all();
        return view('store.create1',compact('store','area','product'));
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
        $store = Store::find($id);
        $area = Area::all();
        return view('store.show',compact('store','area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::find($id);
        $area = Area::all();
        return view('store.edit',compact('store','area'));
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



    public function productStore(Request $request)
    {
        $this->validate($request, [
            'store_id' => 'required|integer',
            'product_id' => 'required',
            'qty' => 'required'
        ]);
        $input = $request->all();
        for ($i=0; $i < count($input['product_id']); ++$i)
        {
            $ProductStore= new ProductStore;
            $ProductStore->store_id = $input['store_id'];
            $ProductStore->product_id = $input['product_id'][$i];
            $ProductStore->qty= $input['qty'][$i];
            $ProductStore->save();  
        }
        return redirect()->route('store.index')
                        ->with('success','created successfully');
    }

    public function productShow($id)
    {
        $store = Store::find($id);
        $ProductStore = ProductStore::where('store_id',$id)->get();
        return view('store.productShow',compact('store','area','ProductStore'))
            ->with('i');
    }

    public function productEdit($id)
    {
        $store = Store::find($id);
        $ProductStore = ProductStore::where('store_id',$id)->get();
        return view('store.productEdit',compact('store','ProductStore'))
            ->with('i');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productUpdate(Request $request, $id)
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

    public function productDestroy($id)
    {
        Store::find($id)->delete();
        return redirect()->route('store.index')
            ->with('success','deleted successfully');
    }
}
