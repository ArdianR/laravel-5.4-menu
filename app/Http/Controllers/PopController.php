<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pop;
use App\Area;
use App\Group;
use App\Store;
use App\Status;
use App\Product;
use App\DetailUser;
use App\DetailPop;
use App\PhotoPop;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use File;
use DB;

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
    public function index1() // for admin grou
    {
        $store = Store::all();
        return view('pop.index',compact('store'))
            ->with('i');
    }

    public function index2() //for hq group
    {
        $area = Area::all();
        return view('pop.indexHq',compact('area'))
            ->with('i');
    }

    public function index3() // for hr group
    {
        $detailuser = User::find(Auth::id())->detailuser;
        $area = Area::find($detailuser->area_id);
        $store = Store::where('area_id','=',$detailuser->area_id)->with('area')->get();
        $pop = Pop::where('area_id','=',$detailuser->area_id)->get();
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('area_id', $detailuser->area_id)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();
        return view('pop.index3',compact('alls','store','area','pop'))
            ->with('i');
    }

    public function list3()
    {
        $detailuser = User::find(Auth::id())->detailuser;
        $area = Area::find($detailuser->area_id);
        $store = Store::where('area_id','=',$detailuser->area_id)->get();
        $pop = Pop::where('area_id','=',$detailuser->area_id)->with('user')->get();
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('area_id', $detailuser->area_id)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();
        return view('pop.list3',compact('alls','store','area','pop'))
            ->with('i');
    }

    public function listPopHq()
    {
        $users = Auth::user()->detailuser()->get();
        $pop = Pop::all();
        return view('pop.listpophq',compact('pop'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //for admin group
    {
        return ('oke');
    }

    public function create3($id) // for hr group
    {
        $user_id = Auth::id();
        $detailuser = DetailUser::where('user_id',$user_id)->first();
        $area = Area::all();
        $store_id = $id;
        $store = Store::all();
        $status = Status::all();
        $product = Product::all();
        $group = Group::all();
        return view('pop.create3',compact('group','status','product','user_id','store_id','area','detailuser','store'))
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

    public function storeHr(Request $request)
    {
        $this->validate($request, [
            'periode' => 'required|integer',
            'user_id' => 'required|integer',
            'area_id' => 'required|integer',
            'group_id' => 'required|integer',
            'store_id' => 'required|integer',
            'posisi' => 'required|integer',
            'ukuran' => 'required|integer',
            'note' => '',
            'status_id' => 'required|integer',
            'active' => 'required|boolean',
            'type' => 'required|integer',
            'photo' => 'required',
            'product_id' => 'required',
            'qty' => 'required'
        ]);
        $pop = new Pop;
        $pop->periode = $request->periode;
        $pop->user_id = $request->user_id;
        $pop->area_id = $request->area_id;
        $pop->group_id = $request->group_id;
        $pop->store_id = $request->store_id;
        $pop->posisi = $request->posisi;
        $pop->ukuran = $request->ukuran;
        $pop->note = $request->note;
        $pop->status_id = $request->status_id;
        $pop->active = $request->active;
        if ($pop->save())
        {
            $id = $pop->id;
            $input = $request->all();
            for ($i=0; $i < count($input['product_id']); ++$i)
            {
                $detailpop= new DetailPop;
                $detailpop->pop_id = $id;
                $detailpop->product_id = $input['product_id'][$i];
                $detailpop->qty= $input['qty'][$i];
                $detailpop->save();  
            }
        }

        if ($request->hasFile('photo'))
        {
            $id = $pop->id;
            $store_id = $pop->store_id;
            $input = $request->all();

            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/'.$store_id;
                Storage::makeDirectory($imgPath, $mode = 0775, true);
                $imgDestinationPath = $imgPath.'';
                $filename = $photo->store($imgDestinationPath);
                PhotoPop::create([
                    'pop_id' => $id,
                    'type' => $request->type,
                    'photo' => $filename
                ]);
            }
        }
        return redirect()->action('PopController@index3')
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
        return ('oke');
    }

    public function showAreaHq($id)
    {
        $area = Area::find($id);
        $store = Store::where('area_id','=',$id)->get();
        return view('pop.showAreaHq',compact('store','area'))
            ->with('i');
    }

    public function show3($id) // show pop for hr group
    {
        
        $pop = Pop::find($id);
        $photopop = PhotoPop::where('pop_id',$id)->get();
        $detailpop = DetailPop::where('pop_id',$id)->get();
        $area = Area::all();
        $store = Store::all();
        $status = Status::all();
        $group = Group::all();
        return view('pop.show3',compact('detailpop','pop','area','group','store','status','photopop'))
            ->with('i');
    }

    public function showPopHq($id)
    {
        
        $pop = Pop::find($id);
        $photopop = PhotoPop::where('pop_id',$id)->get();
        $detailpop = DetailPop::where('pop_id',$id)->get();
        $area = Area::all();
        $store = Store::all();
        $status = Status::all();
        $group = Group::all();
        return view('pop.showPopHq',compact('detailpop','pop','area','group','store','status','photopop'))
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
