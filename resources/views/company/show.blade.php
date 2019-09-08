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
    <table class="table table-striped table-bordered table-list">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Number</th>
            <th scope="col">Email</th>
            <th scope="col">Location</th>
            <th scope="col">Delete</th>
            <th scope="col">Show item</th>
        </tr>
        </thead>
        <tbody>
    @foreach($company as $companys)
        <tr>
            <th scope="row">{{$i++}}</th>
            <td><img src="\image\{{(App\User::find($companys->id))->image->path}}" alt="" class="img-responsive  img-circle" width="40px" height="30px"></td>
            <td>{{$companys->name}}</td>
            <td> {{(App\User::find($companys->id))->userInformation->number}}</td>
            <td>{{$companys->email}}</td>
            <td> {{(App\User::find($companys->id))->userInformation->location}}</td>
            <td><a href="/delete/company/{{$companys->id}}"><button class="btn btn-danger">Delete</button></a> </td>
            <td><a href="/show/company/items/{{$companys->id}}"><button class="btn btn-primary">Show</button></a> </td>
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
                        {{$company->render()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
