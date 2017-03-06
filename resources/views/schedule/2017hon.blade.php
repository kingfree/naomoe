
@section('schedule')

    <style>
        table.hon th {
            border: white 2px solid;
            border-radius: 6px;
            background-color: #e974b6;
            color: white;
            padding: 4px;
        }

        table.hon tr.pink th, table.hon td.pink {
            border-radius: 0;
            background-color: #f892d2;
        }

        table.hon tr.blue th, table.hon td.blue {
            border-radius: 0;
            background-color: #74b6e9;
        }

        table.hon tr.green th, table.hon td.green {
            border-radius: 0;
            background-color: #b6e974;
        }

        table.hon tr.orange th, table.hon td.orange {
            border-radius: 0;
            background-color: #ffc966;
        }

        table.hon tr.purple th, table.hon td.purple {
            border-radius: 0;
            background-color: #dea3ff;
        }

        table.hon tr.yellow th, table.hon td.yellow {
            border-radius: 0;
            background-color: #ffea6e;
        }

        table.hon tr.red th, table.hon td.red {
            border-radius: 0;
            background-color: #ff7f7f;
        }

        table.hon tr.cyan th, table.hon td.cyan {
            border-radius: 0;
            background-color: #9fd5dd;
        }

        table.hon tr.pink.light th, table.hon td.pink.light {
            background-color: #fcdef1;
        }

        table.hon tr.blue.light th, table.hon td.blue.light {
            background-color: #d5e9f8;
        }

        table.hon tr.green.light th, table.hon td.green.light {
            background-color: #e9f8d5;
        }

        table.hon tr.orange.light th, table.hon td.orange.light {
            background-color: #ffeed1;
        }

        table.hon tr.purple.light th, table.hon td.purple.light {
            background-color: #f5e3ff;
        }

        table.hon tr.yellow.light th, table.hon td.yellow.light {
            background-color: #fff8d3;
        }

        table.hon tr.red.light th, table.hon td.red.light {
            background-color: #ffd8d8;
        }

        table.hon tr.cyan.light th, table.hon td.cyan.light {
            background-color: #e2f2f4;
        }

        table.hon td {
            border: #fecfa7 1px solid;
            border-radius: 6px;
            padding: 3px;
        }

        table.hon .gumi {
            text-align: center;
        }

        table.hon .ikai {
            text-align: center;
        }

        table.hon .nikai {
            text-align: center;
        }

        table.hon .gum {
            text-align: left;
            width: 3em;
        }

        table.hon .chara {
            text-align: left;
            width: 38em;
        }

        table.hon .i {
            text-align: right;
            width: 5em;
        }

        table.hon .id {
            text-align: center;
            vertical-align: middle;
            width: 8em;
        }

        table.hon .ni {
            text-align: right;
            vertical-align: middle;
            width: 5em;
        }

        table.hon .nid {
            text-align: center;
            vertical-align: middle;
            width: 8em;
        }
    </style>
    <style>
        table.finale th {
            border: #fecfa7 2px solid;
            border-radius: 6px;
            background-color: #ffffff;
            color: #e974b6;
            padding: 4px;
            text-align: center;
        }

        table.finale tr.pink th, table.finale td.pink {
            border-radius: 0;
            background-color: #f892d2;
        }

        table.finale tr.blue th, table.finale td.blue {
            border-radius: 0;
            background-color: #74b6e9;
        }

        table.finale tr.green th, table.finale td.green {
            border-radius: 0;
            background-color: #b6e974;
        }

        table.finale tr.orange th, table.finale td.orange {
            border-radius: 0;
            background-color: #ffc966;
        }

        table.finale tr.purple th, table.finale td.purple {
            border-radius: 0;
            background-color: #dea3ff;
        }

        table.finale tr.yellow th, table.finale td.yellow {
            border-radius: 0;
            background-color: #ffea6e;
        }

        table.finale tr.red th, table.finale td.red {
            border-radius: 0;
            background-color: #ff7f7f;
        }

        table.finale tr.cyan th, table.finale td.cyan {
            border-radius: 0;
            background-color: #9fd5dd;
        }

        table.finale tr.pink.light th, table.finale td.pink.light {
            background-color: #fcdef1;
        }

        table.finale tr.blue.light th, table.finale td.blue.light {
            background-color: #d5e9f8;
        }

        table.finale tr.green.light th, table.finale td.green.light {
            background-color: #e9f8d5;
        }

        table.finale tr.orange.light th, table.finale td.orange.light {
            background-color: #ffeed1;
        }

        table.finale tr.purple.light th, table.finale td.purple.light {
            background-color: #f5e3ff;
        }

        table.finale tr.yellow.light th, table.finale td.yellow.light {
            background-color: #fff8d3;
        }

        table.finale tr.red.light th, table.finale td.red.light {
            background-color: #ffd8d8;
        }

        table.finale tr.cyan.light th, table.finale td.cyan.light {
            background-color: #e2f2f4;
        }

        table.finale td {
            border: #fecfa7 1px solid;
            border-radius: 6px;
            padding: 3px;
        }

        table.finale .eight {
            text-align: center;
        }

        table.finale .four {
            text-align: center;
        }

        table.finale .two {
            text-align: center;
        }

        table.finale .one {
            text-align: center;
        }

        table.finale .gum {
            text-align: center;
            width: 2em;
            text-shadow: 0px 1px 3px pink;
        }

        table.finale .chara {
            text-align: left;
            width: 20em;
        }

        table.finale .i {
            text-align: right;
            width: 5em;
        }

        table.finale .id {
            text-align: center;
            vertical-align: middle;
            width: 8em;
        }

        table.finale span.work {
            display: block;
            color: white;
            font-size: 12px;
        }

    </style>

    <table class="finale">
        <tr>
            <th colspan="3" class="eight">八强</th>
            <th colspan="3" class="four">四强</th>
        </tr>
        <tr>
            <td rowspan="2" class="gum">東</td>
            <td class="chara purple">新子憧<span class="work">@天才麻将少女阿知贺篇</span></td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-07', '3月7日') !!}</td>
            <td rowspan="2" class="i"></td>
            <td rowspan="4" class="id">{!! complink('2017-03-09', '3月9日') !!}</td>
        </tr>
        <tr>
            <td class="chara green">金刚<span class="work">@舰队Collection</span></td>
            <td class="i"></td>
        </tr>
        <tr>
            <td rowspan="2" class="gum">西</td>
            <td class="chara cyan">榛名<span class="work">@舰队Collection</span></td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-08', '3月8日') !!}</td>
            <td rowspan="2" class="i"></td>
        </tr>
        <tr>
            <td class="chara orange">由比滨结衣<span class="work">@我的青春恋爱物语果然有问题。</span></td>
            <td class="i"></td>
        </tr>
        <tr>
            <td rowspan="2" class="gum">南</td>
            <td class="chara red">铃乃木凛<span class="work">@爆音少女！！</span></td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-07', '3月7日') !!}</td>
            <td rowspan="2" class="i"></td>
            <td rowspan="4" class="id">{!! complink('2017-03-09', '3月9日') !!}</td>
        </tr>
        <tr>
            <td class="chara pink">中川花音<span class="work">@只有神知道的世界</span></td>
            <td class="i"></td>
        </tr>
        <tr>
            <td rowspan="2" class="gum">北</td>
            <td class="chara yellow">桐崎千棘<span class="work">@伪恋</span></td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-08', '3月8日') !!}</td>
            <td rowspan="2" class="i"></td>
        </tr>
        <tr>
            <td class="chara blue">九条可怜<span class="work">@黄金拼图</span></td>
            <td class="i"></td>
        </tr>
    </table>

    <hr>

    <table class="finale" style="display: none;">
        <tr>
            <th rowspan="2">萌王战</th>
            <td class="chara"></td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-11', '3月11日') !!}</td>
        </tr>
        <tr>
            <td class="chara"></td>
            <td class="i"></td>
        </tr>
        <tr>
            <th rowspan="2">三位战</th>
            <td class="chara"></td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-10', '3月10日') !!}</td>
        </tr>
        <tr>
            <td class="chara"></td>
            <td class="i"></td>
        </tr>
    </table>

    <hr>

    <table class="hon">
        <tr class="pink">
            <th colspan="2" class="gumi">A 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum pink">A-1</td>
            <td class="chara pink">中川花音@只有神知道的世界</td>
            <td class="i pink">151</td>
            <td rowspan="2" class="id pink">{!! complink('2017-02-28', '2月28日') !!}<br>中川花音</td>
            <td rowspan="2" class="ni pink">155</td>
            <td rowspan="5" class="nid pink">{!! complink('2017-03-04', '3月4日') !!}<br>中川花音</td>
        </tr>
        <tr>
            <td class="gum">A-2</td>
            <td class="chara">蕾娜·普劳拉@超时空要塞Δ</td>
            <td class="i">57</td>
        </tr>
        <tr>
            <td class="gum">A-3</td>
            <td class="chara">蕾莱·拉·列娜@GATE 奇幻自卫队</td>
            <td class="i">54</td>
            <td rowspan="3" class="id pink light">{!! complink('2017-03-02', '3月2日') !!}<br>绫波</td>
            <td rowspan="3" class="ni pink light">70</td>
        </tr>
        <tr>
            <td class="gum pink light">A-4</td>
            <td class="chara pink light">绫波@舰队Collection</td>
            <td class="i pink light">57</td>
        </tr>
        <tr>
            <td class="gum">A-5</td>
            <td class="chara">潮田渚@暗杀教室OAD</td>
            <td class="i">18</td>
        </tr>

        <tr class="yellow">
            <th colspan="2" class="gumi">B 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">B-1</td>
            <td class="chara">高坂雪穗@LoveLive!</td>
            <td class="i">94</td>
            <td rowspan="2" class="id yellow light">{!! complink('2017-02-28', '2月28日') !!}<br>雾岛</td>
            <td rowspan="2" class="ni yellow light">134</td>
            <td rowspan="4" class="nid yellow">{!! complink('2017-03-04', '3月4日') !!}<br>桐崎千棘</td>
        </tr>
        <tr>
            <td class="gum yellow light">B-2</td>
            <td class="chara yellow light">雾岛@舰队Collection</td>
            <td class="i yellow light">109</td>
        </tr>
        <tr>
            <td class="gum">B-3</td>
            <td class="chara">阿波罗@只有神知道的世界 女神篇</td>
            <td class="i">35</td>
            <td rowspan="2" class="id yellow">{!! complink('2017-03-02', '3月2日') !!}<br>桐崎千棘</td>
            <td rowspan="2" class="ni yellow">141</td>
        </tr>
        <tr>
            <td class="gum yellow">B-4</td>
            <td class="chara yellow">桐崎千棘@伪恋</td>
            <td class="i yellow">108</td>
        </tr>

        <tr class="orange">
            <th colspan="2" class="gumi">C 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum orange">C-1</td>
            <td class="chara orange">由比滨结衣@我的青春恋爱物语果然有问题。</td>
            <td class="i orange">171</td>
            <td rowspan="2" class="id orange">{!! complink('2017-02-28', '2月28日') !!}<br>由比滨结衣</td>
            <td rowspan="2" class="ni orange">204</td>
            <td rowspan="4" class="nid orange">{!! complink('2017-03-04', '3月4日') !!}<br>由比滨结衣</td>
        </tr>
        <tr>
            <td class="gum">C-2</td>
            <td class="chara">伊万莉玛丽亚@这个美术部大有问题</td>
            <td class="i">44</td>
        </tr>
        <tr>
            <td class="gum">C-3</td>
            <td class="chara">萝特@终末的伊泽塔</td>
            <td class="i">52</td>
            <td rowspan="2" class="id orange light">{!! complink('2017-03-02', '3月2日') !!}<br>白雪</td>
            <td rowspan="2" class="ni orange light">35</td>
        </tr>
        <tr>
            <td class="gum orange light">C-4</td>
            <td class="chara orange light">白雪@魔法少女育成计划</td>
            <td class="i orange light">64</td>
        </tr>

        <tr class="green">
            <th colspan="2" class="gumi">D 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">D-1</td>
            <td class="chara">佐佐木千穗@打工吧！魔王大人</td>
            <td class="i">81</td>
            <td rowspan="2" class="id green">{!! complink('2017-02-28', '2月28日') !!}<br>金刚</td>
            <td rowspan="2" class="ni green">157</td>
            <td rowspan="4" class="nid green">{!! complink('2017-03-04', '3月4日') !!}<br>金刚</td>
        </tr>
        <tr>
            <td class="gum green">D-2</td>
            <td class="chara green">金刚@舰队Collection</td>
            <td class="i green">139</td>
        </tr>
        <tr>
            <td class="gum green light">D-3</td>
            <td class="chara green light">高雄@舰队Collection</td>
            <td class="i green light">70</td>
            <td rowspan="2" class="id green light">{!! complink('2017-03-02', '3月2日') !!}<br>高雄</td>
            <td rowspan="2" class="ni green light">61 </td>
        </tr>
        <tr>
            <td class="gum">D-4</td>
            <td class="chara">相羽六@魔法战争</td>
            <td class="i">50</td>
        </tr>

        <tr class="purple">
            <th colspan="2" class="gumi">E 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum purple">E-1</td>
            <td class="chara purple">新子憧@天才麻将少女阿知贺篇</td>
            <td class="i purple">114</td>
            <td rowspan="2" class="id purple">{!! complink('2017-03-01', '3月1日') !!}<br>新子憧</td>
            <td rowspan="2" class="ni purple">113</td>
            <td rowspan="4" class="nid purple">{!! complink('2017-03-05', '3月5日') !!}<br>新子憧</td>
        </tr>
        <tr>
            <td class="gum">E-2</td>
            <td class="chara">川岛瑞树@偶像大师灰姑娘女孩</td>
            <td class="i">38</td>
        </tr>
        <tr>
            <td class="gum purple light">E-3</td>
            <td class="chara purple light">比叡@舰队Collection</td>
            <td class="i purple light">62</td>
            <td class="id purple light">{!! complink('2017-03-03', '3月3日') !!}<br>比叡</td>
            <td class="ni purple light">73</td>
        </tr>
        <tr>
            <td class="gum purple light">E-4</td>
            <td class="chara purple light">汤音@异国迷宫的十字路口</td>
            <td class="i purple light">62</td>
            <td class="id purple light">{!! complink('2017-03-03', '3月3日') !!}<br>汤音</td>
            <td class="ni purple light">41</td>
        </tr>

        <tr class="blue">
            <th colspan="2" class="gumi">F 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum blue">F-1</td>
            <td class="chara blue">九条可怜@黄金拼图</td>
            <td class="i blue">108</td>
            <td rowspan="2" class="id blue">{!! complink('2017-03-01', '3月1日') !!}<br>九条可怜</td>
            <td rowspan="2" class="ni blue">130</td>
            <td rowspan="4" class="nid blue">{!! complink('2017-03-05', '3月5日') !!}<br>九条可怜</td>
        </tr>
        <tr>
            <td class="gum">F-2</td>
            <td class="chara">摩耶@舰队Collection</td>
            <td class="i">40</td>
        </tr>
        <tr>
            <td class="gum">F-3</td>
            <td class="chara">茨木童子@Fate/Grand Order</td>
            <td class="i">26</td>
            <td rowspan="2" class="id blue light">{!! complink('2017-03-03', '3月3日') !!}<br>爱宕</td>
            <td rowspan="2" class="ni blue light">95</td>
        </tr>
        <tr>
            <td class="gum blue light">F-4</td>
            <td class="chara blue light">爱宕@舰队Collection</td>
            <td class="i blue light">89</td>
        </tr>

        <tr class="cyan">
            <th colspan="2" class="gumi">G 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum cyan light">G-1</td>
            <td class="chara cyan light">敷波@舰队Collection</td>
            <td class="i cyan light">83</td>
            <td rowspan="2" class="id cyan light">{!! complink('2017-03-01', '3月1日') !!}<br>敷波</td>
            <td rowspan="2" class="ni cyan light">34</td>
            <td rowspan="4" class="nid cyan">{!! complink('2017-03-05', '3月5日') !!}<br>榛名</td>
        </tr>
        <tr>
            <td class="gum">G-2</td>
            <td class="chara">小鸭@生存游戏社</td>
            <td class="i">47</td>
        </tr>
        <tr>
            <td class="gum">G-3</td>
            <td class="chara">莉瑟罗特·沙尔洛克@TRINITY SEVEN 七人魔法使</td>
            <td class="i">34</td>
            <td rowspan="2" class="id cyan">{!! complink('2017-03-03', '3月3日') !!}<br>榛名</td>
            <td rowspan="2" class="ni cyan">157</td>
        </tr>
        <tr>
            <td class="gum cyan">G-4</td>
            <td class="chara cyan">榛名@舰队Collection</td>
            <td class="i cyan">84</td>
        </tr>

        <tr class="red">
            <th colspan="2" class="gumi">H 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">H-1</td>
            <td class="chara">露莉亚@碧蓝幻想</td>
            <td class="i">52</td>
            <td rowspan="2" class="id red">{!! complink('2017-03-01', '3月1日') !!}<br>铃乃木凛</td>
            <td rowspan="2" class="ni red">84</td>
            <td rowspan="4" class="nid red">{!! complink('2017-03-05', '3月5日') !!}<br>铃乃木凛</td>
        </tr>
        <tr>
            <td class="gum red">H-2</td>
            <td class="chara red">铃乃木凛@爆音少女！！</td>
            <td class="i red">74</td>
        </tr>
        <tr>
            <td class="gum">H-3</td>
            <td class="chara">克劳蒂雅·恩菲尔德@学战都市Asterisk</td>
            <td class="i">48</td>
            <td rowspan="2" class="id red light">{!! complink('2017-03-03', '3月3日') !!}<br>室见立华</td>
            <td rowspan="2" class="ni light">77</td>
        </tr>
        <tr>
            <td class="gum red light">H-4</td>
            <td class="chara red light">室见立华@奋斗吧！系统工程师</td>
            <td class="i red light">53</td>
        </tr>
    </table>
@endsection
