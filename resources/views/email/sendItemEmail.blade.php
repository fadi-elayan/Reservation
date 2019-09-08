@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('You add this Item') }}</div>

                    <div class="card-body">

                            <div class="alert alert-success" role="alert">
                                TypeOf : {{ 'Car' }}
                                Type:{{$info->type}}
                                Color:{{$info->color}}
                                Number of Bourd :{{$info->board_number}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
