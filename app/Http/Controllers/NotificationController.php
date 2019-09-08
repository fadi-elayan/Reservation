<?php

namespace App\Http\Controllers;

use App\Events\AceeptReservation;
use App\Events\RejectReservation;
use App\Notifications\ReservationReject;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function read($id)
    {
        foreach (Auth::user()->unreadNotifications as $notification)
            if ($notification->id == $id) {
                $notification->markAsRead();
                break;
            }
    }
    public function show($id)
    {
        $notif = DB::table('notifications')->where('id' , $id)->get();
        $date = new Carbon();
        $notif = $notif[0];
        return view('notify.show',compact(['notif' , 'date']));
    }

    public function accept($id)
    {
        $notif = DB::table('notifications')->where('id' , $id)->get()[0];
        event(new AceeptReservation($notif));
        return redirect(url('/company'));
    }

    public function reject($id)
    {
        $notif = DB::table('notifications')->where('id' , $id)->get()[0];
        event(new RejectReservation($notif));
        return redirect(url('/company'));
    }

    public function showForUser($id)
    {

        $notif = DB::table('notifications')->where('id' , $id)->get();
        $date = new Carbon();
        $notif = $notif[0];
        $this->read($id);
        return view('notify.showUser',compact(['notif' , 'date']));
    }
    public function allNotificationForUser()
    {
        $notifications = DB::table('notifications')
            ->where('notifiable_id' , Auth::user()->id)
            ->orderBy('created_at' , 'DESC')->paginate(10);
        $i = 1 ;
        $date = new Carbon();
        return view('notify.allNotificationForUser' , compact(['i' , 'date','notifications']));
    }
}
