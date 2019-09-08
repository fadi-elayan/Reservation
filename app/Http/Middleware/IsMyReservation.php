<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\Handle;
use Illuminate\Support\Facades\DB;

class IsMyReservation
{
    public function can($id)
    {
        if((DB::table('notifications')
            ->where('data' , 'like' , '%"user_id":'.strval(\Illuminate\Support\Facades\Auth::user()->id).'%')
            ->where('id' , $id)
            ->get())->isEmpty()){
            return false;
        }else{
            return true;
        }
    }

    public function handle($request, Closure $next)
    {
        try {
            if ($this->can($request->route('id')))
                return $next($request);
            else
                abort(404);
        }catch (Exception $e){
            abort(404);
        }
    }
}
