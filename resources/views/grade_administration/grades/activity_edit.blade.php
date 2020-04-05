@extends($user->is_parent? 'layouts.app_parents' : 'layouts.app_students')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Editar actividad</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if($is_trashed)
                    <div class="alert alert-danger" role="alert">
                    ¡Esta actividad se encuentra oculta!
                    </div>
                    @endif

                    {{-- <form method="POST" action="{{ route('administration.users.create') }}"> --}}
                    {!!Form::open()->route('administration.grades.activity.update', ['grade' => $grade, 'activity'=> $activityArray['id']])->fill($activityArray) !!}

                        {!!Form::hidden('id') !!}
                        @csrf
                        {!!Form::fieldsetOpen('Actividad')!!}
                            {!!Form::select('course', 'Asignatura')->options($grade->courses)!!}
                            {!!Form::text('title', 'Título')!!}
                            {!!Form::textarea('description', 'Descripción')!!}
                            {!!Form::date('published', 'Fecha Publicación')!!}
                            {!!Form::date('due_date', 'Fecha Entrega')!!}
                            {!!Form::checkbox('scored', 'Evaluado')->checked()!!}
                        {!!Form::fieldsetClose()!!}

                        <br/>

                        {!!Form::fieldsetOpen('Archivo')!!}
                            {!!Form::text('link', 'Enlace archivo')!!}
                            {!!Form::select('type', 'Tipo de archivo')->options($activity_types)!!}
                        {!!Form::fieldsetClose()!!}

                        <br/>
                        <div class="btn btn-group">
                        {!!Form::anchor("Volver")->color('default')->route('administration.grades.show', ['grade' => $grade])  !!}

                        @if($is_trashed)
                            {!!Form::button('Mostrar')->success()->attrs(['id' => 'btn-ocultar']) !!}

                        @else
                            {!!Form::button('Ocultar')->danger()->attrs(['id' => 'btn-ocultar']) !!}
                        @endif

                        {!!Form::submit('Editar') !!}
                        </div>

                    {!!Form::close()!!}

                    {!!Form::open()->method('delete')->route('administration.grades.activity.hide', ['grade' => $grade, 'activity'=> $activityArray['id']])->fill($activityArray) !!}
                        {!!Form::hidden('id') !!}
                    {!!Form::close()!!}

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section("scripts")

<script>
$(function() {
    $("#btn-ocultar").on('click', function(e) {
        e.preventDefault();
        $("[name=_method][value=delete]").parent().submit();
    });
});
</script>
@endsection
