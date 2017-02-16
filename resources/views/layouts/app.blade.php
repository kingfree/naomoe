<!DOCTYPE html>
<html lang="{{ language() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - @lang('welcome.naomoe')</title>
    <link type="image/png" rel="shortcut icon" href="/favicon.png">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/packages/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/semantic-ui/semantic.min.css">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {
            "csrfToken": "{{ csrf_token() }}"
        };
    </script>
</head>
<body>
<div id="app">
    <div id="header-component" class="app-viewport">
        <div class="ui top pink inverted fixed menu">
            <a class="item" href="/">@lang('welcome.naomoe')</a>
            <div class="labeled icon menu">
                <a class="item" href="/vote"><i class="gamepad icon"></i>@lang('welcome.votes')</a>
                <a class="item" href="/schedule"><i class="calendar icon"></i>@lang('welcome.schedule')</a>
                <a class="item" href="/discuss"><i class="comments icon"></i>@lang('welcome.discuss')</a>
                @if (Route::has('stotk'))
                    <a class="item" href="/stock"><i class="payment icon"></i>@lang('welcome.stock')</a>
                @endif
            </div>
            <div class="right menu">
                @if (Admin::user())
                    <a class="item" href="/admin"><i class="desktop icon"></i>@lang('welcome.admin')</a>
                @endif
                @if (Auth::check())
                    <div class="ui dropdown item">
                        {{ Auth::user()->name }} <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="item" href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                退出
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                @else
                    <a class="item" href="/login"><i class="sign in icon"></i>@lang('welcome.login')</a>
                    <a class="item" href="/register"><i class="user plus icon"></i>@lang('welcome.register')</a>
                @endif
            </div>
        </div>
    </div>

    <div class="ui container">
        <div class="view">
            @yield('content')
        </div>
    </div>

    @include('layouts.footer')
    @yield('footer')
</div>

<!-- Scripts -->
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
