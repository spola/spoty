@extends($user->is_parent? 'layouts.app_parents' : 'layouts.app_students')

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
        <h1>Administración del curso {{$grade->name}}</h1>
    </div>
</div>
<div class="row justify-content-center course">
    <div class="col-md-12">

    <a href="{{route('administration.grades.activity.add', ['grade'=>$grade])}}" class="btn btn-primary">
        Agregar Actividad
    </a>

  <ul class=" list-group list-group-flush">
        @foreach($activities as $result)
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
