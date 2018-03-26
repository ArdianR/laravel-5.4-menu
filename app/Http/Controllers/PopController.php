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
use App\ProductStore;
use App\Move;
use App\DetailMove;
use App\PhotoMove;


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
        $move = Move::where('area_id',Auth::user()->detailuser->area_id)->get();
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('area_id', Auth::user()->detailuser->area_id)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();
        return view('pop.index3',compact('alls','store','area','pop','move'))
            ->with('i');
    }

    public function list2() // list pop for hq group
    {
        //$users = Auth::user()->detailuser()->get();
        $pop = Pop::orderBy('created_at', 'desc')->with('area','group','status','store','user')->get();
        return view('pop.list2',compact('pop'))
            ->with('i');
    }

    public function list22() // list pop for hq group
    {
        $move = Move::orderBy('created_at', 'desc')
            // ->where('status_id','!=',8)
            // ->where('status_id','!=',9)
            // ->where('status_id','!=',11)
            // ->where('status_id','!=',12)
            ->with('area','fromstore','tostore','status')->get();
        return view('pop.list22',compact('move'))
            ->with('i');
    }

    public function list3() // list pop for hr group
    {
        $store = Store::where('area_id','=',Auth::user()->detailuser->area_id)->get();
        $pop = Pop::where('area_id','=',Auth::user()->detailuser->area_id)->with('user','group','area','store','status')->orderBy('created_at', 'desc')->get();
        // $move = Move::where('area_id','=',Auth::user()->detailuser->area_id)->with('user','group','area','store','status')->orderBy('created_at', 'desc')->get();
        $alls = DB::table('pop')
        ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        ->where('area_id', Auth::user()->detailuser->area_id)
        ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        ->groupBy('product.id','product.name')
        ->get();

        return view('pop.list3',compact('alls','store','area','pop'))
            ->with('i');
    }

    public function list33() // list pop for hr group
    {
        $store = Store::where('area_id','=',Auth::user()->detailuser->area_id)->get();
        $move = Move::where('area_id','=',Auth::user()->detailuser->area_id)->with('user')->orderBy('created_at', 'desc')->get();
        // dd($move);


        // $alls = DB::table('pop')
        // ->leftjoin('detail_pop', 'pop.id', '=', 'detail_pop.pop_id')
        // ->leftjoin('product', 'detail_pop.product_id', '=', 'product.id')
        // ->where('area_id', Auth::user()->detailuser->area_id)
        // ->select('product.id as id','product.name as name', DB::raw("sum(detail_pop.qty) as sum"))
        // ->groupBy('product.id','product.name')
        // ->get();

        return view('pop.list33',compact('store','move'))
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

    public function create3($id)
    {
        $id;
        $store = Store::where('area_id',Auth::user()->detailuser->area_id)->get();
        $product = Product::all();
        return view('pop.create3',compact('product','id','store'))
            ->with('i');
    }

    public function create33($id)
    {
        $from = Store::find($id);
        $pops = Pop::where('store_id',$id)->where('status_id',6)->get();

        // $product = DB::table('product_store')
        // ->leftjoin('product', 'product_store.product_id', '=', 'product.id')
        // ->where('store_id', $id)
        // ->get();
        // $store2 = ProductStore::where('store_id',$id)->get();
        $store = Store::where('area_id',Auth::user()->detailuser->area_id)->get();
        return view('pop.create33',compact('from','pops','store2','store'))
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
            'periode_id' => 'required|integer',
            'user_id' => 'required|integer',
            'area_id' => 'required|integer',
            'store_id' => 'required|integer',
            'posisi' => 'required|integer',
            'ukuran' => 'required|integer',
            'active' => 'required|boolean',
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'product_id.*' => 'required|different:product_id',
            'qty' => 'required|array:integer'
        ]);
        $pop = Pop::create($request->all());
        if ($pop->save())
        {
            $input = $request->all();
            for ($i=0; $i < count($input['product_id']); ++$i)
            {
                $detailpop= new DetailPop;
                $detailpop->pop_id = $pop->id;
                $detailpop->product_id = $input['product_id'][$i];
                $detailpop->qty= $input['qty'][$i];
                $detailpop->save();  
            }
        }
        if ($request->hasFile('photo'))
        {
            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/pop/'.$pop->id;
                Storage::makeDirectory($imgPath, $mode = 0775, true);
                $filename = $photo->store($imgPath);
                $filename = $photo->store($imgPath);
                PhotoPop::create([
                    'pop_id' => $pop->id,
                    'type' => 1,
                    'photo' => $filename
                ]);
            }
        }
        return redirect()->action('PopController@list3')
            ->with('success','created pop successfully');
    }

    public function store33(Request $request)
    {
        $this->validate($request, [
            'from_store_id' => 'required|integer',
            'user_id' => 'required|integer',
            'area_id' => 'required|integer',
            'note' => 'required|string',
            'status_id' => 'required|integer',
            'to_store_id' => 'required|integer',
            'product_id.*' => 'required|different:product_id',
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
        return redirect()->action('PopController@list33')
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

    public function show33($id) // show pop for hr group
    {
        $move = Move::find($id);
        $detailmove = DetailMove::where('move_id',$id)->with('product')->get();
        $photomove = PhotoMove::where('move_id',$id)->get();
        return view('pop.show33',compact('move','detailmove','photomove'))
            ->with('i');
    }

    public function show22($id)
    {
        $pop = Pop::find($id);
        $detailpop = DetailPop::where('pop_id',$id)->get();
        return view('pop.show22',compact('detailpop','pop'))
            ->with('i');
    }

    public function show222($id)
    {
        $move = Move::find($id);
        $detailmove = DetailMove::where('move_id',$id)->get();
        $photomove = PhotoMove::where('move_id',$id)->get();
        return view('pop.show222',compact('detailmove','move','photomove'))
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

    public function edit33($id)
    {
        $move = Move::find($id);
        $photomove = PhotoMove::where('move_id',$id)->get();
        $detailmove = DetailMove::where('move_id',$id)->get();
        // $area = Area::all();
        $store = Store::where('area_id',Auth::user()->detailuser->area_id)->get();
        // $status = Status::all();
        // $group = Group::all();
        return view('pop.edit33',compact('detailmove','move','area','group','store','status','photomove'))
            ->with('i');
    }

    public function edit4($id)
    {
        $pop = Pop::find($id);
        $photopop = PhotoPop::where('pop_id',$id)->get();
        $detailpop = DetailPop::where('pop_id',$id)->get();
        $area = Area::all();
        $store = Store::all();
        $status = Status::all();
        $group = Group::all();
        return view('pop.edit4',compact('detailpop','pop','area','group','store','status','photopop'))
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
            'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        if ($request->type == 1)
        {
            $imgPath = 'images/pop/'.$id;
            File::deleteDirectory($imgPath);
            PhotoPop::where('pop_id',$id)->delete();
            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/pop/'.$id;
                Storage::makeDirectory($imgPath, $mode = 0775, true);
                $filename = $photo->store($imgPath);
                PhotoPop::create([
                    'pop_id' => $id,
                    'type' => $request->type,
                    'photo' => $filename
                ]);
            }
            $pop = Pop::where('id',$id)->update(['status_id' => 1]);
        }
        if ($request->type == 2)
        {
            $file = PhotoPop::where('pop_id',$id)->where('type',2)->get();
            foreach ($file as $file) {
                Storage::delete($file->photo);
            }
            PhotoPop::where('pop_id',$id)->where('type',2)->delete();
            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/pop/'.$id;
                $filename = $photo->store($imgPath);
                PhotoPop::create([
                    'pop_id' => $id,
                    'type' => $request->type,
                    'photo' => $filename
                ]);
            }
            $pop = Pop::where('id',$id)->update(['status_id' => 4]);
        }
        return redirect()->action('PopController@list3')
            ->with('success','update successfully');
    }

    public function update33(Request $request, $id)
    {
        if ($request->status == 8) {
            $this->validate($request, [
                'to_store_id' => 'required|integer',
            ]);
            $move = Move::where('id',$id)->update([
                'status_id' => 7,
                'to_store_id' => $request->to_store_id,
            ]);          
        }
        if ($request->status == 9) {
            $this->validate($request, [
                'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);
            $file = PhotoMove::where('move_id',$id)->where('type',1)->get();
            foreach ($file as $file) {
                Storage::delete($file->photo);
            }
            PhotoMove::where('move_id',$id)->where('type',1)->delete();
            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/move/'.$id;
                Storage::makeDirectory($imgPath, $mode = 0775, true);
                $filename = $photo->store($imgPath);
                PhotoMove::create([
                    'move_id' => $id,
                    'type' => 1,
                    'photo' => $filename
                ]);
            }
            $move = Move::where('id',$id)->update(['status_id' => 10]);
        }
        if ($request->status == 12) {
            $this->validate($request, [
                'photo.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $file = PhotoMove::where('move_id',$id)->where('type',2)->get();
            foreach ($file as $file) {
                Storage::delete($file->photo);
            }
            PhotoMove::where('move_id',$id)->where('type',2)->delete();
            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/move/'.$id;
                $filename = $photo->store($imgPath);
                PhotoMove::create([
                    'move_id' => $id,
                    'type' => 2,
                    'photo' => $filename
                ]);
            }
            $move = Move::where('id',$id)->update(['status_id' => 14]);
        }
        return redirect()->action('PopController@list33')
            ->with('success','update successfully');
    }


    public function update4(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'required'
        ]);
        if ($request->hasFile('photo'))
        {
            $files = $request->photo2;
            File::delete($files);
            PhotoPop::where('pop_id',$id)->where('type',2)->delete();
            foreach ($request->photo as $photo)
            {
                $imgPath = 'images/'.$request->store_id;
                $imgDestinationPath = $imgPath.'';
                $filename = $photo->store($imgDestinationPath);
                PhotoPop::create([
                    'pop_id' => $id,
                    'type' => $request->type,
                    'photo' => $filename
                ]);
            }
        }
        $pop = Pop::where('id',$id)->update(['status_id' => 11]);
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
        if ($request->approve_pop) {
            $pop = Pop::findOrFail($id)->update([
                'status_id' => '3',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list2')
                ->with('success','Approve POP successfully');              
        } 
        if ($request->reject_pop) {
            $pop = Pop::findOrFail($id)->update([
                'status_id' => '2',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list2')
                ->with('warning','Reject POP successfully');
        } 
        if ($request->pop_done) {
            $pop = Pop::findOrFail($id)->update([
                'status_id' => '6',
                'note' => $request->note,
            ]);
            // $detailpops = detailpop::where('pop_id',$id)->get();

            // $productstore = ProductStore::where('store_id',$request->store_id)->get();
            // if ($productstore->isEmpty()) {
            //     foreach ($detailpops as $detailpop) {
            //         $productstore = new ProductStore;
            //         $productstore->store_id = $request->store_id;
            //         $productstore->product_id = $detailpop->product_id;
            //         $productstore->qty= $detailpop->qty;
            //         $productstore->save(); 
            //         dd('test');   
            //     }
            // }
            // dd('ada');
            
           // dd($detailpops);
            // foreach ($detailpops as $detailpop) {
            //     // dd($detailpop->product_id,$detailpop->qty);    
            // }
            // dd($request->store_id);
            return redirect()->action('PopController@list2')
                ->with('success','POP Done successfully');
        }
        if ($request->reject_pp) {
            $pop = Pop::findOrFail($id)->update([
                'status_id' => '5',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list2')
                ->with('success','Reject POP successfully');
        } 
        if ($request->approve_move) {
            $move = Move::findOrFail($id)->update([
                'status_id' => '9',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list22')
                ->with('success','Approve Move successfully');
        }
        if ($request->reject_move) {
            $move = Move::findOrFail($id)->update([
                'status_id' => '8',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list22')
                ->with('warning','Reject Move successfully');
        }
        if ($request->approve_upload) {
            $move = Move::findOrFail($id)->update([
                'status_id' => '12',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list22')
                ->with('success','Approve Move successfully');
        }
        if ($request->reject_upload) {
            $move = Move::findOrFail($id)->update([
                'status_id' => '11',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list22')
                ->with('warning','Reject Move successfully');
        } 
        if ($request->approve_bukti) {
            // $product = Move::where('id',$id)->with('detailmove')->get();
            // foreach ($product as $product) {
            //     foreach ($product->detailmove as $detailmove) {
            //         dd($detailmove->product_id);
            //     }
            // }
            // dd($product);
            $move = Move::findOrFail($id)->update([
                'status_id' => '15',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list22')
                ->with('success','Move Done successfully');
        }
        if ($request->reject_bukti) {
            $move = Move::findOrFail($id)->update([
                'status_id' => '13',
                'note' => $request->note,
            ]);
            return redirect()->action('PopController@list22')
                ->with('warning','Reject Move successfully');
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

    public function history2($id) //  for hq group
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
        return view('pop.history2',compact('pop','store','alls'))
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
