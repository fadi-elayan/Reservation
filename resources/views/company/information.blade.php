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
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/Admin/add/company/information/{{$id}}" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" required >

                                    @error('location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="map" class="col-md-4 col-form-label text-md-right">{{ __('Map') }}</label>

                                <div class="col-md-6">
                                    <input id="map" type="text" class="form-control @error('map') is-invalid @enderror" name="map" required>

                                    @error('map')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="number" class="col-md-4 col-form-label text-md-right">{{ __('Number') }}</label>

                                <div class="col-md-6">
                                    <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" required>

                                    @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="img" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                                <div class="col-md-6">
                                    <input id="img" type="file" class="form-control @error('file') is-invalid @enderror" name="file" required>

                                    @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

