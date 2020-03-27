@extends('layouts.app')

@section('content')
<section class="course">

    <h1 class="mt-0">
        <img src="{{URL::asset('/images/' . $course->icon)}}" class="course_icon" class="mr-3 course_icon"/>
        {{$course->name}}
    </h1>

    <div class="row">
        <div class="col">
        {!! $course->content !!}
        </div>
    </div>

    <div class="line"></div>

    <div class="row">
        <div class="col">
            <h3>Actividades</h3>
        </div>
    </div>

    <div class="list-group">
        @foreach($course->activities as $activity)
        <a href="{{$activity->link}}" class="list-group-item d-flex justify-content-between align-items-center" {{$activity->new_tab?"target='blank'":""}}>
            <div class="col-1">
                <i class="fas fa-square"></i>
            </div>
            <div class="col-8">
                {{$activity->title}}
                <br/>
                <small>{{$activity->published->format('d-m-Y')}}</small>
                <br/>
                <small>{{$activity->description}}</small>
            </div>
            <div class="col-2">
                @if(!is_null($activity->due_date))
                <small>Fecha Entrega:</small><br/>
                <i class="fas fa-skull-crossbones"></i>
                <small>{{$activity->due_date->format('d-m-Y')}}</small>
                @endif
            </div>
            <div class="col-1">
                <i class="fa fa-{{$activity->type}}"></i>
            </div>
        </a>
        @endforeach
    </div>

    

</section>

@endsection