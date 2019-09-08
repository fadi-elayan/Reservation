<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table  = 'reservation';
    protected $fillable = [
        'user',
        'from',
        'to',
        'time_from',
        'time_to',
    ] ;

    public static function confiremResrvation($data)
    {
       $item = (Item::find($data->item_id));
       $reservation = new Reservation();
       $reservation->user = $data->user_id;
       $reservation->from = $data->from;
       $reservation->to = $data->to;
       $reservation->time_from = $data->from_time;
       $reservation->time_to = $data->to_time;
       $item->reservation()->save($reservation);
    }

    public static function check($data ,$reservation)
    {

        $start = Carbon::make($data['from']);
        $end = Carbon::make($data['to']);
        $start_time =  Carbon::make($data['to_time']);
        $end_time =  Carbon::make($data['from_time']);
         if(($start == $end) && ($reservation->from == $reservation->to) && ($start->toDateString() == $reservation->from))
             return ($start_time->between($reservation->time_from , $reservation->time_to) || $end_time->between($reservation->time_from , $reservation->time_to)) ||
                 (Carbon::make($reservation->time_to)->between($start_time , $end_time) || Carbon::make($reservation->time_from)->between($start_time , $end_time));

         if(($start->toDateString() == $reservation->to))
             return $start_time <= $reservation->time_to;

         if ($end == $reservation->from)
             return $end_time >= $reservation->time_from;

         return $start->between($reservation->from , $reservation->to) || $end->between($reservation->from , $reservation->to);


    }
    public static function isValed($id , $data)
    {
        $reservations = Item::find($id)->reservation;
        foreach ($reservations as $reservation){
            if(self::check($data , $reservation))
                return false;
        }
        if(Carbon::make($data['from']) < Carbon::now() || Carbon::make($data['to']) < Carbon::make($data['from']))
            return false;
          return true;
    }

    public static function getReservation($id)
    {
        return  self::where('reservation_id' , $id)->orderBy('created_at', 'DESC')->paginate(10);
    }
}
