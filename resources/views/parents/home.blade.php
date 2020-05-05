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
        <?php $student = $respuesta['student'];?>
        <div class="row">
            <h1>{{$student->name}} - {{$student->grade->name}}<small><a href="{{route('parent.grade.show', ['grade'=>$student->grade_id])}}">(detalle)</a></small> </h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">Atrasados</div>
                            <div class="col-4">{{$respuesta['remaining']}}</div>
                        </div>
                        <div class="row">
                            <div class="col-8">Restantes de la semana</div>
                            <div class="col-4">{{$respuesta['week_remaining']}}</div>
                        </div>
                        <div class="row">
                            <div class="col-8">Total de la Semana</div>
                            <div class="col-4">{{$respuesta['week']}}</div>
                        </div>
                        <div class="row">
                            <div class="col-8">Actividades Realizadas</div>
                            <div class="col-4">{{$respuesta['done']}}</div>
                        </div>
                        <div class="row">
                            <div class="col-8">Actividades Totales</div>
                            <div class="col-4">{{$respuesta['total']}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">Total alumnos del curso</div>
                            <div class="col-4">{{$respuesta['students']}}</div>
                        </div>
                        <div class="row">
                            <div class="col-8">Promedio actividades hechas</div>
                            <div class="col-4">{{$respuesta['average']}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

@endsection
