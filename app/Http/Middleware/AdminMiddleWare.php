<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminMiddleWare
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
        if (Auth::check()) {
            if (Auth::user()->role_id!=4) {
                return $next($request);
            }else{
                return redirect('admin/login')->with('info', 'You must be logged in!');
            }     
        }else{
            return redirect('admin/login')->with('info', 'You must be logged in!');
        }
    }
}
