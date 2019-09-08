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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
