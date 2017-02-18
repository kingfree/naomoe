<!DOCTYPE html>
<html lang="{{ language() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('welcome.naomoe')</title>
    <link type="image/png" rel="shortcut icon" href="/favicon.png">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/semantic-ui/semantic.min.css">
    <style>
        a {
            color: #e03997;
        }

        a:hover {
            color: #e03997;
        }

        html, body {
            <?php $showBack = Admin::user() or \Carbon\Carbon::now()->gte(\Carbon\Carbon::createFromDate(2017, 2, 26)); ?>
            @if ($showBack)
                  color: #e03997;
            @else
                  color: #e03997;
            @endif
            @if ($showBack)
                background-image: url('/images/background.jpg');
                background-size: cover;
                background-position: 37% 0%;
            @else
                background-color: #fff;
            @endif
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
            padding: 10px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.45);
        }

        .title {
            font-size: 84px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 64px;
        }

        .links {
            padding: 5px;
        }

        .links > a {
            @if ($showBack)
              color: #ffffff;
            @else
              color: #636b6f;
            -webkit-text-stroke: 0px #fff;
            @endif
              padding: 0 25px;
            font-size: 18px;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            display: inline;
        }

        .ui.list > a.item {
            color: #0a001f;
        }

        .ui.list > a.item:hover {
            font-weight: bold;
            color: #e03997;
        }

        a:hover {
            font-weight: bold;
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
        <a class="title m-b-md" href="/vote">
            @lang('welcome.naomoe')
        </a>
        <div class="subtitle m-b-md">
            @lang('welcome.toyamanaosaimoe')
        </div>

        <div class="links ui huge celled horizontal list">
            <a class="item" href="/vote">@lang('welcome.votes')</a>
            <a class="item" href="/schedule">@lang('welcome.schedule')</a>
            <a class="item" href="/discuss">@lang('welcome.discuss')</a>
            @if (Route::has('stotk'))
                <a class="item" href="/stock">@lang('welcome.stock')</a>
            @endif
            <a class="item" href="//tieba.toyama.moe">@lang('welcome.tieba')</a>
            <a class="item" href="//git.kingfree.moe/kingfree/naomoe" target="_blank">@lang('welcome.source')</a>
        </div>
    </div>
</div>
</body>
</html>
