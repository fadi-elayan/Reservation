@extends('layouts.app')
@section('nav')
    <li class="nav-item dropdown"> <a class="navbar-brand" href="{{ url('/show') }}">
            Add Company
        </a>

    <li class="nav-item dropdown"><a class="navbar-brand" href="{{ url('/show/all/company') }}">
            Show Company
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
                        @endif
                        @if($items->item_type == 'App\Hold')
                            <h5 class="card-title">Hold <span class="float-right" style="color: #2176bd"> {{$date->diffForHumans($items->created_at)}}</h5>
                            <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                            <p class="card-text">Number of Armchare : {{$items->item->number_of_armchare}}</p>
                            <p class="card-text">Location : {{$items->item->location}}</p>
                            <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>
                        @endif

                        @if($items->item_type == 'App\Flat')
                            <h5 class="card-title">Flat<span class="float-right" style="color: #2176bd"> {{$date->diffForHumans($items->created_at)}}</h5>
                            <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                            <p class="card-text">Number of Room : {{$items->item->number_of_room}}</p>
                            <p class="card-text">Location : {{$items->item->location}}</p>
                            <p class="card-text">Price for reservation per month :  {{$items->price}} JD</p>
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