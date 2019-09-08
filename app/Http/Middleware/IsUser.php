<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsUser
{

    public function handle($request, Closure $next)
    {
        if(Auth::user()->is_a == 0)
            return $next($request);
        else
            return redirect('/company');
    }
}
