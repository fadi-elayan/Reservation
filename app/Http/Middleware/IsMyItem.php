<?php

namespace App\Http\Middleware;

use App\Item;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Handle;

class IsMyItem
{
    public function can($id)
    {
        return  Item::findOrFail($id);
    }
    public function handle($request, Closure $next)
    {
        try
        {
            if(Auth::user()->id == ($this->can($request->route('id')))->user)
                return $next($request);
        }
        catch(Exception $e)
        {
            abort('404');
        }


    }
}
