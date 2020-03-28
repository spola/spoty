@extends('layouts.app_students')
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
@section("ignorado")
    <ul class=" list-group list-group-flush">
        <li class="list-group-item">
            <div class="todo-indicator bg-warning"></div>
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left mr-2">
                        <div class="custom-checkbox custom-control"> <input class="custom-control-input" id="exampleCustomCheckbox12" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox12">&nbsp;</label> </div>
                    </div>
                    <div class="widget-content-left">
                        <div class="widget-heading">Call Sam For payments <div class="badge badge-danger ml-2">Rejected</div>
                        </div>
                        <div class="widget-subheading"><i>By Bob</i></div>
                    </div>
                    <div class="widget-content-right">
                        <button class="border-0 btn-transition btn btn-outline-success">
                            <i class="fa fa-check"></i>
                        </button>
                        <button class="border-0 btn-transition btn btn-outline-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </li>
    </ul>
@endsection
    <ul class=" list-group list-group-flush">
        @foreach($course->activities as $activity)
        <li class="list-group-item">
            <!--
            <div class="todo-indicator bg-warning"></div>
            <div class="todo-indicator bg-primary"></div>
            <div class="todo-indicator bg-info"></div>
            -->
            <div class="todo-indicator bg-focus"></div>
            <div class="widget-content p-0">
                <a class="widget-content-wrapper" href="{{$activity->link}}" {{$activity->new_tab?"target='blank'":""}}>
                    <div class="widget-content-left mr-2">
                        <!-- <div class="custom-checkbox custom-control"> <input class="custom-control-input" id="exampleCustomCheckbox12" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox12">&nbsp;</label> </div> -->
                        <button class="border-0 btn-transition btn btn-outline-success change-icon register_activity {{$checked->contains($activity->id)?'d-none':''}}" data-id="{{$activity->id}}" data-checked="true">
                            <i class="far fa-square fa-2x" title="Vuelve a dejar tu trabajo como pendiente" data-toggle="tooltip" data-placement="top"></i>    
                            <i class="fa fa-check fa-2x" title="Marca tu trabajo como entregado" data-toggle="tooltip" data-placement="top"></i>
                        </button>
                        <button class="border-0 btn-transition btn btn-outline-success change-icon register_activity {{!$checked->contains($activity->id)?'d-none':''}}" data-id="{{$activity->id}}" data-checked="false">
                            <i class="fa fa-check fa-2x" title="Marca tu trabajo como entregado" data-toggle="tooltip" data-placement="top"></i>
                            <i class="far fa-square fa-2x" title="Vuelve a dejar tu trabajo como pendiente" data-toggle="tooltip" data-placement="top"></i>    
                        </button>
                    </div>
                    <div class="widget-content-left">
                        <div class="widget-heading">
                            {{$activity->title}}
                        </div>
                        <small>@formatDate($activity->published)</small>
                        <br/>
                        <small class="widget-subheading">{{$activity->description}}</small>
                    </div>
                    <div class="widget-content-right">
                        @if(!is_null($activity->due_date))
                        <small>Fecha Entrega:</small><br/>
                        <i class="fas fa-skull-crossbones"></i>
                        <small>@formatDate($activity->due_date)</small>
                        @endif
                    </div>
                    <div class="widget-content-right">
                        <i class="fa fa-{{$activity->type}} fa-2x"></i>
                    </div>
                </a>
            </div>
        </li>
        @endforeach
    </ul>
</section>
@endsection

@section("scripts")
<script src="{{asset('js/course.js')}}"></script>
@endsection

        

