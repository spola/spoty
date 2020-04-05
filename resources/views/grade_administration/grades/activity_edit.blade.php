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
                        {!!Form::anchor("Volver")->color('default')->route('administration.grades.show', ['grade' => $grade])  !!}

                        {!!Form::submit('Editar') !!}

                    {!!Form::close()!!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
