<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    protected $table = 'item';
    protected $fillable = [
        'price','user' , 'decrabtion'
    ];

    public function item()
    {
        return $this->morphTo();
    }

    public function reservation()
    {
        return $this->morphMany('App\Reservation', 'reservation');
    }

    public static function insertItem($request , $item)
    {
        $data = $request->all();
        $items = new Item();
        $items->price = $data['price'];
        $items->user = Auth::user()->id;
        $items->decrabtion = $data['decrabtion'];
        $item->save();
        $item->item()->save($items);
        $fil = $request->file('file');
        foreach ($fil as $file)
        {
            $image = Image::uploadPhoto($file);
            $item->photo()->save($image);
        }
    }
    public static function getItemForUser($user = 0)
    {

         if($user != 0 )
             return self::where('user' , $user)->orderBy('created_at', 'DESC')->paginate(5);
         else
             return self::orderBy('created_at', 'DESC')->paginate(5);
    }

    public static function search($key)
    {

       $user = self::where('decrabtion', 'like' , '%'.$key[0].'%');
           foreach ($key as $keys => $value)
           {
               $user = $user->orWhere('decrabtion', 'like' , '%'.$value.'%');;
           }
        return $user->orderBy('created_at', 'DESC')->paginate(5);
    }


}
