<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetailUser;
use Auth;
use App\User;
use App\Area;
use App\Group;

class UserController extends Controller
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
        // $area = Area::find($DetailUser->area_id);      
        $user = User::find(Auth::id())->with('areas','groups')->get();
        // dd($user);exit;
        return view('user.index',compact('user','DetailUser'))
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
        $group = Group::all();
        $area = Area::all();
        return view('user.create',compact('group', 'area', 'user','DetailUser'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'area_id' => 'required|integer',
            'group_id' => 'required|integer',
            'active' => 'required|boolean',
        ]);
        $User = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'active' => $request['active'],
        ]);
        if($User->save())
        {
            $input = $request->all();
            for ($i=0; $i < count($input['area_id']); ++$i)
            {
                $DetailUser= new DetailUser;
                $DetailUser->user_id = $User->id;
                $DetailUser->area_id = $input['area_id'][$i];
                $DetailUser->group_id= $input['group_id'][$i];
                $DetailUser->save();  
            }
            return redirect()->route('user.index')
                        ->with('success','created successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}