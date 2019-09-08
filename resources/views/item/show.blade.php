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
                    <a class="dropdown-item" style="background-color:#f8f9fa;" type="button" href="show/company/notification/{{$notification->id}}"><img src="image/{{(\App\Item::find($notification->data['item_id']))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive"> Reservation item is : {{(\App\Item::find($notification->data['item_id']))->item->type}}    {{$date->diffForHumans($notification->created_at)}}
                        <br><img src="image/{{(\App\User::find($notification->data['user_id']))->image['path']}}" width="40px" height="40px" class="img-circle responsive"> User : {{(\App\User::find($notification->data['user_id']))->name}} </a>
            @endforeach
            <!--<button class="dropdown-item badge-secondary" type="button">Another action</button>
            <button class="dropdown-item badge-secondary" type="button">Something else here</button>-->
            </div>
        </div> </li>

    <li class="nav-item dropdown"><a class="navbar-brand" href="/show/company/item/{{\Illuminate\Support\Facades\Auth::user()->id}}">
            Show Item
        </a></li>


@endsection
@section('content')
    <div class="container">
    <div class="row">

        @foreach($item as $items)
            <div class="card col-xs-3 col-sm-3 col-lg-4" style="margin-top: 2px;border: 3px solid rgba(0,0,0,.125);">
            @foreach($items->item->photo as $photo)
             <img class="card-img-top d-block  img-responsive" style="width:100%;" height="400px" src="\image\{{$photo->path}}" alt="First slide">
                    @break
                @endforeach
        <div class="card-body">
            @if($items->item_type == 'App\Car')
                <h5 class="card-title">Car<span class="float-right" style="color: #2176bd"> {{$date->diffForHumans($items->created_at)}}</span></h5>
             <p class="card-text">Type :  {{$items->item->type}}</p>
            <p class="card-text">Color : {{$items->item->color}}</p>
            <p class="card-text">Board Number : {{$items->item->board_number}}</p>
             <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>

            <a href="/display/company/item/{{$items->id}}" class="btn btn-primary">Show more details</a>
                <a href="/times/company/reservation/{{$items->id}}" class="btn btn-info">Booked Time</a>
             <a href="/delete/company/item/{{$items->id}}" class="btn btn-danger">Delete</a>
            @endif
                @if($items->item_type == 'App\Hold')
                    <h5 class="card-title">Hold <span class="float-right" style="color: #2176bd"> {{$date->diffForHumans($items->created_at)}}</h5>
                    <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                    <p class="card-text">Number of Armchare : {{$items->item->number_of_armchare}}</p>
                    <p class="card-text">Location : {{$items->item->location}}</p>
                    <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>
                    <a href="/display/company/item/{{$items->id}}" class="btn btn-primary">Show more details</a>
                    <a href="/times/company/reservation/{{$items->id}}" class="btn btn-info">Booked Time</a>
                    <a href="/delete/company/item/{{$items->id}}" class="btn btn-danger">Delete</a>
                @endif

                @if($items->item_type == 'App\Flat')
                    <h5 class="card-title">Flat<span class="float-right" style="color: #2176bd"> {{$date->diffForHumans($items->created_at)}}</h5>
                    <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                    <p class="card-text">Number of Room : {{$items->item->number_of_room}}</p>
                    <p class="card-text">Location : {{$items->item->location}}</p>
                    <p class="card-text">Price for reservation per month :  {{$items->price}} JD</p>
                    <a href="/display/company/item/{{$items->id}}" class="btn btn-primary">Show more details</a>
                    <a href="/times/company/reservation/{{$items->id}}" class="btn btn-info">Booked Time</a>
                    <a href="/delete/company/item/{{$items->id}}" class="btn btn-danger">Delete</a>
                @endif
        </div>
    </div>
        @endforeach
    </div>
    </div>

    <div class="container align-items-center" style="margin-top: 10px;">
        <div class="col-xl-12">
        {{$item->render()}}
        </div>
    </div>
@endsection