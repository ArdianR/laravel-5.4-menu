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
        $users = User::all();
        return view('user.index',compact('users'))
            ->with('i');
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

    public function active()
    {
        $user = User::all();
        return view('user.active',compact('user'));
    }

    public function set(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|array:integer',
            'active' => 'required|boolean',
        ]);
        $user = User::whereIn('id',$request->user_id)->update([
            'active' => $request->active
        ]);
        return redirect()->action('UserController@index')
            ->with('success','Non Activated successfully');
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
            'area_id' => 'required',
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
            $area_id = $request->input('area_id');
            $area_id = implode(',', $area_id);

            $DetailUser= new DetailUser;
            $DetailUser->user_id = $User->id;
            $DetailUser->area_id = $area_id;
            $DetailUser->group_id= $request->input('group_id');
            $DetailUser->save();

            return redirect()->action('UserController@index')
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
        $users = User::findOrFail($id);
        $detailuser = User::findOrFail($id)->detailuser;
        $group = Group::all();
        $area = Area::all();
        $area_id = explode(',', $detailuser->area_id);
        return view('user.show',compact('users','detailuser','group','area','area_id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        $detailuser = User::findOrFail($id)->detailuser;
        $group = Group::all();
        $area = Area::all();
        $area_id = explode(',', $detailuser->area_id);
        return view('user.edit',compact('users', 'group', 'area','area_id'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'area_id' => 'required',
            'group_id' => 'required|integer',
            'active' => 'required|boolean',
        ]);
        $users = User::find($id)->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'active' => $request['active'],
        ]);
        $detailuser = DetailUser::where('user_id',$id)->update([
            'area_id' => implode(',', $request['area_id']),
            'group_id' => $request['group_id'],
        ]);
        return redirect()->action('UserController@index')
            ->with('success','created successfully');
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
        return redirect()->action('UserController@index')
                        ->with('success','deleted successfully');
    }
}
