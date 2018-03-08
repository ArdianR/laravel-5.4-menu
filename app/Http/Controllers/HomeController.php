<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\DetailUser;
use App\Area;
use App\Group;

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
        $DetailUser = DetailUser::where('user_id',Auth::id())->first();
        // dd($DetailUser->group_id);exit;
        return view('home',compact('DetailUser'));
    }
}
