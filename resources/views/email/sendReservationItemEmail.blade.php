@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('You Reservation this Item') }}</div>

                    <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            @if($items->item_type == 'App\Flat')
                                <h5 class="card-title">Flat</h5>
                                <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                                <p class="card-text">Number of Room : {{$items->item->number_of_room}}</p>
                                <p class="card-text">Location : {{$items->item->location}}</p>
                                <p class="card-text">Price for reservation per month :  {{$items->price}} JD</p>
                                @endif
                                @if($items->item_type == 'App\Hold')
                                    <h5 class="card-title">Hold </h5>
                                    <p class="card-text">Size :  {{$items->item->size}} {{$items->item->unit}}</p>
                                    <p class="card-text">Number of Armchare : {{$items->item->number_of_armchare}}</p>
                                    <p class="card-text">Location : {{$items->item->location}}</p>
                                    <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>
                                    @endif
                                @if($items->item_type == 'App\Car')
                                    <h5 class="card-title">Car</h5>
                                    <p class="card-text">Type :  {{$items->item->type}}</p>
                                    <p class="card-text">Color : {{$items->item->color}}</p>
                                    <p class="card-text">Board Number : {{$items->item->board_number}}</p>
                                    <p class="card-text">Price for reservation per day :  {{$items->price}} JD</p>
                                    @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection