@extends('layouts.app')

@section('title', '关于')

@section('content')
    <style>
        body {
            background-image: url('/images/nao.jpg');
            background-size: cover;
            background-position: 37% 0%;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        table.about {
            float: right;
        }

        .about, .about a {
            color: white;
            font-size: 20px;
            text-shadow: 2px 1px 10px #000000;
        }

        ::selection {
            color: white;
        }

        td, th {
            vertical-align: top;
            padding: .4em 1em;
        }

        ul {
            list-style: none;
        }
    </style>
    <table class="about">
        <tbody>
        <tr>
            <th class="right" lang="ja">原　　作</th>
            <td><a href="http://toyamanao.com/">東山奈央</a></td>
            <td></td>
        </tr>
        <tr>
            <th class="right" lang="ja">企　　画</th>
            <td><a href="http://tieba.toyama.moe/">东山奈央吧</a></td>
            <td></td>
        </tr>
        <tr>
            <th class="right" lang="ja">監　　督</th>
            <td><a href="http://weibo.com/kingfree">王者自由</a></td>
            <td></td>
        </tr>
        <tr>
            <th class="right" lang="ja">プロデューサー</th>
            <td><a href="http://weibo.com/horieyui">千樱随舞</a></td>
            <td></td>
        </tr>
        <tr>
            <th class="right" lang="ja">原　　画</th>
            <td><a href="http://www.pixiv.net/member.php?id=1562284">深蓝杰克</a></td>
            <td lang="ja"><a href="http://www.pixiv.net/member.php?id=197076">ぴょん吉</a></td>
        </tr>
        <tr>
            <th class="right" lang="ja">提　　名</th>
            <td><a href="http://weibo.com/2630753673">我太小白</a></td>
            <td><a href="http://weibo.com/horieyui">千樱随舞</a></td>
        </tr>
        <tr>
            <th class="right" lang="ja">文　　字</th>
            <td colspan="2">三更半夜来偷鸡</td>
        </tr>
        <tr>
            <th class="right" lang="ja">運　　営</th>
            <td><a href="http://weibo.com/horieyui">千樱随舞</a></td>
            <td><a href="http://weibo.com/kingfree">王者自由</a></td>
        </tr>
        <tr>
            <th></th>
            <td>游离状态</td>
            <td lang="ja">琉璃色の記憶</td>
        </tr>
        <tr>
            <th></th>
            <td>鑫哥有节操</td>
            <td>三更半夜来偷鸡</td>
        </tr>
        <tr>
            <th></th>
            <td>KA</td>
            <td>萌萌的灵梦</td>
        </tr>
        <tr>
            <th class="right" lang="ja">ロゴデザイン</th>
            <td>雪　　酥</td>
            <td>鑫哥有节操</td>
        </tr>
        <tr>
            <th class="right" lang="ja">公式サイト制作</th>
            <td><a href="http://weibo.com/kingfree">王者自由</a></td>
            <td></td>
        </tr>
        <tr>
            <th class="right" lang="ja">公式ホームページ</th>
            <td colspan="2"><a href="http://nao.toyama.moe">nao.toyama.moe</a></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <th class="right">制　　作</th>
            <td colspan="2">
                闹萌制作委员会
            </td>
        </tr>
        </tbody>
@endsection

@section('footer')
@endsection