@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-info" style="text-align: center">
                    <h3>Дата итогов: {{$date}}</h3></div>
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
                        <div class="panel-heading"><h4> {{$allData[($data->id)-1]->users[0]->name}}</h4></div>
                        <div class="panel-body">

                            @if($allData[($data->id)-1]->users[0]->id == $id)
                                <a href="#" onclick="openbox('box'); return false">(Редактировать)</a>
                                <form id="box" style="display: none;" method="post">
                                    {{csrf_field()}}
                                    <textarea class="form-control" id="exampleFormControlTextarea1"
                                              rows="3" name="message"
                                              style="width: 50%">{{$data->message}}</textarea><br>
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                    <input type="submit" name="test">
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

                            <div @if($allData[($data->id)-1]->users[0]->id == $id) id="id-message" @endif
                            >{{$data->message}}</div>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
@endsection
