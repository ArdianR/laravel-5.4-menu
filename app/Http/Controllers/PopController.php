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
    public function index() // for admin group
    {
        $store = Store::with('area')->limit(100)->get();
        return view('pop.index',compact('store'))
            ->with('i');
    }

    public function index2() //for hq group
    {
        $area = Area::with('store','pop')->where('active','=',1)->get();
        return view('pop.index2',compact('area'))
            ->with('i');
    }

    public function index3() // for hr group
    {
        $area = Area::find(Auth::user()->detailuser->area_id);
        $store = Store::where('area_id',Auth::user()->detailuser->area_id)->with('area','pop')->get();
        $pop = Pop::where('area_id',Auth::user()->detailuser->area_id)->get();
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('area_id', Auth::user()->detailuser->area_id)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();
        return view('pop.index3',compact('alls','store','area','pop'))
            ->with('i');
    }

    // public function index4() // for move group
    // {
    //     $detailuser = User::find(Auth::id())->detailuser;
    //     $area = Area::find($detailuser->area_id);
    //     $store = Store::where('area_id','=',$detailuser->area_id)->with('area','pop')->get();

    //     // dd($area);exit;
    //     // $pop = Pop::where('area_id','=',$detailuser->area_id)->get();
    //     // $alls = DB::table('pop')
    //     // ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
    //     // ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
    //     // ->where('area_id', $detailuser->area_id)
    //     // ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
    //     // ->groupBy('product.id','product.name')
    //     // ->get();
    //     return view('pop.index4',compact('store','area'))
    //         ->with('i');
    // }

    public function list2() // list pop for hq group
    {
        $users = Auth::user()->detailuser()->get();
        $pop = Pop::orderBy('created_at', 'desc')->where('status_id', '!=', 10)->where('status_id', '!=', 2)->with('area','group','status','store','user')->get();
        return view('pop.list2',compact('pop'))
            ->with('i');
    }

    public function list3() // list pop for hr group
    {
        $detailuser = User::find(Auth::id())->detailuser;
        $area = Area::find($detailuser->area_id);
        $store = Store::where('area_id','=',$detailuser->area_id)->get();
        $pop = Pop::where('area_id','=',$detailuser->area_id)->with('user','group','area','store','status')->orderBy('created_at', 'desc')->get();
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
        // $detailuser = DetailUser::where('user_id',Auth::id())->first();
        // $area = Area::all();
        $store_id = $id;
        $store = Store::all();
        $product = Product::all();
        // $group = Group::all();
        return view('pop.create3',compact('product','store_id','store'))
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

    public function store3(Request $request) // for hr group
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

    public function show2($id) // show area for hq group
    {
        $area = Area::find($id);
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('area_id', $id)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();
        $store = Store::with('area')->where('area_id','=',$id)->get();
        $pop = Pop::where('area_id','=',$id)->get();
        return view('pop.show2',compact('store','area','alls','pop'))
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

    public function show4($id)
    {
        
        $pop = Pop::find($id);
        $photopop = PhotoPop::where('pop_id',$id)->get();
        $detailpop = DetailPop::where('pop_id',$id)->get();
        $area = Area::all();
        $store = Store::all();
        $status = Status::all();
        $group = Group::all();
        return view('pop.show4',compact('detailpop','pop','area','group','store','status','photopop'))
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

    public function edit3($id)
    {
        $pop = Pop::find($id);
        $photopop = PhotoPop::where('pop_id',$id)->get();
        $detailpop = DetailPop::where('pop_id',$id)->get();
        $area = Area::all();
        $store = Store::all();
        $status = Status::all();
        $group = Group::all();
        return view('pop.edit3',compact('detailpop','pop','area','group','store','status','photopop'))
            ->with('i');
    }

    public function edit4($id)
    {
        dd('oke');
        $pop = Pop::find($id);
        $photopop = PhotoPop::where('pop_id',$id)->get();
        $detailpop = DetailPop::where('pop_id',$id)->get();
        $area = Area::all();
        $store = Store::all();
        $status = Status::all();
        $group = Group::all();
        return view('pop.edit3',compact('detailpop','pop','area','group','store','status','photopop'))
            ->with('i');
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

    public function update3(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'required'
        ]);
        $imgPath = 'images/'.$request->store_id;
        File::deleteDirectory($imgPath);
        PhotoPop::where('pop_id',$id)->delete();
        if ($request->hasFile('photo'))
        {
            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/'.$request->store_id;
                Storage::makeDirectory($imgPath, $mode = 0775, true);
                $imgDestinationPath = $imgPath.'';
                $filename = $photo->store($imgDestinationPath);
                PhotoPop::create([
                    'pop_id' => $request->pop_id,
                    'type' => $request->type,
                    'photo' => $filename
                ]);
            }
        }
        $pop = Pop::where('id',$id)->update(['status_id' => 1]);
        return redirect()->action('PopController@index3')
            ->with('success','update successfully');
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

    public function approve(Request $request, $id) // approve & reject only for hq group
    {
        if ($request->approve) {
            $pop = Pop::findOrFail($id)->update([
                'status_id' => '9',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list2')
                ->with('success','Approve successfully');
        } elseif ($request->done) {
            $pop = Pop::findOrFail($id)->update([
                'status_id' => '10',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list2')
                ->with('success','Approve successfully');
        } else {
            $pop = Pop::findOrFail($id)->update([
                'status_id' => '2',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list2')
                ->with('warning','Reject successfully');
        }
    }

    public function history3($id) // history  per store hr group
    {
        $store = Store::findOrFail($id);
        $pop = Pop::where('store_id',$id)->where('status_id',10)->with('area','user','store','group','status')->get();
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('store_id', $id)->where('status_id', 10)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();
        return view('pop.history3',compact('pop','store','alls'))
            ->with('i');
    }

    public function history4($id) //  for hq group
    {
        $store = Store::findOrFail($id);
        $pop = Pop::where('store_id',$id)->where('status_id',10)->with('area','user','store','group','status')->get();
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('store_id', $id)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();
        return view('pop.history4',compact('pop','store','alls'))
            ->with('i');
    }

    public function history5($id)
    {
        
        $pop = Pop::find($id);
        $photopop = PhotoPop::where('pop_id',$id)->get();
        $detailpop = DetailPop::where('pop_id',$id)->get();
        $area = Area::all();
        $store = Store::all();
        $status = Status::all();
        $group = Group::all();
        return view('pop.history5',compact('detailpop','pop','area','group','store','status','photopop'))
            ->with('i');
    }

    public function move($id)
    {
        $from = Store::find($id);
        $product = ProductStore::where('store_id',$id)->with('product')->get();
        $store = Store::all();
        $status = Status::all();
        return view('move.create',compact('from','store','status','product'));
    }

}
