<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('闹萌')</title>
    <link type="image/png" rel="shortcut icon" href="/favicon.png">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
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
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
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
    <div class="top-right links">
        @if (Auth::check())
            <a href="/vote">@lang('投票')</a>
        @else
            <a href="{{ url('/login') }}">@lang('登录')</a>
            <a href="{{ url('/register') }}">@lang('注册')</a>
        @endif
        @if (Admin::user())
            <a href="/admin">@lang('后台')</a>
        @endif
        @if (App::isLocale('zh-CN'))
            <a href="/lang/ja">日本語</a>
        @else
            <a href="/lang/zh-CN">中文（简体）</a>
        @endif
    </div>

    <div class="content">
        <div class="title m-b-md">
            naomoe
        </div>

        <div class="links">
            <a href="/vote">@lang('投票')</a>
            <a href="/schedule">@lang('赛程')</a>
            <a href="/discuss">@lang('讨论')</a>
            @if (Route::has('stotk'))
                <a href="/stock">@lang('闹股')</a>
            @endif
            <a href="//tieba.toyama.moe">@lang('贴吧')</a>
            <a href="//git.kingfree.moe/kingfree/naomoe" target="_blank">@lang('源码')</a>
        </div>
    </div>
</div>
</body>
</html>
