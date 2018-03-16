<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class Hr
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
        $check = User::find(Auth::id());
        $users = $check->detailuser->group_id;
        if ($users == 3) {
           return $next($request);
        }
        return redirect('home')->with('error','You have not access');
    }
}
