<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Factory extends Model
{
    /*
         This class can use to determaint the type of the object which receives
    */
    public static function determint(Request $request)
    {
        if ($request->input('typeOf') == 'Car')
        {
            return  Car::insertCar($request->all() , new Car());

        }elseif($request->input('typeOf') == 'Flat')
        {
            return Flat::insertFlat($request->all()  , new Flat());

        }elseif ($request->input('typeOf') == 'Hold')
        {
            return  Hold::insertHold($request->all() , new Hold());
        }
    }
}
