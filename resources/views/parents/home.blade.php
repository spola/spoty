@extends('layouts.app_parents')

@section('content')
<?php /*
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    */
    ?>
<style>
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}
.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
    </style>

<div class="container">

        @foreach($respuestas as $respuesta)
            <?php $student = $respuesta['student']; $totales = $respuesta['totales'] ?>
            <div class="row">
                <h1>{{$student->name}} <small><a href="{{route('parent.grade.show', ['grade'=>$student->grade_id])}}">(detalle)</a></small> </h1>
            </div>
            <div class="row">
            @foreach($totales as $course)
                <div class="col-md-4 col-xl-3">
                    <div class="card order-card {{ $course->respondidas_total_evaluadas == $course->total_evaluadas ? 'bg-c-green':'bg-c-blue' }} ">
                        <div class="card-block">
                            <h3 class="m-b-20">
                                {{$course->name}}
                            </h3>
                            <h5 class="text-right">
                                Evaluadas {{$course->respondidas_total_evaluadas}}/{{$course->total_evaluadas}}
                            </h5>
                            <p class="m-b-0 text-right">Todas &nbsp;
                                <span class="f-right">
                                {{$course->respondidas_total}}/{{$course->total}}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endforeach

</div>

@endsection
<?php
/*
dd([
    'totales' => $totales,
    'respondidas' => $respondidas
]);
*/
?>
