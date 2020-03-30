@extends('layouts.app_students')

@section('content')
<?php /*
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    */
    ?>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <iframe src="{{str_replace('&amp;', '&', $grade->calendar)}}" seamless="seamless" style="display:block; width:100%; height:100vh;" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
@endsection
