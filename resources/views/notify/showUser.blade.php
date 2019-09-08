@extends('layouts.app')
@section('nav')

    <li class="nav-item">
        <div class="d-flex justify-content-center" style="z-index: 1000;position: relative;">

            <div class="searchbar">
                <input class="search_input" type="text" name="search" id="search" placeholder="Search..." autocomplete="off">
                <a href="#" class="search_icon" id="ser"><i class="fas fa-search"></i></a>

                <ul class="list-group" id="list">

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
                <a class="dropdown-item" style="background-color:#f8f9fa;" type="button" href="show/user/notification/{{$notification->id}}"><img src="image/{{(\App\Item::find($notification->data['items_id']))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive"> Reservation item is : {{(\App\Item::find($notification->data['items_id']))->item->type}}    {{$date->diffForHumans($notification->created_at)}}
                    <br></a>
        @endforeach
        <!--<button class="dropdown-item badge-secondary" type="button">Another action</button>
            <button class="dropdown-item badge-secondary" type="button">Something else here</button>-->
        </div>
    </div>
    <a class="navbar-brand" href="show/user/all/notification">
        All notification
    </a>


@endsection
@section('content')
    <div class="container">

        <div class="media col-xl-12 col-sm-12 col-lg-12 ">
            <div class="media-left">
                <img src="/image/{{(\App\User::find((json_decode($notif->data))->company_id))->image->path}}" class="media-object" width="85px" >
            </div>
            <div class="media-body" style="margin-left: 6px;">
                <h4 class="media-heading">{{(\App\User::find((json_decode($notif->data))->company_id))->name}}<small style="margin-left: 20px;"><i> Date:  {{$date->diffForHumans($notif->created_at)}}</i></small></h4>
                <p>My Email : {{(\App\User::find((json_decode($notif->data))->company_id))->email}}</p>
                <p> <h2 class="btn btn-success">{{(json_decode($notif->data))->status}}</h2> Reservation this item  :</p>
                <!-- Nested media object -->
                <div class="media">
                    <div class="media-left">
                        <img src="/image/{{(\App\Item::find(json_decode($notif->data)->items_id))->item->photo[0]->path}}" class="media-object" width="85px" >
                    </div>
                    <div class="media-body" style="margin-left: 6px;">

                        <h4 class="media-heading">Type : {{(\App\Item::find(json_decode($notif->data)->items_id))->item->type}}<small><i></i></small></h4>
                        <p>Price for per day: {{(\App\Item::find(json_decode($notif->data)->items_id))->price}}</p>

                    </div>
                </div>
                <div class="media">
                    <div class="media-left">
                        <img src="/image/reservations.png" class="media-object" width="200px" >
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">Reservation <small><i></i></small></h4>
                        <p>Start Date : {{json_decode($notif->data)->from}}</p>
                        <p>End Date : {{json_decode($notif->data)->to}}</p>
                        <p>Start Time : {{\Carbon\Carbon::make(json_decode($notif->data)->from_time)->isoFormat('h:mm:ss a')}}</p>
                        <p>End Time : {{\Carbon\Carbon::make(json_decode($notif->data)->to_time)->isoFormat('h:mm:ss a')}}</p>
                        <p>Total  : {{\Carbon\Carbon::make(json_decode($notif->data)->to.' '.json_decode($notif->data)->to_time )->diffInDays(json_decode($notif->data)->from.' '.json_decode($notif->data)->from_time)}}Days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection



