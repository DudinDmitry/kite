@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Выберите Итоги</div>

                <div class="panel-body">
                    @foreach($allResults as $allResult)
                        <a href="/result/{{$allResult->date}}"> <h4>{{$allResult->date}} ({{$allResult->count}})</h4></a>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
