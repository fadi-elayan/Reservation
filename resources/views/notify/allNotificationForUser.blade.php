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
                <a class="dropdown-item" style="background-color:#f8f9fa;" type="button" href="/show/user/notification/{{$notification->id}}"><img src="/image/{{(\App\Item::find($notification->data['items_id']))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive"> Reservation item is : {{(\App\Item::find($notification->data['items_id']))->item->type}}    {{$date->diffForHumans($notification->created_at)}}
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



<div class="container">

    <table class="table table-striped table-bordered table-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Item</th>
            <th scope="col">Company</th>
            <th scope="col">Stutes</th>
            <th scope="col">Days / Hours</th>
            <th scope="col">Show More Details</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notifications   as $notification)
        <tr>
            <th scope="row">{{$i++}}</th>
             @if(sizeof(Illuminate\Support\Facades\DB::table('item')->where('id' ,json_decode($notification->data)->items_id)->get())!=0)
            <td><img src="/image/{{(\App\Item::findOrFail(json_decode($notification->data)->items_id))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive"></td>
            <td>{{substr((\App\Item::findOrFail(json_decode($notification->data)->items_id))->item_type ,4)}}</td>
            @else
                <td>This Item has been deleted</td>
                <td>Item</td>
                @endif
            @if((Illuminate\Support\Facades\DB::table('users')->where('id' ,json_decode($notification->data)->company_id)->get())->isNotEmpty())
               <td>{{(\App\User::findOrFail(json_decode($notification->data)->company_id))->name}}</td>
            @else
                <td>This company has been deleted</td>
            @endif
             @if(json_decode($notification->data)->status == 'Reject')
                <td style="color: red;">{{json_decode($notification->data)->status}}</td>
            @else
                <td style="color: deepskyblue;">{{json_decode($notification->data)->status}}</td>

            @endif
              @if((\Carbon\Carbon::make(json_decode($notification->data)->from))->diffInDays(json_decode($notification->data)->to) != 0)
                  <td>{{(\Carbon\Carbon::make(json_decode($notification->data)->from))->diffInDays(json_decode($notification->data)->to)}}D</td>
            @else
                <td>{{\Carbon\Carbon::make(json_decode($notification->data)->to_time)->diffInHours(json_decode($notification->data)->from_time)}}H</td>
             @endif
                <td><a href="/display/item/{{json_decode($notification->data)->items_id }}">Show More</a></td>
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
                    {{$notifications->render()}}
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection