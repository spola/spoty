@extends('layouts.app_students')
@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="{{route('student.admin.create')}}" class="btn btn-primary">
            Invitar Alumno
        </a>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Fecha creación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>@formatDate($student->created_at)</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection