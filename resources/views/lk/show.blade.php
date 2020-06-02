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
                            <p onclick="openbox{{$message->id}}('box{{$message->id}}')" style="display: block"
                               id="id-message{{$message->id}}">{!! nl2br($message->message) !!}</p>

                            <form id="box{{$message->id}}" style="display: none;" method="post">
                                {{csrf_field()}}
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                          rows="4" name="form[{{$message->id}}][message]"
                                          style="width: 100%;max-width: 100%;">{{$message->message}}</textarea><br>
                                <input type="hidden" name="form[{{$message->id}}][id]" value="{{$message->id}}">
                                <input type="submit" name="form[{{$message->id}}][edit-message]" class="btn btn-primary"
                                       value="Сохранить">
                                <button id="end" onclick="end{{$message->id}}()" type="button"
                                        class="btn btn-outline-light pull-right">Отмена
                                </button>
                            </form>
                            <script>
                                function openbox{{$message->id}}(id) {
                                    display = document.getElementById(id).style.display;
                                    if (display == 'none') {
                                        document.getElementById(id).style.display = 'block';
                                        document.getElementById('id-message{{$message->id}}').style.display = 'none';
                                    } else {
                                        document.getElementById(id).style.display = 'none';
                                        document.getElementById('id-message{{$message->id}}').style.display = 'block';
                                    }
                                }

                                function end{{$message->id}}() {
                                    document.getElementById('box{{$message->id}}').style.display = 'none';
                                    document.getElementById('id-message{{$message->id}}').style.display = 'block';
                                }
                            </script>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
