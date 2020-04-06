@extends($user->is_parent? 'layouts.app_parents' : 'layouts.app_students')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Registrar estudiante') }}</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    {!!Form::open()->route('administration.grades.users.store', ['grade' => $grade])->fill(null) !!}
                        @csrf

                        {!!Form::fieldsetOpen('Estudiante')!!}
                            {!!Form::text('name', __('Name'))!!}
                            {!!Form::text('email', __('E-Mail Address'))->type('email')!!}
                        {!!Form::fieldsetClose()!!}

                        {!!Form::fieldsetOpen('Apoderado')!!}
                            {!!Form::text('parent_name', __('Name'))!!}
                            {!!Form::text('parent_email', __('E-Mail Address'))->type('email')!!}
                            <small>Nota: Si ya existe un apoderado con el mismo correo se usará ese apoderado</small>
                        {!!Form::fieldsetClose()!!}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                {!!Form::anchor(__('Cancel'))->color('default')->route('administration.grades.users.index', ['grade' => $grade])  !!}


                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>

                            </div>
                        </div>
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
