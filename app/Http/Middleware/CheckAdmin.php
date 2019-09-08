<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{

    public function handle($request, Closure $next)
    {
        if(Auth::user()->is_a == 1)
           return $next($request);
        else
            return redirect('/home');
    }
}
