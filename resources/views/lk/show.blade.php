@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Личный кабинет пользователя {{Auth::user()->name}}</div>
                    @if (Session::has('message'))
                        <div class="alert alert-success" id="error-message">{{Session::get('message')}}</div>
                        <script>
                            setTimeout(function () {
                                $('#error-message').hide();
                            }, 1500)
                        </script>
                    @endif
                    <div class="panel-heading">
                        <p><a href="#myModal1" class="btn btn-primary" data-toggle="modal">Добавить заметку</a></p>
                        <div id="myModal1" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                                        </button>
                                        <h4 class="modal-title">Запишите заметку, чтобы не забыть</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post">
                                            {{csrf_field()}}

                                            <label for="inputState">Выбрать дату итогов:</label> <select
                                                    class="form-control" style="width: 30%" name="date">

                                                @foreach($results as $result)
                                                    <option value="{{$result->date}}">{{$result->date}}</option>
                                                @endforeach
                                            </select>

                                            <textarea class="form-control" id="exampleFormControlTextarea1"
                                                      rows="3" name="addmessage"
                                                      style="max-width: 100%"
                                                      placeholder="Введите заметку"></textarea><br>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Закрыть
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
                    @foreach($messagesGroupBy as $date=>$messages)
                        <div class="panel-heading">
                        <div class="alert alert-info text-center" >
                            <h3>Итоги: <a href="/result/{{$date}}" class="alert-link">{{$date}}</a></h3>
                        </div>
                            @foreach($messages as $message)
                                
                                <b onclick="openbox('{{$message->id}}')">Заметка №: {{$message->id}}</b><br>
                                <p onclick="openbox('{{$message->id}}')" style="display: block"
                                   id="id-message{{$message->id}}">{!! nl2br($message->message) !!}</p>
                                <form id="box{{$message->id}}" style="display: none;" method="post">
                                    {{csrf_field()}}
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                              rows="4" name="form[{{$message->id}}][message]"
                                              style="width: 100%;max-width: 100%;">{{$message->message}}</textarea><br>
                                    <input type="hidden" name="form[{{$message->id}}][id]" value="{{$message->id}}">
                                    <input type="submit" name="form[{{$message->id}}][edit-message]"
                                           class="btn btn-primary"
                                           value="Сохранить">
                                    <button id="end{{$message->id}}" onclick="end({{$message->id}})" type="button"
                                            class="btn btn-outline-light pull-right">Отмена
                                    </button>
                                    <input type="hidden" name="deleteIdMessage" value="{{$message->id}}">
                                    <input type="submit" class="btn btn-danger pull-right" value="Удалить"
                                           name="delete">
                                </form>
                            @endforeach
                        </div>
                    @endforeach
                    <script>
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
    </div>
@endsection
