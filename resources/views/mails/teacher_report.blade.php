@component('mail::message')
[logo]: {{asset($pathToImage)}} "Logo"

![{{ $app_name }}]({{ asset($pathToImage) }})




Hola {{$teacher}},

Te enviamos las estadísticas de tu curso. De las <b>{{$activities_count}}</b> que se tenían que entregar hasta ayer {{$done_count}} entregaron y {{$no_done_count}} no lo hicieron.


Los siguientes alumnos tienen actividades pendientes:

@foreach($students as $student)
* {{$student}}
@endforeach

Gracias por ser parte, <br>
{{ $app_name }}
@endcomponent
