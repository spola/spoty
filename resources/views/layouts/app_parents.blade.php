<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    -->
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/solid.min.js" integrity="sha256-UM1HRu0Wd16k4L5wgrk17BYWzKkjZSe0BYr5T5qw2Ww=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/regular.min.js" integrity="sha256-H0NvRuA8S2idTs4I6NzvHRkonlIQNO9wGutAM0//9YU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/fontawesome.min.js" integrity="sha256-NP9NujdEzS5m4ZxvNqkcbxyHB0dTRy9hG13RwTVBGwo=" crossorigin="anonymous"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

    @yield("styles")
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        &nbsp;
                    </a>
                </h3>
            </div>



            <ul class="list-unstyled components">
                <li class="icons">
                    <a href="{{ url('/') }}">
                        <i class="fas fa-chart-line"></i>
                        <br/>
                        Resumen
                    </a>
                </li>
                <li class="icons">
                    <a href="{{route('parents.calendars')}}">
                        <i class="far fa-calendar-alt"></i>
                        <br/>
                        Calendarios
                    </a>
                </li>
            </ul>

            @if(isset($courses))
            <ul class="list-unstyled components">
                @foreach($courses as $course)
                <li class="icons">
                    <a href="{{route('courses.show', [$course])}}">
                        <img src="{{URL::asset('/images/' . $course->icon)}}" class="course_icon"/>
                        <br/>
                        {{$course->name}}
                    </a>
                </li>
                @endforeach
            </ul>
            @endif
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <button class="navbar-toggler" type="button" id="sidebarCollapse">
                        <i class="fas fa-bars"></i>
                    </button>
                    <img src="{{asset('images/logo_superior.png')}}" style="height: 60px;">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ $user->name }} <span class="caret"></span>
                                </a>
                                @user_menu @enduser_menu
                            </li>
                        </ul>
                    </div>
                    <a href="{{asset('SPOTY.pdf')}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Instructivo de uso">
                        <i class="fas fa-question-circle"></i>
                    </a>
                </div>
            </nav>
            <br/>

            @yield('content')
        </div>
    </div>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-161687583-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-161687583-2');
    </script>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>

    @yield("scripts")

</body>
</html>
