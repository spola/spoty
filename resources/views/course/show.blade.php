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
            <h3>Guías con entrega</h3>
        </div>
    </div>

</section>

@endsection
