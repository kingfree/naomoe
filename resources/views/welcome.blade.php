<!DOCTYPE html>
<html lang="{{ language() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('welcome.naomoe')</title>
    <link type="image/png" rel="shortcut icon" href="/favicon.png">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #e03997;
            font-family: sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 64px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 18px;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="top-left links">
        @if (App::isLocale('zh-CN'))
            <a href="/lang/ja" lang="ja">日本語</a>
        @else
            <a href="/lang/zh-CN" lang="zh-CN">中文（简体）</a>
        @endif
    </div>
    <div class="top-right links">
        @if (Auth::check())
            <a href="/vote">@lang('welcome.vote')</a>
        @else
            <a href="{{ url('/login') }}">@lang('welcome.login')</a>
            <a href="{{ url('/register') }}">@lang('welcome.register')</a>
        @endif
        @if (Admin::user())
            <a href="/admin">@lang('welcome.admin')</a>
        @endif
    </div>

    <div class="content">
        <div class="title m-b-md">
            @lang('welcome.naomoe')
        </div>
        <div class="subtitle m-b-md">
            @lang('welcome.toyamanaosaimoe')
        </div>

        <div class="links">
            <a href="/vote">@lang('welcome.votes')</a>
            <a href="/schedule">@lang('welcome.schedule')</a>
            <a href="/discuss">@lang('welcome.discuss')</a>
            @if (Route::has('stotk'))
                <a href="/stock">@lang('welcome.stock')</a>
            @endif
            <a href="//tieba.toyama.moe">@lang('welcome.tieba')</a>
            <a href="//git.kingfree.moe/kingfree/naomoe" target="_blank">@lang('welcome.source')</a>
        </div>
    </div>
</div>
</body>
</html>
