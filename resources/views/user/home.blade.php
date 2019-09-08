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
<div class="dropdown navbar-brand" id="notify">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Notification <span class="badge badge-light">{{sizeof(\Illuminate\Support\Facades\Auth::user()->unreadNotifications )}}</span>
        </button>
        <div class="dropdown-menu"  style=";left: -147px;" aria-labelledby="dropdownMenu2">
            @foreach(\Illuminate\Support\Facades\Auth::user()->unreadNotifications as $notification)
                <a class="dropdown-item" style="background-color:#f8f9fa;" type="button" href="show/user/notification/{{$notification->id}}"><img src="image/{{(\App\Item::find($notification->data['items_id']))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive"> Reservation item is : {{(\App\Item::find($notification->data['items_id']))->item->type}}    {{$date->diffForHumans($notification->created_at)}}
                    <br></a>
        @endforeach
        </div>
    </div>
<a class="navbar-brand" href="show/user/all/notification">
         All notification
    </a>


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
                            @if((Illuminate\Support\Facades\DB::table('notifications')->where('data' , 'like' , '%"item_id":'.$items->id.',%')->where('data' , 'like' , '%"user_id":'.\Illuminate\Support\Facades\Auth::user()->id.',%')->where('read_at' , null)->get())->isEmpty())
                            <form method="post" action="/reservation/company/item/{{$items->id}}" >
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="date" class="form-control" name="from" value="{{ old('from') }}" required>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                                    <div class="col-md-6">
                                        <input id="to" type="date" class="form-control" name="to" value="{{ old('to') }}" required>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="form_time" class="col-md-4 col-form-label text-md-right">{{ __('From Time') }}</label>

                                    <div class="col-md-6">
                                        <input id="form_time" type="time" class="form-control" name="from_time" value="{{ old('form_time') }}" required>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="to_time" class="col-md-4 col-form-label text-md-right">{{ __('To Time') }}</label>

                                    <div class="col-md-6">
                                        <input id="to_time" type="time" class="form-control" name="to_time" value="{{ old('form_time') }}" required>

                                    </div>
                                </div>

                               <input type="submit" class="btn btn-primary" value="Reservation">

                            </form>
                        @else
                                <a href="/delete/item/reservation/{{(Illuminate\Support\Facades\DB::table('notifications')->where('data' , 'like' , '%"item_id":'.$items->id.',%')->where('data' , 'like' , '%"user_id":'.\Illuminate\Support\Facades\Auth::user()->id.'%')->get())[0]->id }}" class="btn btn-danger">Rollback Reservation</a>
                        @endif
                            <a href="/display/item/{{$items->id}}" class="btn btn-success">Show more details</a>
                            <a href="/times/reservation/{{$items->id}}" class="btn btn-info">Booked Time</a>
                        @endif
                        @if($items->item_type == 'App\Hold')
                                <h5 class="card-title">Hold <span class="float-right" style="color: #2176bd"> {{$date->diffForHumans($items->created_at)}}</span></h5>
                            <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                            <p class="card-text">Number of Armchare : {{$items->item->number_of_armchare}}</p>
                            <p class="card-text">Location : {{$items->item->location}}</p>
                            <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>
                                @if((Illuminate\Support\Facades\DB::table('notifications')->where('data' , 'like' , '%"item_id":'.$items->id.',%')->where('data' , 'like' , '%"user_id":'.\Illuminate\Support\Facades\Auth::user()->id.',%')->where('read_at' , null)->get())->isEmpty())                                    <form method="post" action="/reservation/company/item/{{$items->id}}" >
                                        @csrf

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="date" class="form-control" name="from" value="{{ old('from') }}" required>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                                            <div class="col-md-6">
                                                <input id="to" type="date" class="form-control" name="to" value="{{ old('to') }}" required>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="form_time" class="col-md-4 col-form-label text-md-right">{{ __('From Time') }}</label>

                                            <div class="col-md-6">
                                                <input id="form_time" type="time" class="form-control" name="from_time" value="{{ old('form_time') }}" required>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="to_time" class="col-md-4 col-form-label text-md-right">{{ __('To Time') }}</label>

                                            <div class="col-md-6">
                                                <input id="to_time" type="time" class="form-control" name="to_time" value="{{ old('form_time') }}" required>

                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Reservation">

                                    </form>
                                @else
                                    <a href="/delete/item/reservation/{{(Illuminate\Support\Facades\DB::table('notifications')->where('data' , 'like' , '%"item_id":'.$items->id.'%')->where('data' , 'like' , '%"user_id":'.\Illuminate\Support\Facades\Auth::user()->id.'%')->get())[0]->id }}" class="btn btn-danger">Rollback Reservation</a>
                                @endif

                                <a  href="/display/item/{{$items->id}}" class="btn btn-success">Show more details</a>
                                <a href="/times/reservation/{{$items->id}}" class="btn btn-info">Booked Time</a>
                        @endif

                        @if($items->item_type == 'App\Flat')
                                <h5 class="card-title">Flat<span class="float-right" style="color: #2176bd"> {{$date->diffForHumans($items->created_at)}}</span></h5>
                            <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                            <p class="card-text">Number of Room : {{$items->item->number_of_room}}</p>
                            <p class="card-text">Location : {{$items->item->location}}</p>
                            <p class="card-text">Price for reservation per month :  {{$items->price}} JD</p>
                                @if((Illuminate\Support\Facades\DB::table('notifications')->where('data' , 'like' , '%"item_id":'.$items->id.',%')->where('data' , 'like' , '%"user_id":'.\Illuminate\Support\Facades\Auth::user()->id.',%')->where('read_at' , null)->get())->isEmpty())                                    <form method="post" action="/reservation/company/item/{{$items->id}}" >
                                        @csrf

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('From') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="date" class="form-control" name="from" value="{{ old('from') }}" required>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="to" class="col-md-4 col-form-label text-md-right">{{ __('To') }}</label>

                                            <div class="col-md-6">
                                                <input id="to" type="date" class="form-control" name="to" value="{{ old('to') }}" required>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="form_time" class="col-md-4 col-form-label text-md-right">{{ __('From Time') }}</label>

                                            <div class="col-md-6">
                                                <input id="form_time" type="time" class="form-control" name="from_time" value="{{ old('form_time') }}" required>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="to_time" class="col-md-4 col-form-label text-md-right">{{ __('To Time') }}</label>

                                            <div class="col-md-6">
                                                <input id="to_time" type="time" class="form-control" name="to_time" value="{{ old('form_time') }}" required>

                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Reservation">

                                    </form>
                                @else
                                    <a href="/delete/item/reservation/{{(Illuminate\Support\Facades\DB::table('notifications')->where('data' , 'like' , '%"item_id":'.$items->id.'%')->where('data' , 'like' , '%"user_id":'.\Illuminate\Support\Facades\Auth::user()->id.'%')->get())[0]->id }}" class="btn btn-danger">Rollback Reservation</a>
                                @endif
                                <a href="/display/item/{{$items->id}}" class="btn btn-success">Show more details</a>
                                <a href="/times/reservation/{{$items->id}}" class="btn btn-info">Booked Time</a>
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