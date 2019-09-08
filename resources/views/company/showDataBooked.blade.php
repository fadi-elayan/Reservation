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
                    <a class="dropdown-item" style="background-color:#f8f9fa;" type="button" href="/show/company/notification/{{$notification->id}}"><img src="/image/{{(\App\Item::find($notification->data['item_id']))->item->photo[0]['path']}}" width="40px" height="40px" class="img-circle responsive"> Reservation item is : {{(\App\Item::find($notification->data['item_id']))->item->type}}    {{Carbon\Carbon::now()->diffForHumans($notification->created_at)}}
                        <br><img src="/image/{{(\App\User::find($notification->data['user_id']))->image['path']}}" width="40px" height="40px" class="img-circle responsive"> User : {{(\App\User::find($notification->data['user_id']))->name}} </a>
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

    @if($descrabation == 'This Date Booked')
        <div class="alert alert-danger" role="alert">
            {{$descrabation}}
        </div>
    @elseif($descrabation != '')
        <div class="alert alert-success" role="alert">
            {{$descrabation}}
        </div>
    @endif




    <table class="table table-striped table-dark">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">Days / Hours</th>
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
                    <td>{{\Carbon\Carbon::make($reservation->from )->diffInDays($reservation->to)}}D</td>
                @else
                    <td>{{\Carbon\Carbon::make($reservation->time_from)->diffInHours($reservation->time_to)}}H</td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection