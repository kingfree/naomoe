
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
            width: 5em;
        }

        table.hon .nid {
            text-align: center;
            vertical-align: top;
            width: 8em;
        }
    </style>

    <table class="hon">
        <tr class="red">
            <th colspan="2" class="gumi">A 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum red">A-1</td>
            <td class="chara red">中川花音@只有神知道的世界</td>
            <td class="i red">151</td>
            <td rowspan="2" class="id red">{!! complink('2017-02-28', '2月28日') !!}<br>中川花音</td>
            <td rowspan="2" class="ni"></td>
            <td rowspan="5" class="nid">{!! complink('2017-03-04', '3月4日') !!}</td>
        </tr>
        <tr>
            <td class="gum">A-2</td>
            <td class="chara">蕾娜·普劳拉@超时空要塞Δ</td>
            <td class="i">57</td>
        </tr>
        <tr>
            <td class="gum">A-3</td>
            <td class="chara">蕾莱·拉·列娜@GATE 奇幻自卫队</td>
            <td class="i"></td>
            <td rowspan="3" class="id">{!! complink('2017-03-02', '3月2日') !!}</td>
            <td rowspan="3" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">A-4</td>
            <td class="chara">绫波@舰队Collection</td>
            <td class="i"></td>
        </tr>
        <tr>
            <td class="gum">A-5</td>
            <td class="chara">潮田渚@暗杀教室OAD</td>
            <td class="i"></td>
        </tr>

        <tr class="orange">
            <th colspan="2" class="gumi">B 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">B-1</td>
            <td class="chara">高坂雪穗@LoveLive!</td>
            <td class="i">94</td>
            <td rowspan="2" class="id orange">{!! complink('2017-02-28', '2月28日') !!}<br>雾岛</td>
            <td rowspan="2" class="ni"></td>
            <td rowspan="4" class="nid">{!! complink('2017-03-04', '3月4日') !!}</td>
        </tr>
        <tr>
            <td class="gum orange">B-2</td>
            <td class="chara orange">雾岛@舰队Collection</td>
            <td class="i orange">109</td>
        </tr>
        <tr>
            <td class="gum">B-3</td>
            <td class="chara">阿波罗@只有神知道的世界 女神篇</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-02', '3月2日') !!}</td>
            <td rowspan="2" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">B-4</td>
            <td class="chara">桐崎千棘@伪恋</td>
            <td class="i"></td>
        </tr>

        <tr class="yellow">
            <th colspan="2" class="gumi">C 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum yellow">C-1</td>
            <td class="chara yellow">由比滨结衣@我的青春恋爱物语果然有问题。</td>
            <td class="i yellow">171</td>
            <td rowspan="2" class="id yellow">{!! complink('2017-02-28', '2月28日') !!}<br>由比滨结衣</td>
            <td rowspan="2" class="ni"></td>
            <td rowspan="4" class="nid">{!! complink('2017-03-04', '3月4日') !!}</td>
        </tr>
        <tr>
            <td class="gum">C-2</td>
            <td class="chara">伊万莉玛丽亚@这个美术部大有问题</td>
            <td class="i">44</td>
        </tr>
        <tr>
            <td class="gum">C-3</td>
            <td class="chara">萝特@终末的伊泽塔</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-02', '3月2日') !!}</td>
            <td rowspan="2" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">C-4</td>
            <td class="chara">白雪@魔法少女育成计划</td>
            <td class="i"></td>
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
            <td rowspan="2" class="ni"></td>
            <td rowspan="4" class="nid">{!! complink('2017-03-04', '3月4日') !!}</td>
        </tr>
        <tr>
            <td class="gum green">D-2</td>
            <td class="chara green">金刚@舰队Collection</td>
            <td class="i green">139</td>
        </tr>
        <tr>
            <td class="gum">D-3</td>
            <td class="chara">高雄@舰队Collection</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-02', '3月2日') !!}</td>
            <td rowspan="2" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">D-4</td>
            <td class="chara">相羽六@魔法战争</td>
            <td class="i"></td>
        </tr>

        <tr class="cyan">
            <th colspan="2" class="gumi">E 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">E-1</td>
            <td class="chara">新子憧@天才麻将少女阿知贺篇</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-01', '3月1日') !!}</td>
            <td rowspan="2" class="ni"></td>
            <td rowspan="4" class="nid">{!! complink('2017-03-05', '3月5日') !!}</td>
        </tr>
        <tr>
            <td class="gum">E-2</td>
            <td class="chara">川岛瑞树@偶像大师灰姑娘女孩</td>
            <td class="i"></td>
        </tr>
        <tr>
            <td class="gum">E-3</td>
            <td class="chara">比叡@舰队Collection</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-03', '3月3日') !!}</td>
            <td rowspan="2" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">E-4</td>
            <td class="chara">汤音@异国迷宫的十字路口</td>
            <td class="i"></td>
        </tr>

        <tr class="blue">
            <th colspan="2" class="gumi">F 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">F-1</td>
            <td class="chara">九条可怜@黄金拼图</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-01', '3月1日') !!}</td>
            <td rowspan="2" class="ni"></td>
            <td rowspan="4" class="nid">{!! complink('2017-03-05', '3月5日') !!}</td>
        </tr>
        <tr>
            <td class="gum">F-2</td>
            <td class="chara">摩耶@舰队Collection</td>
            <td class="i"></td>
        </tr>
        <tr>
            <td class="gum">F-3</td>
            <td class="chara">茨木童子@Fate/Grand Order</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-03', '3月3日') !!}</td>
            <td rowspan="2" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">F-4</td>
            <td class="chara">爱宕@舰队Collection</td>
            <td class="i"></td>
        </tr>

        <tr class="purple">
            <th colspan="2" class="gumi">G 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">G-1</td>
            <td class="chara">敷波@舰队Collection</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-01', '3月1日') !!}</td>
            <td rowspan="2" class="ni"></td>
            <td rowspan="4" class="nid">{!! complink('2017-03-05', '3月5日') !!}</td>
        </tr>
        <tr>
            <td class="gum">G-2</td>
            <td class="chara">小鸭@生存游戏社</td>
            <td class="i"></td>
        </tr>
        <tr>
            <td class="gum">G-3</td>
            <td class="chara">莉瑟罗特·沙尔洛克@TRINITY SEVEN 七人魔法使</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-03', '3月3日') !!}</td>
            <td rowspan="2" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">G-4</td>
            <td class="chara">榛名@舰队Collection</td>
            <td class="i"></td>
        </tr>

        <tr class="pink">
            <th colspan="2" class="gumi">H 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum">H-1</td>
            <td class="chara">露莉亚@碧蓝幻想</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-01', '3月1日') !!}</td>
            <td rowspan="2" class="ni"></td>
            <td rowspan="4" class="nid">{!! complink('2017-03-05', '3月5日') !!}</td>
        </tr>
        <tr>
            <td class="gum">H-2</td>
            <td class="chara">铃乃木凛@爆音少女！！</td>
            <td class="i"></td>
        </tr>
        <tr>
            <td class="gum">H-3</td>
            <td class="chara">克劳蒂雅·恩菲尔德@学战都市Asterisk</td>
            <td class="i"></td>
            <td rowspan="2" class="id">{!! complink('2017-03-03', '3月3日') !!}</td>
            <td rowspan="2" class="ni"></td>
        </tr>
        <tr>
            <td class="gum">H-4</td>
            <td class="chara">室见立华@奋斗吧！系统工程师</td>
            <td class="i"></td>
        </tr>
    </table>
@endsection
