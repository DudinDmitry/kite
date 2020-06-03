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
                @if($users->results->where('date','=',$date)->where('published','=',1)->count()!=0)
                    <div class="panel panel-default">

                        <div class="panel-heading"><h4> {{$users->name}}</h4></div>
                        @foreach($users->results->where('date','=',$date)->where('published','=',1) as $data)
                            <div class="panel-body">
                                @if($users->id == $id)

                                    <b onclick="openbox('{{$data->id}}')">Заметка №: {{$data->id}}</b>

                                    <p onclick="openbox('{{$data->id}}')" style="display: block"
                                       id="id-message{{$data->id}}">{!! nl2br($data->message) !!}</p>
                                    <form id="box{{$data->id}}" style="display: none;" method="post">
                                        {{csrf_field()}}
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                                  rows="4" name="form[{{$data->id}}][message]"
                                                  style="width: 100%;max-width: 100%;">{{$data->message}}</textarea><br>
                                        <input type="hidden" name="form[{{$data->id}}][id]" value="{{$data->id}}">
                                        <input type="submit" name="form[{{$data->id}}][edit-message]"
                                               class="btn btn-primary"
                                               value="Сохранить">
                                        <button id="end{{$data->id}}" onclick="end({{$data->id}})" type="button"
                                                class="btn btn-outline-light pull-right">Отмена
                                        </button>
                                        <input type="hidden" name="deleteIdMessage" value="{{$data->id}}">
                                        <input type="submit" class="btn btn-danger pull-right" value="В черновик"
                                               name="delete">
                                    </form>


                                @else
                                    <b>Заметка №: {{$data->id}}</b>
                                    <div @if($users->id == $id) id="id-message" @endif
                                    >{!! nl2br($data->message,false)!!}</div>
                                    @if($users->id == $id)
                                        <form method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="deleteIdMessage" value="{{$data->id}}">
                                            <input type="submit" class="btn btn-danger pull-right" value="Удалить"
                                                   name="delete">
                                        </form>
                                    @endif
                                @endif

                            </div>
                        @endforeach

                    </div>
                @endif
            @endforeach
            <script type="text/javascript">
                function openbox(id) {
                    display = document.getElementById('box' + id).style.display;
                    if (display == 'none') {
                        document.getElementById('box' + id).style.display = 'block';
                        document.getElementById('id-message' + id).style.display = 'none';
                    } else {
                        document.getElementById('box' + id).style.display = 'none';
                        document.getElementById('id-message' + id).style.display = 'block';
                    }
                }

                function end(id) {
                    document.getElementById('box' + id).style.display = 'none';
                    document.getElementById('id-message' + id).style.display = 'block';
                }
            </script>
        </div>
    </div>
    </div>
@endsection