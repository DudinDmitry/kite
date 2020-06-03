@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-info text-center">
                <h3>Итоги: {{$date}}</h3></div>
            @if (Session::has('message'))
                <div class="alert alert-success" id="error-message">{{Session::get('message')}}</div>
                <script>
                    setTimeout(function () {
                        $('#error-message').hide();
                    }, 1500)
                </script>
            @endif

            @foreach($allUsers as $users)
                <div class="panel panel-default">

                    <div class="panel-heading"><h4> {{$users->name}}</h4></div>
                    @foreach($users->results->where('date','=',$date) as $data)
                    <div class="panel-body">
                        @if($users->id == $id)
                            <a href="#" onclick="openbox('box'); return false">Редактировать</a>
                            <form id="box" style="display: none;" method="post">
                                {{csrf_field()}}
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                          rows="4" name="message"
                                          style="width: 100%;max-width: 100%;">{{$data->message}}</textarea><br>
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="submit" name="edit-message">
                            </form>
                        @endif
                        <div @if($users->id == $id) id="id-message" @endif
                        >{!! nl2br($data->message,false)!!}</div>
                        @if($users->id == $id)
                            <form method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="deleteIdMessage" value="{{$data->id}}">
                                <input type="submit" class="btn btn-danger pull-right" value="Удалить" name="delete">
                            </form>
                        @endif
                    </div>
                    @endforeach

                </div>
            @endforeach
            <script type="text/javascript">
                function openbox(id) {
                    display = document.getElementById(id).style.display;
                    if (display == 'none') {
                        document.getElementById(id).style.display = 'block';
                        document.getElementById('id-message').style.display = 'none';
                    } else {
                        document.getElementById(id).style.display = 'none';
                        document.getElementById('id-message').style.display = 'block';
                    }
                }
            </script>
        </div>
    </div>
    </div>
@endsection