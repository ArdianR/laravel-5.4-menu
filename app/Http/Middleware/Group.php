<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\DetailUser;
use Auth;

class Group
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $detailuser = DetailUser::where('user_id',Auth::id())->get()->toArray();
        dd($detailuser);exit;
        return $next($request);
    }
}
