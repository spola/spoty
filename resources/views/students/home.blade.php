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
            <iframe src="https://calendar.google.com/calendar/embed?height=600&amp;wkst=2&amp;bgcolor=%23ffffff&amp;ctz=America%2FSantiago&amp;src=MzhiMDIwYWpjdGo4Mm02bjdqZ3I4cjc1YzRAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;src=ZXMuY2wjaG9saWRheUBncm91cC52LmNhbGVuZGFyLmdvb2dsZS5jb20&amp;color=%237CB342&amp;color=%23009688&amp;mode=WEEK&amp;showTitle=0&amp;showCalendars=0&amp;showTabs=1&amp;showDate=1&amp;showTz=0" seamless="seamless" style="display:block; width:100%; height:100vh;" frameborder="0" scrolling="no"></iframe>
        </div>
    </div>
@endsection
