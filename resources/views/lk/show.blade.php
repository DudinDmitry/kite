@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Личный кабинет пользователя {{Auth::user()->name}}</div>


                    @foreach($messages as $message)
                        <div class="panel-body">
                            <b>Дата итогов: {{$message->date}}</b><br>
                            <b>ID сообщения: {{$message->id}}</b><br>
                            <p onclick="openbox('box')" style="display: block"
                               id="id-message">{!! nl2br($message->message) !!}</p>

                            <form id="box" style="display: none;" method="post">
                                {{csrf_field()}}
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                          rows="4" name="message"
                                          style="width: 100%;max-width: 100%;">{{$message->message}}</textarea><br>
                                <input type="hidden" name="id" value="{{$message->id}}">
                                <input type="submit" name="edit-message" class="btn btn-primary" value="Сохранить">
                                <button id="end" type="button" class="btn btn-outline-light pull-right">Отмена
                                </button>
                            </form>
                            <script>
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
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
