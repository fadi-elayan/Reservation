<?php

namespace App\Http\Controllers;

use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{


    public function index()
    {
        $item = Item::getItemForUser();
        $date = new Carbon();
        return view('user.home' , compact(['item' , 'date']));
    }

    public function display($id)
    {
      $items = Item::find($id);
        $date = new Carbon();
      $i = $j = 0;
      return view('user.showItem' , compact(['items' , 'i' , 'j' , 'date']));
    }


   public function search(Request $request)
   {

       $words = explode(" ",$request->input('key'));
       $i = 0 ;
       $arr = array();
       $answer = Item::search($words);
           foreach ($answer as $asn) {
               $arr[$i++] = ['id' => $asn->id, 'decrabtion' => $asn->decrabtion, 'type' => substr($asn->item_type, 4)];
           }

        return response()->json($arr);
   }
   public function searchEnter($key)
   {
       $words = explode(" ",$key);
       $item = Item::search($words);
       $date = new Carbon();
       if($item->isEmpty())
           abort(404);
       return view('user.home' , compact(['item' , 'date']));
   }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
