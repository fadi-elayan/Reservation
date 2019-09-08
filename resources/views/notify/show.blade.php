@extends('layouts.app')
@section('nav')
    <li class="nav-item dropdown"><a class="navbar-brand" href="{{ url('/add/company/item') }}">
            Add Item
        </a></li>
    <li class="nav-item dropdown" style="margin-right: 5px;"> <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Notification <span class="badge badge-light">{{sizeof(\Illuminate\Support\Facades\Auth::user()->unreadNotifications )}}</span>
            </button>
            <div class="dropdown-menu"  style=";left: -147px;" aria-labelledby="dropdownMenu2">
                @foreach(\Illuminate\Support\Facades\Auth::user()->unreadNotifications as $notification)
                    <button class="dropdown-item" style="background-color:#f8f9fa;" type="button">
                        <img src="/image/{{(\App\Item::find($notification->data['item_id']))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive">
                          Reservation item is : {{(\App\Item::find($notification->data['item_id']))->item->type}}
                        {{$date->diffForHumans($notification->created_at)}}
                        <br>
                        <img src="/image/{{(\App\User::find($notification->data['user_id']))->image['path']}}" width="40px" height="40px" class="img-circle responsive">
                        User : {{(\App\User::find($notification->data['user_id']))->name}}
                    </button>
            @endforeach
            <!--<button class="dropdown-item badge-secondary" type="button">Another action</button>
            <button class="dropdown-item badge-secondary" type="button">Something else here</button>-->
            </div>
        </div> </li>

    <li class="nav-item dropdown"><a class="navbar-brand" href="/show/company/item/{{\Illuminate\Support\Facades\Auth::user()->id}}">
            Show Item
        </a></li>

    <li class="nav-item dropdown"><a class="navbar-brand" href="{{ url('/') }}">
            Detainees
        </a></li>


@endsection
@section('content')

    <div class="container">

        <div class="media col-xl-12 col-sm-12 col-lg-12 ">
        <div class="media-left">
            <img src="/image/{{(\App\User::find((json_decode($notif->data))->user_id))->image->path}}" class="media-object" width="85px" >
        </div>
        <div class="media-body" style="margin-left: 6px;">
            <h4 class="media-heading">{{(\App\User::find((json_decode($notif->data))->user_id))->name}}<small style="margin-left: 20px;"><i> Date:  {{$date->diffForHumans($notif->created_at)}}</i></small></h4>
            <p>My Email : {{(\App\User::find((json_decode($notif->data))->user_id))->email}}</p>
            <p>I want to book this item :</p>
            <!-- Nested media object -->
            <div class="media">
                <div class="media-left">
                    <img src="/image/{{(\App\Item::find(json_decode($notif->data)->item_id))->item->photo[0]->path}}" class="media-object" width="85px" >
                </div>
                <div class="media-body" style="margin-left: 6px;">

                    <h4 class="media-heading">Type : {{(\App\Item::find(json_decode($notif->data)->item_id))->item->type}}<small><i></i></small></h4>
                    <p>Price for per day: {{(\App\Item::find(json_decode($notif->data)->item_id))->price}}</p>

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

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="center col-xl-12 col-sm-12 col-lg-12">
                <a href="/accept/company/notification/{{$notif->id}}" class="btn btn-success"><button class="btn btn-success">Aceept</button></a>
                <a class="btn btn-danger" href="/reject/company/notification/{{$notif->id}}"><button class="btn btn-danger">Reject</button></a>
            </div>
        </div>
    </div>

@endsection
    <iframe {{(\Illuminate\Support\Facades\Auth::user())->userInformation->map}} style="display:none;"></iframe>
@section('nav')
    <a class="dropdown-item" href="/company/upload/{{(\Illuminate\Support\Facades\Auth::user())->id}}">Upload Information</a>
@endsection


