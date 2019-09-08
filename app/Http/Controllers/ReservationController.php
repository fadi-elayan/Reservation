<?php

namespace App\Http\Controllers;

use App\Events\ReservationItem;
use App\Item;
use App\Reservation;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{

    public function index()
    {
        //
    }


    public function reservation($id , Request $request)
    {
           if(Reservation::isValed($id ,$request->all())) {
               event(new ReservationItem(Item::findOrFail($id), $request->all()));
               return redirect(url('/home'));
           }else{
               $reservations = Reservation::getReservation($id); ;
               $i =1;
               $descrabation = 'This Date Booked';
               return view('user.showDateRservationThisItem' , compact(['reservations' , 'i' , 'descrabation']));
           }
    }


   public function bookedTime($id)
   {
       $reservations = Reservation::getReservation($id);
       $i =1;
       $descrabation = '';
       $date = new Carbon();
       return view('user.showDateRservationThisItem' , compact(['reservations' , 'i' , 'descrabation' , 'date']));
   }

   public function bookedTimeForCompany($id)
   {
       $reservations = (Item::find($id))->reservation ;
       $i =1;
       $descrabation = '';
       return view('company.showDataBooked' , compact(['reservations' , 'i' , 'descrabation']));
   }

    public function destroy($id)
    {
       User::deleteUserReservation($id);
       return redirect('/home');
    }
}
