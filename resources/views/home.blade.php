@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Выберите Итоги</div>

                <div class="panel-body">
                    @foreach($allResults as $allResult)
                        <a href="/result/{{$allResult->date}}"> {{$allResult->date}} ({{$allResult->count}})</a><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
