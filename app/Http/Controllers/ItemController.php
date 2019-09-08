<?php

namespace App\Http\Controllers;

use App\Events\ItemUpload;
use App\Image;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ItemController extends Controller
{
    public function checkItem($type)
    {
        if ($type == 'Car')
        {
            return [
                'color' => 'required|max:30|alpha',
                'type' => 'required|max:30|alpha',
                'price' => 'required|int',
                'board_number' =>'required',
                'decrabtion'=>'required'
            ];

        }elseif($type == 'Flat')
        {
            return [
                'size' => 'required|int',
                'unit' => 'required|alpha',
                'location' => 'required',
                'price' => 'required|digits:3',
                'number_of_room' => 'required|int',
                'decrabtion'=>'required'
            ];

        }elseif ($type == 'Hold')
        {
            return [
                'size' => 'required|int',
                'unit' => 'required|alpha',
                'location' => 'required',
                'price' => 'required|digits:3',
                'number_of_armchare' => 'required|int',
                'decrabtion' => 'required'
            ];
        }
    }


    public function create()
    {
        return view('company.item');
    }


    public function store(Request $request)
    {

        $validate =  Validator::make($request->all() ,$this->checkItem($request->input('typeOf')));

        if($validate->fails()) {
            return response()->json(['error' => $validate->errors()]);
           }

          event(new ItemUpload($request));
        return response()->json(['sec'=>'sec']);
    }

    public function display($id)
    {
        $items = Item::find($id);
        $i = $j = 0;
        return view('item.showOneItem' , compact(['items' , 'i' , 'j']));
    }
    public function show($id)
    {
       $item = Item::getItemForUser(Auth::user()->id);
       $date = new Carbon();
       return view('item.show' , compact(['item','date']));
    }



    public function delete($id)
    {
        $photo = Image::find($id);
        Image::deleteImage($photo);
        return redirect(url('show/company/item',Auth::user()->id));
    }

    public function destroy($id)
    {
        $itme = Item::find($id);
        if($itme->reservation->isEmpty()) {
            foreach ($itme->item->photo as $photo)
                Image::deleteImage($photo);
            $itme->item->delete();
            $itme->delete();
        }
        return redirect(url('show/company/item',Auth::user()->id));
    }
}
