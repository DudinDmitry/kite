@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Итоги: {{$date}}</div>
                    @foreach($allDataToday as $data)
                    <div class="panel-body">

                            Дата: {{$data->date}}<br>
                            Автор: {{$allData[($data->id)-1]->users[0]->name}}<br>
                            Сообщение: {{$data->message}}<br>
                    </div>
                        @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
