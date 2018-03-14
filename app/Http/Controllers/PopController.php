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
use Auth;

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
    public function index()
    {
        $store = Store::all();
        return view('pop.index',compact('store'))
            ->with('i');
    }

    public function indexHq()
    {
        $area = Area::all();
        return view('pop.indexHq',compact('area'))
            ->with('i');
    }

    public function indexHr()
    {
        $users = Auth::user()->detailuser()->get();
        $area = Area::find($users[0]->area_id);
        $store = Store::where('area_id','=',$users[0]->area_id)->get();
        $pop = Pop::where('area_id','=',$users[0]->area_id)->get();
        return view('pop.indexhr',compact('store','area','pop'))
            ->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return ('oke');
    }

    public function createHr($id)
    {
        $user_id = Auth::id();
        $detailuser = DetailUser::where('user_id',$user_id)->first();
        $area = Area::all();
        $store_id = $id;
        $store = Store::all();
        $status = Status::all();
        $product = Product::all();
        $group = Group::all();
        return view('pop.createHr',compact('group','status','product','user_id','store_id','area','detailuser','store'))
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
            // $input = $request->all();

            // foreach ($request->photo as $photo)
            // {
            //     $filename = $photo->store('images');
            //     PhotoPop::create([
            //         'pop_id' => $id,
            //         'type' => $request->type,
            //         'photo' => $filename
            //     ]);
            // }

            $input = $request->all();
            $photo = array();


            foreach ($request->photo as $photo)
            {
                $name=$photo->getClientOriginalName();
                $photo->move('image',$name);
                $images[]=$name;

                $random = md5($photo);
                $imageName = time().$random;
                $imgPath = 'images/'.$store_id;
                Storage::makeDirectory($imgPath, $mode = 0775, true);
                $imgDestinationPath = $imgPath.'/';
                $uploaded = $file->move($imgDestinationPath, $imageName.'.png');
                $photopop->pop_id = $id;
                $photopop->type = $request->type;
                $photopop->photo = $imageName;
                $photopop->save();
            }

            dd($photopop);exit;
            dd($files=$request->file('photo'));exit;
            /*Insert your data*/

            Detail::insert( [
                'images'=>  implode("|",$images),
                'description' =>$input['description'],
                //you can put other insertion here
            ]);


            return redirect('redirecting page');

            // $file = $input['photo'][$i];
            // $random = md5($file);
            // $imageName = time().$random;
            // $imgPath = 'images/'.$store_id;
            // Storage::makeDirectory($imgPath, $mode = 0775, true);
            // $imgDestinationPath = $imgPath.'/';
            // dd($imgDestinationPath);exit;
            // $uploaded = $file->move($imgDestinationPath, $imageName.'.png');
            //  $pops->photo = $imageName;


            
        }
        return redirect()->action('PopController@indexHr')
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
