@extends('layouts.app')
@section('nav')
    <li class="nav-item dropdown"><a class="navbar-brand" href="{{ url('/add/company/item') }}">
        Add Item
        </a></li>
    <li class="nav-item dropdown" style="margin-right: 5px;" id="notify"> <div class="dropdown">
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
    <div class="col-xs-3 col-sm-3 col-lg-3">
        <img src="image\{{(\Illuminate\Support\Facades\Auth::user())->image->path}}" alt="" class="img-responsive  img-circle" width="300px" height="300px">
    </div>
    </div>

        <div class="justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>{{\Illuminate\Support\Facades\Auth::user()->name}}</h2></div>
                    <div class="card">
                        <h3>Email : {{(\Illuminate\Support\Facades\Auth::user())->email}}</h3>
                    </div>
                    <div class="card">
                    <h3> Number : {{(\Illuminate\Support\Facades\Auth::user())->userInformation->number}} </h3>
                   </div>
                    <div class="card">
                        <h3>Location : {{(\Illuminate\Support\Facades\Auth::user())->userInformation->location}}</h3>

                    </div>
                </div>
            </div>
        </div>


</div>

<iframe {{(\Illuminate\Support\Facades\Auth::user())->userInformation->map}} style="display:none;"></iframe>
@section('nav')
<a class="dropdown-item" href="/company/upload/{{(\Illuminate\Support\Facades\Auth::user())->id}}">Upload Information</a>
@stop
@endsection
