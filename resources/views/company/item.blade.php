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
            </div>
        </div> </li>

    <li class="nav-item dropdown"><a class="navbar-brand" href="/show/company/item/{{\Illuminate\Support\Facades\Auth::user()->id}}">
            Show Item
        </a></li>

@endsection
@section('content')


    <div class="container">

        <button class="btn btn-info" id="car1">Car</button>
        <button class="btn btn-info" id="flat1">Flat</button>
        <button class="btn btn-info" id="hold1">Hold</button>
    <div class="alert alert-success" id="alert" style="display: none;" role="alert">
        <h4 class="alert-heading">Well done!</h4>
        <p>Aww yeah, you successfully upload item </p>
        <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
    </div>

        <div class="alert alert-danger" id="danger" style="display: none;" role="alert">
            <h4 class="alert-heading">Wrong</h4>
            <p>there is someting happend</p>
            <p class="mb-0"></p>
        </div>
    </div>
    <div class="container" id="car">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Car') }}<br>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form  action="/add/company/item" method="post" enctype="multipart/form-data" id="forms">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>
                                 <input type="text" name="typeOf" value="Car" style="display: none;">
                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" >

                                    <div id='type' style="display:none">
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="type"></strong>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="price" value="{{ old('price') }}"  >

                                <div id='price' style="display: none">
                                <span class="invalid-feedback" role="alert">
                                        <strong class="price"></strong>
                                    </span>
                                </div>
                            </div>
                            </div>


                            <div class="form-group row">
                                <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Color') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control " name="color" value="{{ old('color') }}">

                                     <div id='color' style="display: none">
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="color"></strong>
                                    </span>
                                     </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Board Number') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="board_number">

                                      <div id='board_number' >
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="board_number"></strong>
                                    </span>
                                      </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Decrabtion') }}</label>

                                <div class="col-md-6">
                                    <textarea  type="text" class="form-control" name="decrabtion"></textarea>

                                    <div id='decrabtion' >
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="decrabtion"></strong>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control" name="file[]" required multiple = 'multiple'>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary car">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- end form car -->



    <div class="container" id="flat">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Flat') }}<br>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progress-bar1" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/add/company/item') }}"  id="flatForm" enctype="multipart/form-data" >
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Number Of Room') }}</label>
                                <input type="text" name="typeOf" value="Flat" style="display: none;">
                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('number_of_room') is-invalid @enderror" name="number_of_room" value="{{ old('number_of_room') }}" >

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="price" value="{{ old('price') }}"  >

                                    <div id='price' style="display: none">
                                <span class="invalid-feedback" role="alert">
                                        <strong class="price"></strong>
                                    </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Size') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control " name="size" value="{{ old('size') }}">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="unit">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="location">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Decrabtion') }}</label>

                                <div class="col-md-6">
                                    <textarea  type="text" class="form-control" name="decrabtion"></textarea>

                                    <div id='decrabtion' >
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="decrabtion"></strong>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control" name="file[]" required multiple = 'multiple'>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary car">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--end of flat item -->



    <div class="container" id="hold">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Hold') }}<br>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" id="progress-bar2" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/add/company/item') }}" id="formHold" enctype="multipart/form-data" >
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Number Of Armchare') }}</label>
                                <input type="text" name="typeOf" value="Hold" style="display: none;">
                                <div class="col-md-6">
                                    <input  type="text" class="form-control @error('number_of_room') is-invalid @enderror" name="number_of_armchare" value="{{ old('number_of_armchare') }}" >

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="price" value="{{ old('price') }}"  >

                                    <div id='price' style="display: none">
                                <span class="invalid-feedback" role="alert">
                                        <strong class="price"></strong>
                                    </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Size') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control " name="size" value="{{ old('size') }}">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="unit">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Location') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" class="form-control" name="location">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="board_number" class="col-md-4 col-form-label text-md-right">{{ __('Decrabtion') }}</label>

                                <div class="col-md-6">
                                    <textarea  type="text" class="form-control" name="decrabtion"></textarea>

                                    <div id='decrabtion' >
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="decrabtion"></strong>
                                    </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('Photo') }}</label>

                                <div class="col-md-6">
                                    <input id="file" type="file" class="form-control" name="file[]" required multiple = 'multiple'>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary car">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function(){
            function hide1()
            {
                $('#danger').hide(500);
                $('#alert').hide(500);
                setTimeout(hide1, 8000);
            }
            hide1();
            $('#flat').hide(500);
            $('#hold').hide(500);
            $('#car').show(900);
            $('#car1').click(function () {
               $('#flat').hide(500);
                $('#hold').hide(500);
                $('#car').show(900);
            });

            $('#flat1').click(function () {
                $('#car').hide(500);
                $('#hold').hide(500);
                $('#flat').show(900);
            });

            $('#hold1').click(function () {
                $('#car').hide(500);
                $('#flat').hide(500);
                $('#hold').show(900);
            });

            $('#flatForm').submit(function (e) {
                e.preventDefault();
                var dataa = new FormData($(this)[0]);
                $.ajax({
                    url: "/add/company/item",
                    type: 'POST',
                    data:dataa,
                    processData:false,
                    contentType:false,
                    beforeSend:function(){
                        $('#progress-bar1').text('0%');
                        $('#progress-bar1').css('width', '0%');
                    },
                    uploadProgress:function(event, position, total, percentComplete){
                        $('#progress-bar1').text(percentComplete + '0%');
                        $('#progress-bar1').css('width', percentComplete + '0%');
                    },
                    success: function (data) {
                        if(data['sec'] == 'sec')
                        {
                            $('#progress-bar1').text('Uploaded');
                            $('#progress-bar1').css('width', '100%');
                            $("input").addClass('form-control');
                            $('#alert').show(500);
                            $('#danger').hide(500);
                        }else{

                            $('#progress-bar1').attr('class' , 'progress-bar progress-bar-striped bg-danger');
                            $('#progress-bar1').text('Failed');
                            $('#progress-bar1').css('width', '50%');
                            for(id in data['error'])
                            {
                                $("input[name='"+id+"']").addClass('form-control is-invalid');
                                document.getElementById('danger').innerHTML+=data['error'][id][0];
                            }
                            $('#danger').show(500);
                            $('#alert').hide(500);
                        }

                    }
                })
            });

            $('#formHold').submit(function (e) {
                e.preventDefault();
                var dataa = new FormData($(this)[0]);
                $.ajax({
                    url: "/add/company/item",
                    type: 'POST',
                    data:dataa,
                    processData:false,
                    contentType:false,
                    beforeSend:function(){
                        $('#progress-bar2').text('0%');
                        $('#progress-bar2').css('width', '0%');
                    },
                    uploadProgress:function(event, position, total, percentComplete){
                        $('#progress-bar2').text(percentComplete + '0%');
                        $('#progress-bar2').css('width', percentComplete + '0%');
                    },
                    success: function (data) {
                        if(data['sec'] == 'sec')
                        {
                            $('#progress-bar2').text('Uploaded');
                            $('#progress-bar2').css('width', '100%');
                            $("input").addClass('form-control');
                            $('#alert').show(500);
                            $('#danger').hide(500);
                        }else{

                            $('#progress-bar2').attr('class' , 'progress-bar progress-bar-striped bg-danger');
                            $('#progress-bar2').text('Failed');
                            $('#progress-bar2').css('width', '50%');
                            for(id in data['error'])
                            {
                                $("input[name='"+id+"']").addClass('form-control is-invalid');
                                document.getElementById('danger').innerHTML+=data['error'][id][0];
                            }
                            $('#danger').show(500);
                            $('#alert').hide(500);
                        }

                    }
                })
            });

            $('#forms').submit(function (e) {
                e.preventDefault();
                var dataa = new FormData($(this)[0]);
                $.ajax({
                    url: "/add/company/item",
                    type: 'POST',
                    data:dataa,
                    processData:false,
                    contentType:false,
                    beforeSend:function(){
                        $('#progress-bar').text('0%');
                        $('#progress-bar').css('width', '0%');
                    },
                    uploadProgress:function(event, position, total, percentComplete){
                        $('#progress-bar').text(percentComplete + '0%');
                        $('#progress-bar').css('width', percentComplete + '0%');
                    },
                    success: function (data) {
                        if(data['sec'] == 'sec')
                        {
                               $('#progress-bar').text('Uploaded');
                               $('#progress-bar').css('width', '100%');
                                $("input").addClass('form-control');
                                $('#alert').show(500);
                                $('#danger').hide(500);
                        }else{

                             $('#progress-bar').attr('class' , 'progress-bar progress-bar-striped bg-danger');
                             $('#progress-bar').text('Failed');
                             $('#progress-bar').css('width', '50%');
                                for(id in data['error'])
                                {
                                    $("input[name='"+id+"']").addClass('form-control is-invalid');
                                    document.getElementById('danger').innerHTML+=data['error'][id][0];
                                }
                            $('#danger').show(500);
                            $('#alert').hide(500);
                        }

                    }
                });

            });

        });
    </script>

@endsection

