@extends('layouts.app_parents')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <h1>{{$grade->name}} - {{$student->name}}</h1>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Actividad</th>
                    <th>Fecha Entrega</th>
                    <th>Evaluada</th>
                    <th>Entregada</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $result)
                <tr>
                    <td>
                        <img src="{{asset('images/'.$result->icon)}}" width="25" height="25">
                        {{$result->name}}
                    </td>
                    <td>{{$result->title}}</td>
                    <td>{{$result->due_date}}</td>
                    <td>{{$result->scored?"si":""}}</td>
                    <td style="color:green">
                        @if($result->ua_id != null)
                        <i class="fa fa-check fa-2x"></i>    
                        @endif
                    </td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
