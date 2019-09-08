<?php

namespace App\Http\Middleware;

use App\Item;
use Closure;
use App\Exceptions\Handle;

class IsExicst
{
    public function can($id)
    {
         return Item::findOrFail($id);
    }
    public function handle($request, Closure $next)
    {
        try {

              if (($this->can($request->route('id')))->id)
                return $next($request);
        }catch (Exception $e){
             abort(404);
        }
    }
}
