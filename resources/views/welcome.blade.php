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
    <?php $showBack = Admin::user() or \Carbon\Carbon::now()->gte(\Carbon\Carbon::createFromDate(2017, 2, 26)); ?>
    <style>
        a {
            color: #e03997;
        }

        a:hover {
            color: #e03997;
        }

        ::selection {
            background-color: #ef9ccb;
        }
a
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
            @if ($showBack)
                background-image: url('/images/nao.jpg');
                background-size: cover;
                background-position: 37% 0%;
            @else
                background-color: #fff;
            @endif
        }

        .flex-center:hover {
            @if ($showBack)
               background-image: url('/images/naos.jpg');
            @endif
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
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
        }

        .content:hover {
            background-color: rgba(255, 255, 255, 0.7);
        }

        .title {
            font-size: 84px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 56px;
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
            font-size: 16px;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
            display: inline;
        }

        .ui.list > a.item {
            color: #0a001f;
            font-size: 20px;
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
        @endif
    </div>

    <div class="content">
        <a class="title m-b-md" href="/vote">
            <img src="/images/naomoe.png" width="40%">
        </a>
        <div class="subtitle m-b-md">
            @lang('welcome.toyamanaosaimoe')
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
                <script src="http://s4.cnzz.com/z_stat.php?id=1261300564&web_id=1261300564" language="JavaScript"></script>
            </div>
            @if ($showBack)
            <div class="item">画师 <a class="" href="http://elfartworld.com/users/102042/">@深蓝杰克</a></div>
            @endif
            <!--div class="item">网站 <a class="" href="http://weibo.com/kingfree/">@王者自由</a></div-->
            <div class="item">运营 <a class="" href="http://tieba.toyama.moe">东山奈央吧</a></div>
        </div>
    </div>
</div>
</body>
</html>
