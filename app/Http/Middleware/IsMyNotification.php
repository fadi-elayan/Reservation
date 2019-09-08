<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exceptions\Handle;

class IsMyNotification
{
    public function can($id)
    {

        $notify = DB::table('notifications')->where('id' , $id)->get();
        if($notify->isEmpty())
            return false;
        if ($notify[0]->notifiable_id == Auth::user()->id){
            return true;
        }else{
            return false;
         }
    }
    public function handle($request, Closure $next)
    {
        try {
            if($this->can($request->route('id')))
               return $next($request);
            else
                abort(404);
        }catch (Exception $e)
        {
            abort(404);
        }
    }
}
