@extends('layouts.app_parents')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($grades as $k => $grade)
            <li class="nav-item">
                <a class="nav-link {{$k == 0?'active':''}}" id="tab{{$grade->id}}" data-toggle="tab" href="#content{{$grade->id}}" role="tab" aria-controls="content{{$grade->id}}" aria-selected="true">{{$grade->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="row justify-content-center course">
    <div class="col-md-12">
        <div class="tab-content" id="myTabContent">
            @foreach($grades as $k => $grade)
            <div class="tab-pane fade show {{$k == 0?'active':''}}" id="content{{$grade->id}}" role="tabpanel" aria-labelledby="tab{{$grade->id}}">
                <iframe src="{{$grade->calendar}}" seamless="seamless" style="display:block; width:100%; height:100vh;" frameborder="0" scrolling="no"></iframe>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
