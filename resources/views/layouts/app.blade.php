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
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/semantic-ui/2.2.7/semantic.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <link href="{{ removeHttp(mix('/css/app.css')) }}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {
            "csrfToken": "{{ csrf_token() }}"
        };
        window.locale = "{{ language() }}";
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">@lang('welcome.toggle')</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    @lang('welcome.naomoe')
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/vote"><i class="gamepad icon"></i>@lang('welcome.votes')</a></li>
                    <li><a href="/result"><i class="calendar checkered icon"></i>@lang('welcome.result')</a></li>
                    <li><a href="/discuss"><i class="comments icon"></i>@lang('welcome.discuss')</a></li>
                    @if (Route::has('stotk'))
                        <li><a class="item" href="/stock"><i class="payment icon"></i>@lang('welcome.stock')</a></li>
                    @endif
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @if (Admin::user())
                        <li><a href="/admin"><i class="desktop icon"></i>@lang('welcome.admin')</a></li>
                    @endif
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}"><i class="sign in icon"></i>@lang('welcome.login')</a></li>
                        <li><a href="{{ route('register') }}"><i class="add user icon"></i>@lang('welcome.register')</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('change') }}">@lang('welcome.change')</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        @lang('welcome.logout')
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!--email_off-->

    <div class="ui container">
        <div class="view">
            @yield('content')
        </div>
    </div>

    @include('layouts.footer')
    @yield('footer')

    <!--/email_off-->
</div>

<!-- Scripts -->
<script src="//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="{{ removeHttp(mix('/js/app.js')) }}"></script>
<div style="display: none">
    <script src="//s4.cnzz.com/z_stat.php?id=1261300564&web_id=1261300564" language="JavaScript"></script>
</div>
</body>
</html>
