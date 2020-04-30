@extends('layouts.app_students')
@section('content')

<div class="row justify-content-center">
    <div class="col-12 col-xl-5">
        <h3>Actividad para hoy</h3>
        <div class="card flex-row flex-wrap activity">
            @if($today == null)
            <div class="flex-fill border-0 text-center">
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
                    ¿La hiciste? <a href="{{route('student.activity.didit', $today)}}" class="btn btn-success">¡Sí!</a>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="col-12 col-xl-5">
        <h3>Lo que vendrá <small>(semana)</small></h3>
        <div class="card flex-row flex-wrap">
            @if(empty($activities))
                <div class="flex-fill border-0 text-center">
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

@if(!$news->isEmpty())
<div class="row justify-content-center mt-5">
    <div class="col-12 col-xl-5">
        <h1>Noticias</h1>
    </div>
</div>

<div class="row justify-content-center mt-1">
    <div class="col-12 col-xl-5">

    @foreach($news as $item)
        @component('components.news.' . $item->type, ['item'=>$item] ) @endcomponent
    @endforeach


    </div>
</div>
@endif


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

.card.news iframe {
    display:block;
    width:100%;
    height: 100%;
}
.news .news-content {
    height: 400px;
}

.bg-pink {
    background-color: #f783ac;
}
.bg-water-green {
    background-color: #BEE8DC;
}
.bg-news {
    background-color: #9dbdff;
}

@media (max-width: 768px) {
    .news .news-content {
        height: 200px;
    }

    .card-header {
        align-content: start;
        text-align: left;
    }
}

</style>
@endsection
