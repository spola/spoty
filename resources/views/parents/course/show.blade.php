@extends('layouts.app_parents')

@section('content')
<div class="row justify-content-left">
    <div class="col-md-12">
        <a href="{{url('/')}}">
        <i class="fas fa-arrow-circle-left"></i>
        </a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <h1>{{$grade->name}} - {{$student->name}}</h1>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab" aria-controls="pendientes" aria-selected="true">Pendientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="entregadas-tab" data-toggle="tab" href="#entregadas" role="tab" aria-controls="entregadas" aria-selected="false">Entregadas</a>
        </li>
    </ul>
    </div>
</div>
<div class="row justify-content-center course">
    <div class="col-md-12">
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="pendientes" role="tabpanel" aria-labelledby="pendientes-tab">

  <ul class=" list-group list-group-flush">
        @foreach($doing as $result)
            <li class="list-group-item">
                <!--
                <div class="todo-indicator bg-warning"></div>
                <div class="todo-indicator bg-primary"></div>
                <div class="todo-indicator bg-info"></div>
                -->
                <div class="todo-indicator bg-focus"></div>
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <img src="{{asset('images/' . $result->icon) }}" class="course_icon list" />
                            {{$result->name}} @if($result->scored) <small class="text-danger">con nota</small>@endif
                        </div>
                        <div class="widget-content-right">
                            @if(!is_null($result->due_date))
                            <small>Fecha Entrega:</small><br/>
                            <i class="fas fa-skull-crossbones"></i>
                            <small>@formatDate($result->due_date)</small>
                            @endif
                        </div>
                    </div>
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2" style="color:green">
                            @if($result->resp_id != null)
                                <i class="fa fa-check fa-2x" title="Marca tu trabajo como entregado" data-toggle="tooltip" data-placement="top"></i>
                            @endif
                        </div>
                        <div class="widget-content-left">
                            <div class="widget-heading">
                                {{$result->title}}
                            </div>
                            {{-- 
                            <small>@formatDate($activity->published)</small>
                            <br/>
                            <small class="widget-subheading">{{$activity->description}}</small>
                            --}}
                        </div>
                        
                        {{--
                        <div class="widget-content-right">
                            <i class="fa fa-{{$activity->type}} fa-2x"></i>
                        </div>
                        --}}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

  </div>
  <div class="tab-pane fade" id="entregadas" role="tabpanel" aria-labelledby="entregadas-tab">
  <ul class=" list-group list-group-flush">
        @foreach($done as $result)
            <li class="list-group-item">
                <!--
                <div class="todo-indicator bg-warning"></div>
                <div class="todo-indicator bg-primary"></div>
                <div class="todo-indicator bg-info"></div>
                -->
                <div class="todo-indicator bg-focus"></div>
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <img src="{{asset('images/' . $result->icon) }}" class="course_icon list" />
                            {{$result->name}} @if($result->scored) <small class="text-danger">con nota</small>@endif
                        </div>
                        <div class="widget-content-right">
                            @if(!is_null($result->due_date))
                            <small>Fecha Entrega:</small><br/>
                            <i class="fas fa-skull-crossbones"></i>
                            <small>@formatDate($result->due_date)</small>
                            @endif
                        </div>
                    </div>
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left mr-2" style="color:green">
                            @if($result->resp_id != null)
                                <i class="fa fa-check fa-2x" title="Marca tu trabajo como entregado" data-toggle="tooltip" data-placement="top"></i>
                            @endif
                        </div>
                        <div class="widget-content-left">
                            <div class="widget-heading">
                                {{$result->title}}
                            </div>
                            {{-- 
                            <small>@formatDate($activity->published)</small>
                            <br/>
                            <small class="widget-subheading">{{$activity->description}}</small>
                            --}}
                        </div>
                        
                        {{--
                        <div class="widget-content-right">
                            <i class="fa fa-{{$activity->type}} fa-2x"></i>
                        </div>
                        --}}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
  </div>
</div>


@endsection
