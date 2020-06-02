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
                                <div id="dud">
                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                          rows="4" name="message"
                                          style="width: 100%;max-width: 100%;">{{$message->message}}</textarea><br>
                                <input type="hidden" name="id" value="{{$message->id}}">
                                <input type="submit" name="edit-message">
                                </div>
                            </form>
                            <script>
                                function openbox(id) {
                                    display = document.getElementById(id).style.display;


                                    if (display == 'none') {
                                        document.getElementById(id).style.display = 'block';
                                        document.getElementById('id-message').style.display = 'none';
                                        /*if (container.has(event.target).length === 0) {
    container.hide();
}*/
                                    } else {
                                        document.getElementById(id).style.display = 'none';
                                        document.getElementById('id-message').style.display = 'block';

                                    }
                                }
                                $(document).onclick(function (e) {
                                    var container = $("dud");
                                    if (!container.is(e.target) // если клик был не по нашему блоку
                                        && container.has(e.target).length === 0) { // и не по его дочерним элементам
                                        container.hide(); // скрываем его
                                    }
                                })
                            </script>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
