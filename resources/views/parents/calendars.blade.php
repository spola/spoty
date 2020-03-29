@extends('layouts.app_parents')

@section('content')
<?php //dd($grades) ?>

<div class="row justify-content-center">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($grades as $grade)
            <li class="nav-item">
                <a class="nav-link active" id="{{$grade->name}}-tab" data-toggle="tab" href="#{{$grade->name}}" role="tab" aria-controls="{{$grade->name}}" aria-selected="true">{{$grade->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="row justify-content-center course">
    <div class="col-md-12">
        <div class="tab-content" id="myTabContent">
            @foreach($grades as $grade)
            <div class="tab-pane fade show active" id="{{$grade->name}}" role="tabpanel" aria-labelledby="{{$grade->name}}-tab">
                <iframe src="{{$grade->calendar}}" seamless="seamless" style="display:block; width:100%; height:100vh;" frameborder="0" scrolling="no"></iframe>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
