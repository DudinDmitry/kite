@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-info" style="text-align: center">
                <h3>Итоги: {{$date}}</h3></div>
            @if (Session::has('message'))
                <div class="alert alert-success" id="error-message">{{Session::get('message')}}</div>
                <script>
                    setTimeout(function () {
                        $('#error-message').hide();
                    }, 1500)
                </script>
            @endif
            @foreach($allDataToday as $data)
                <div class="panel panel-default">

                    <div class="panel-heading"><h4> {{$allData->find($data->id)->users->first()->name}}</h4></div>
                    <div class="panel-body">
                        @if($allData->find($data->id)->users->first()->id == $id)
                            <a href="#" onclick="openbox('box'); return false">Редактировать</a> |
                            <a href="#">Удалить</a>
                            <form id="box" style="display: none;" method="post">
                                {{csrf_field()}}
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                          rows="3" name="message"
                                          style="width: 50%">{{$data->message}}</textarea><br>
                                <input type="hidden" name="id" value="{{$data->id}}">
                                <input type="submit" name="edit-message">
                            </form>
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
                        @endif
                        <div @if($allData->find($data->id)->users->first()->id == $id) id="id-message" @endif
                        >{{$data->message}}</div>
                    </div>

                </div>
            @endforeach
            <p><a href="#myModal1" class="btn btn-primary" data-toggle="modal">Добавить заметку</a></p>
            <div id="myModal1" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title">Запишите заметку, чтобы не забыть</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post">
                                {{csrf_field()}}
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                          rows="3" name="addmessage"
                                          style="width: 100%" placeholder="Введите заметку"></textarea><br>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть
                                    </button>
                                    <input type="submit" class="btn btn-primary"
                                           name="boot">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection