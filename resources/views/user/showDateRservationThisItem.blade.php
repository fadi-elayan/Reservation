@extends('layouts.app')
@section('nav')
    <li class="nav-item">
        <div class="d-flex justify-content-center" style="z-index: 1000;position: relative;">

            <div class="searchbar">
                <input class="search_input" type="text" name="search" id="search" placeholder="Search..." autocomplete="off">
                <a href="#" class="search_icon"><i class="fas fa-search"></i></a>

                <ul class="list-group" id="list">
                    <!--<li class="list-group-item"></li>-->

                </ul>
            </div>
        </div>
    </li>
@endsection
@section('header')
    <div class="dropdown navbar-brand">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notification <span class="badge badge-light">{{sizeof(\Illuminate\Support\Facades\Auth::user()->unreadNotifications )}}</span>
        </button>
        <div class="dropdown-menu"  style=";left: -147px;" aria-labelledby="dropdownMenu2">
            @foreach(\Illuminate\Support\Facades\Auth::user()->unreadNotifications as $notification)
                <a class="dropdown-item" style="background-color:#f8f9fa;" type="button" href="/show/user/notification/{{$notification->id}}"><img src="/image/{{(\App\Item::find($notification->data['items_id']))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive"> Reservation item is : {{(\App\Item::find($notification->data['items_id']))->item->type}}    {{\Carbon\Carbon::now()->diffForHumans($notification->created_at)}}
                    <br></a>
        @endforeach
        <!--<button class="dropdown-item badge-secondary" type="button">Another action</button>
            <button class="dropdown-item badge-secondary" type="button">Something else here</button>-->
        </div>
    </div>
    <a class="navbar-brand" href="/show/user/all/notification">
        All notification
    </a>


@endsection
@section('content')

 @if($descrabation == 'This Date Booked')
     <div class="alert alert-danger" role="alert">
         {{$descrabation}}
     </div>
     @elseif($descrabation != '')
     <div class="alert alert-success" role="alert">
         {{$descrabation}}
     </div>
     @endif



<div class="container">
    <table class="table table-striped table-bordered table-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">Days / Hours</th>
            <th scope="col">Since</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reservations   as $reservation)
            <tr>
                <th scope="row">{{$i++}}</th>
                <td>{{$reservation->from}}</td>
                <td>{{$reservation->to}}</td>
                <td>{{\Carbon\Carbon::make($reservation->time_from)->isoFormat('h:mm:ss a')}}</td>
                <td>{{\Carbon\Carbon::make($reservation->time_to)->isoFormat('h:mm:ss a')}}</td>
                @if(\Carbon\Carbon::make($reservation->from )->diffInDays($reservation->to) != 0)
                    <td>{{\Carbon\Carbon::make($reservation->to )->diffInDays($reservation->from)}}D</td>
                @else
                    <td>{{\Carbon\Carbon::make($reservation->time_to)->diffInHours($reservation->time_from)}}H</td>
                @endif
                <td> {{\Carbon\Carbon::now()->diffForHumans($reservation->created_at)}} </td>
            </tr>
        @endforeach
        </tbody>
    </table>
 <div class="panel-footer">
     <div class="row">
         <div class="col col-xs-4">
         </div>
         <div class="col col-xs-8">
             <ul class="pagination hidden-xs pull-right">
                {{$reservations->render()}}
             </ul>
         </div>
     </div>
 </div>
</div>



@endsection