<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    @if($user->isAdmin())
        <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">Administración</h6>

        @if($user->is_superadmin)
        <a class="dropdown-item" href="{{ route('administration.users.create') }}">
            Invitar Padres
        </a>
        @endif
        @if(isset($admin_grades) && !empty($admin_grades) )
            @foreach($admin_grades as $grade)
                <a class="dropdown-item" href="{{ route('administration.grades.users.index', ['grade' => $grade->id]) }}">
                    <i class="fas fa-sliders-h"></i>
                    {{ $grade->name }} - Alumnos
                </a>
                <a href="{{ route('administration.grades.show', ['grade' => $grade->id]) }}" class="dropdown-item">
                    <i class="fas fa-sliders-h"></i>
                    {{ $grade->name }} - Actividades
                </a>
            @endforeach
        @endif
        <div class="dropdown-divider"></div>
    @endif
    <a class="dropdown-item" href="{{ route('change.password') }}">
        Cambiar Contraseña
    </a>
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
