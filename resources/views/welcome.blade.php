<!DOCTYPE html>
<html lang="{{ language() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@lang('welcome.naomoe')</title>
    <link type="image/png" rel="shortcut icon" href="/favicon.png">

    <!-- Styles -->
    <link href="//cdn.bootcss.com/semantic-ui/2.2.7/semantic.min.css" rel="stylesheet">
    <style>
        a {
            color: #e03997;
        }

        a:hover {
            color: #e03997;
        }

        ::selection {
            background: #e974b6;
            color: white;
        }

        html, body {
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
            background-image: url('/images/naos.jpg');
            background-size: cover;
            background-position: 37% 0%;
            transition: background-image 0.6s ease-out;
        }

        .flex-center:hover {
            background-image: url('/images/2017yui.jpg');
            background-size: contain;
            background-position: 0% 0%;
            transition: background-image 0.6s ease-in;
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

        .footer {
            font-size: 14px;
            color: #0a001f;
        }

        .foot-left {
            position: absolute;
            left: 10px;
            bottom: 18px;
        }

        .foot-right {
            position: absolute;
            right: 10px;
            bottom: 18px;
        }

        .content {
            padding: 10px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0);
            border-radius: 10px;
            transition: background-color 0.3s linear;
        }

        .content:hover {
            background-color: rgba(255, 255, 255, 0.7);
            transition: background-color 0.3s linear;
        }

        .title {
            font-size: 84px;
            font-weight: bold;
            line-height: 90px;
        }

        .subtitle {
            font-size: 56px;
            line-height: 60px;
            text-shadow: -2px 1px 3px white;
        }

        .links {
            padding: 5px;
        }

        .links > a {
            color: #ffffff;
            padding: 0 25px;
            font-size: 16px;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            display: inline;
        }

        .ui.list > a.item {
            text-shadow: 0px 1px 3px white;
            font-weight: normal;
            color: black;
            font-size: 20px;
        }

        .ui.list > a.item:hover {
            color: #e03997;
        }

        a:hover {
            text-shadow: -2px 1px 3px white;
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
        @endif
    </div>

    <div class="content">
        <a class="title m-b-md" href="/vote">
            <img src="/images/naomoe.png" width="40%">
        </a>
        <div class="subtitle m-b-md">
            <a href="http://toyamanao.com" target="_blank">@lang('welcome.toyamanao')</a>@lang('welcome.saimoe')
        </div>

        <div class="ui horizontal huge bulleted link list">
            <a class="item" href="/vote">@lang('welcome.votes')</a>
            <a class="item" href="/schedule">@lang('welcome.schedule')</a>
            <a class="item" href="/discuss">@lang('welcome.discuss')</a>
            @if (Route::has('stotk'))
                <a class="item" href="/stock">@lang('welcome.stock')</a>
            @endif
            @if (Admin::user())
                <a class="item" href="/admin">@lang('welcome.admin')</a>
            @endif
        </div>
    </div>

    <div class="footer">
        <div class="foot-right ui link list">
            <div style="display: none">
                <script src="//s4.cnzz.com/z_stat.php?id=1261300564&web_id=1261300564"
                        language="JavaScript"></script>
            </div>
            <div class="item">イラ <a href="http://www.pixiv.net/member_illust.php?id=197076">@ぴょん吉</a></div>
            <div class="item">画师 <a href="http://www.pixiv.net/member_illust.php?mode=medium&illust_id=61616191">@深蓝杰克</a></div>
            <div class="item"><a href="/about">闹萌制作委员会</a></div>
        </div>
    </div>
</div>
</body>
</html>
