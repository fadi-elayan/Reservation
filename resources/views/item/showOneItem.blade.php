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
    <div class="card-deck col-xs-12 col-sm-12 col-lg-12 container" >
        <div class="card-deck container col-xs-12 col-sm-12 col-lg-12" >
            <div class="card col-xs-12 col-sm-12 col-lg-12" style="background-color: rgba(255 , 255 , 255 , 0.5)">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                    <ol class="carousel-indicators">

                        @foreach($items->item->photo  as $photo)
                            @if($i >= 1)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i++}}"></li>
                            @endif
                            @if($i == 0 )
                              <li data-target="#carouselExampleIndicators" data-slide-to="{{$i++}}" class="active"></li>
                            @endif
                        @endforeach
                    </ol>
                    <div class="carousel-inner ">
                        @foreach($items->item->photo  as $photo)

                                 @if($j >= 1)
                                    <div class="carousel-item ">
                                        <img class="card-img-top d-block  img-responsive"   src="\image\{{$photo->path}}" alt="First slide">

                                    </div>
                                    <div class="card-img-overlay">
                                        <a href="/delete/company/item/photo/{{$photo->id }}" class=""><i class="fa fa-close" aria-hidden="true" style="color: red;font-size: 20px;position: absolute;z-index: 1000;"></i></a>
                                    </div>
                                @endif
                                     @if($j == 0)
                                         <div class="carousel-item active " id="{{$j++}}">
                                             <img class="card-img-top d-block  img-responsive"   src="\image\{{$photo->path}}" alt="First slide">
                                         </div>
                                         <div class="card-img-overlay">
                                             <a href="/delete/company/item/photo/{{$photo->id}}" class=""><i class="fa fa-close" aria-hidden="true" style="color: red;font-size: 20px;position: absolute;z-index: 1000;"></i></a>
                                         </div>
                                     @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="card-body">
                    @if($items->item_type == 'App\Car')
                        <h5 class="card-title">Car</h5>
                        <p class="card-text">Type :  {{$items->item->type}}</p>
                        <p class="card-text">Color : {{$items->item->color}}</p>
                        <p class="card-text">Board Number : {{$items->item->board_number}}</p>
                        <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>
                        <p class="card-text">Decrabtion {{$items->decrabtion}}</p>
                        <a href="/delete/company/item/{{$items->id}}" class="btn btn-danger">Delete</a>
                    @endif

                        @if($items->item_type == 'App\Hold')
                            <h5 class="card-title">Car</h5>
                            <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                            <p class="card-text">Number of Armchare : {{$items->item->number_of_armchare}}</p>
                            <p class="card-text">Location : {{$items->item->location}}</p>
                            <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>
                            <p class="card-text">Decrabtion {{$items->decrabtion}}</p>
                            <a href="/delete/company/item/{{$items->id}}" class="btn btn-danger">Delete</a>
                        @endif

                        @if($items->item_type == 'App\Flat')
                            <h5 class="card-title">Flat</h5>
                            <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                            <p class="card-text">Number of Room : {{$items->item->number_of_room}}</p>
                            <p class="card-text">Location : {{$items->item->location}}</p>
                            <p class="card-text">Price for reservation per month :  {{$items->price}} JD</p>
                            <p class="card-text">Decrabtion {{$items->decrabtion}}</p>
                            <a href="/delete/company/item/{{$items->id}}" class="btn btn-danger">Delete</a>
                        @endif
                </div>
            </div>
            </div>

        </div>
@endsection