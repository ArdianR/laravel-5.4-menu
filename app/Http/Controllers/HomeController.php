<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AreaUser;
use App\MenuUser;
use App\User;
use App\Area;
use App\Menu;
use App\SubMenu;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = User::where('id',Auth::id())->with('AreaUser','MenuUser')->get()->toArray();
        dd($all);exit;
        return view('home');
    }
}
