<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Area;
use App\DetailUser;

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
        $user = User::with('DetailUser')->get();
        return view('user.index',compact('user'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = Group::all();
        $area = Area::all();
        return view('user.create',compact('group', 'area'));
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
        $DetailUser = DetailUser::where('user_id',$id)->first();
        $User = User::findOrFail($id);
        $Group = Group::all();
        $Area = Area::all();
        return view('user.show',compact('User','DetailUser','Group','Area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $DetailUser = DetailUser::where('user_id',$id)->first();
        $user = User::findOrFail($id);
        $group = Group::all();
        $area = Area::all();
        return view('user.edit',compact('user', 'group', 'area','DetailUser'));
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
        $users = User::find($id);
        return view('users.edit',compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index')
                        ->with('success','deleted successfully');
    }
}
