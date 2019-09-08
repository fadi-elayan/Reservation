<?php

namespace App\Http\Middleware;

use App\Image;
use App\Item;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Handle;

class IsMyImage
{
    public function can($id)
    {
        try
        {
            if (Item::where('item_id', (Image::findOrFail($id))->imageable->id)->get()[0]->user == Auth::user()->id) {
                return true;
            }
        }catch (Exception $e)
        {
            return false;
        }
    }
    public function handle($request, Closure $next)
    {
        if($this->can($request->route('id')))
           return $next($request);
        else
            abort(404);

    }
}
