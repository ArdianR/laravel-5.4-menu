<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    
    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    
    public function DataStore()
    {
        return Datatables::of(Store::query())->make(true);
    }
}
