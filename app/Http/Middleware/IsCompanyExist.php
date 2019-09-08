<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class IsCompanyExist
{
    public function can($id)
    {
        return User::findOrFail($id);
    }
    public function handle($request, Closure $next)
    {
        try{
            $company = $this->can($request->route('id'));
            if($company->is_a == 2 )
              return $next($request);
            else
                abort(404);
        }catch (Exception $e){
             abort(404);
        }
    }
}
