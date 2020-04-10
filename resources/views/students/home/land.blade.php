@extends('layouts.app_students')
@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-xl-5">
        <h3>Actividad para hoy</h3>
        <div class="card flex-row flex-wrap activity">
            @if($today == null)
            <div class="card-header border-0">
                <img src="{{URL::asset('/images/hoy_listo.jpg')}}" alt="" style="width:200px" class="img-fluid">
                <br/>
                <p>Todo listo</p>
            </div>
            @else
            <a href="{{$today->link}}" target="_blank" class="card-header border-0">

                <img src="{{URL::asset('/images/' . $today->course->icon)}}" alt="" style="width:150px" class="img-fluid">

            </a>
            <div href="{{$today->link}}" target="_blank" class="card-block px-2 flex-fill">
                <h5 class="card-title">{{$today->title}} <a href="{{$today->link}}" target="_blank" class="btn btn-primary spoty-d-md-hide">Ir</a> </h5>
                <p class="card-text">{{$today->desciption}}</p>
                <p class="card-text"><small>La actividad la han realizado {{$dones->hechas}} de tus {{$dones->total}} de compañeros</small></p>
                <a href="{{$today->link}}" target="_blank" class="btn btn-primary spoty-d-sm-hide">Ir a la actividad</a>

                <div class="w-100 text-muted text-right">
                    ¿La hiciste? <a href="{{$today->link}}" target="_blank" class="btn btn-success">¡Sí!</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <h3>Lo que vendrá <small>(semana)</small></h3>
        <div class="card flex-row flex-wrap">
            @if($activities->isEmpty())
                <div class="card-header border-0">
                    <img src="{{URL::asset('/images/todo_listo.jpg')}}" alt="" style="width:200px" class="img-fluid">
                </div>
            @else
                <div class="card-block px-2">
                    @foreach($activities as $activity)
                    <img src="{{URL::asset('/images/' . $activity->course->icon)}}" alt="" style="width:75px" class="">
                    @endforeach
                </div>

            @endif
        </div>
    </div>
</div>


@endsection
@section("scripts")
<script>
console.info(@json($activities));
</script>
@endsection
@section('styles')
<style>

.card.activity a.card-header,
.card.activity a.card-block {
    color: #212529;
    text-decoration: none;
}


@media (max-width: 768px) {

    .card-header {
        align-content: center;
        text-align: center;
        width: 100%;
    }

    .spoty-d-sm-hide {
        display: none !important;
    }
}
@media (min-width: 768px) {
    .spoty-d-md-hide {
        display: none !important;
    }

    .card.activity .card-block{
        width: calc(100% - 190px);
    }
}
</style>
@endsection
