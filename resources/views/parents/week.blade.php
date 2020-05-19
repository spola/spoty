@extends('layouts.app_parents')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($data as $k => $student)
            <?php $grade = $student['grade'] ?>
            <li class="nav-item">
                <a class="nav-link {{$k == 0?'active':''}}" id="tab{{$grade->id}}" data-toggle="tab" href="#content{{$grade->id}}" role="tab" aria-controls="content{{$grade->id}}" aria-selected="true">{{$grade->name}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="row justify-content-center course">
    <div class="col-md-12">
        <div class="tab-content" id="myTabContent">
            @foreach($data as $k => $student)
            <?php $grade = $student['grade'] ?>
            <div class="tab-pane fade show {{$k == 0?'active':''}}" id="content{{$grade->id}}" role="tabpanel" aria-labelledby="tab{{$grade->id}}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">Lunes</div>
                            <div class="col-2">Martes</div>
                            <div class="col-2">Miércoles</div>
                            <div class="col-2">Jueves</div>
                            <div class="col-2">Viernes</div>
                        </div>
                        <div class="row">
                            @foreach($student['activities'] as $day)
                            <div class="col-2">
                                @foreach($day as $activity)
                                    <p><small class="{{$activity->done?'green':''}}">{{$activity->title}} </small></p>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
