
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
            font-size: 15px;
            text-shadow: 0 1px 1px lightpink;
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
            text-shadow: 1px 1px 2px white;
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
            font-size: 30px;
            text-shadow: 0 2px 3px green;
            font-family: "Kaiti TC";
        }

        table.finale .chara {
            text-align: left;
            width: 20em;
            padding-left: 8px;
        }

        table.finale .charas {
            text-align: left;
            width: 10em;
            padding-left: 8px;
        }

        table.finale .i {
            text-align: right;
            width: 3em;
            font-size: 16px;
            padding-right: 8px;
        }

        table.finale .index {
            text-align: center;
            width: 2em;
            color: white;
            font-size: 18px;
            text-shadow: 1px 1px 2px gray;
        }

        table.finale .id {
            text-align: center;
            vertical-align: middle;
            width: 7em;
            font-size: 16px;
        }

        table.finale span.work {
            display: block;
            color: white;
            font-size: 12px;
            text-shadow: 1px 1px 2px gray;
        }

    </style>

    <table class="finale">
        <tr>
            <th colspan="3">{!! complink('2017-03-11', '3月11日') !!}<br>萌王战<br>（決勝）</th>
            <td rowspan="6">
                <img class="ui fluid image" src="/images/yuis.jpg">
            </td>
        </tr><tr>
        <td class="index orange">①</td>
            <td class="charas orange">{{App\Character::find(179)->lname}}<span class="work">＠{{App\Character::find(179)->lwork}}</span></td>
            <td class="i orange">346</td>
        </tr>
        <tr>
            <td class="index yellow">②</td>
            <td class="charas yellow">{{App\Character::find(257)->lname}}<span class="work">＠{{App\Character::find(257)->lwork}}</td>
            <td class="i yellow">274</td>
        </tr>
        <tr>
            <th colspan="3">{!! complink('2017-03-10', '3月10日') !!}<br>三位战<br>（3位戦）</th>
            </tr><tr>
            <td class="index pink">③</td>
            <td class="charas pink">{{App\Character::find(254)->lname}}<span class="work">＠{{App\Character::find(254)->lwork}}</td>
            <td class="i pink">83</td>
        </tr>
        <tr>
            <td class="index purple">④</td>
            <td class="charas purple">{{App\Character::find(255)->lname}}<span class="work">＠{{App\Character::find(255)->lwork}}</td>
            <td class="i purple">63</td>
        </tr>
    </table>

    <hr>

    <table class="finale">
        <tr>
            <th colspan="3" class="eight">八强（ベスト８）</th>
            <th colspan="3" class="four">四强（ベスト４）</th>
        </tr>
        <tr>
            <td rowspan="2" class="gum">東</td>
            <td class="chara purple">{{App\Character::find(255)->lname}}<span class="work">＠{{App\Character::find(255)->lwork}}</span></td>
            <td class="i purple">93</td>
            <td rowspan="2" class="id purple">{!! complink('2017-03-07', '3月7日') !!}<br>{{App\Character::find(255)->lname}}</td>
            <td rowspan="2" class="i purple">175</td>
            <td rowspan="4" class="id orange">{!! complink('2017-03-09', '3月9日') !!}<br><br>{{App\Character::find(179)->lname}}</td>
        </tr>
        <tr>
            <td class="chara green">{{App\Character::find(280)->lname}}<span class="work">＠{{App\Character::find(280)->lwork}}</span></td>
            <td class="i green">80</td>
        </tr>
        <tr>
            <td rowspan="2" class="gum">西</td>
            <td class="chara cyan">{{App\Character::find(221)->lname}}<span class="work">＠{{App\Character::find(280)->lwork}}</span></td>
            <td class="i cyan">157</td>
            <td rowspan="2" class="id orange">{!! complink('2017-03-08', '3月8日') !!}<br>{{App\Character::find(179)->lname}}</td>
            <td rowspan="2" class="i orange">261</td>
        </tr>
        <tr>
            <td class="chara orange">{{App\Character::find(179)->lname}}<span class="work">＠{{App\Character::find(179)->lwork}}</span></td>
            <td class="i orange">390</td>
        </tr>
        <tr>
            <td rowspan="2" class="gum">南</td>
            <td class="chara red">{{App\Character::find(314)->lname}}<span class="work">＠{{App\Character::find(314)->lwork}}</span></td>
            <td class="i red">45</td>
            <td rowspan="2" class="id pink">{!! complink('2017-03-07', '3月7日') !!}<br>{{App\Character::find(254)->lname}}</td>
            <td rowspan="2" class="i pink">200</td>
            <td rowspan="4" class="id yellow">{!! complink('2017-03-09', '3月9日') !!}<br><br>{{App\Character::find(257)->lname}}</td>
        </tr>
        <tr>
            <td class="chara pink">{{App\Character::find(254)->lname}}<span class="work">＠{{App\Character::find(254)->lwork}}</span></td>
            <td class="i pink">114</td>
        </tr>
        <tr>
            <td rowspan="2" class="gum">北</td>
            <td class="chara yellow">{{App\Character::find(257)->lname}}<span class="work">＠{{App\Character::find(257)->lwork}}</span></td>
            <td class="i yellow">296</td>
            <td rowspan="2" class="id yellow">{!! complink('2017-03-08', '3月8日') !!}<br>{{App\Character::find(257)->lname}}</td>
            <td rowspan="2" class="i yellow">239</td>
        </tr>
        <tr>
            <td class="chara blue">{{App\Character::find(178)->lname}}<span class="work">＠{{App\Character::find(178)->lwork}}</span></td>
            <td class="i blue">274</td>
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
            <td class="chara pink">{{App\Character::find(254)->lname}}＠{{App\Character::find(254)->lwork}}</td>
            <td class="i pink">151</td>
            <td rowspan="2" class="id pink">{!! complink('2017-02-28', '2月28日') !!}<br>{{App\Character::find(254)->lname}}</td>
            <td rowspan="2" class="ni pink">155</td>
            <td rowspan="5" class="nid pink">{!! complink('2017-03-04', '3月4日') !!}<br>{{App\Character::find(254)->lname}}</td>
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
            <td class="chara pink light">绫波＠{{App\Character::find(280)->lwork}}</td>
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
            <td rowspan="4" class="nid yellow">{!! complink('2017-03-04', '3月4日') !!}<br>{{App\Character::find(257)->lname}}</td>
        </tr>
        <tr>
            <td class="gum yellow light">B-2</td>
            <td class="chara yellow light">雾岛＠{{App\Character::find(280)->lwork}}</td>
            <td class="i yellow light">109</td>
        </tr>
        <tr>
            <td class="gum">B-3</td>
            <td class="chara">阿波罗＠{{App\Character::find(254)->lwork}} 女神篇</td>
            <td class="i">35</td>
            <td rowspan="2" class="id yellow">{!! complink('2017-03-02', '3月2日') !!}<br>{{App\Character::find(257)->lname}}</td>
            <td rowspan="2" class="ni yellow">141</td>
        </tr>
        <tr>
            <td class="gum yellow">B-4</td>
            <td class="chara yellow">{{App\Character::find(257)->lname}}＠{{App\Character::find(257)->lwork}}</td>
            <td class="i yellow">108</td>
        </tr>

        <tr class="orange">
            <th colspan="2" class="gumi">C 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum orange">C-1</td>
            <td class="chara orange">{{App\Character::find(179)->lname}}＠{{App\Character::find(179)->lwork}}</td>
            <td class="i orange">171</td>
            <td rowspan="2" class="id orange">{!! complink('2017-02-28', '2月28日') !!}<br>{{App\Character::find(179)->lname}}</td>
            <td rowspan="2" class="ni orange">204</td>
            <td rowspan="4" class="nid orange">{!! complink('2017-03-04', '3月4日') !!}<br>{{App\Character::find(179)->lname}}</td>
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
            <td rowspan="2" class="id green">{!! complink('2017-02-28', '2月28日') !!}<br>{{App\Character::find(280)->lname}}</td>
            <td rowspan="2" class="ni green">157</td>
            <td rowspan="4" class="nid green">{!! complink('2017-03-04', '3月4日') !!}<br>{{App\Character::find(280)->lname}}</td>
        </tr>
        <tr>
            <td class="gum green">D-2</td>
            <td class="chara green">{{App\Character::find(280)->lname}}＠{{App\Character::find(280)->lwork}}</td>
            <td class="i green">139</td>
        </tr>
        <tr>
            <td class="gum green light">D-3</td>
            <td class="chara green light">高雄＠{{App\Character::find(280)->lwork}}</td>
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
            <td class="chara purple">{{App\Character::find(255)->lname}}＠{{App\Character::find(255)->lwork}}</td>
            <td class="i purple">114</td>
            <td rowspan="2" class="id purple">{!! complink('2017-03-01', '3月1日') !!}<br>{{App\Character::find(255)->lname}}</td>
            <td rowspan="2" class="ni purple">113</td>
            <td rowspan="4" class="nid purple">{!! complink('2017-03-05', '3月5日') !!}<br>{{App\Character::find(255)->lname}}</td>
        </tr>
        <tr>
            <td class="gum">E-2</td>
            <td class="chara">川岛瑞树@偶像大师灰姑娘女孩</td>
            <td class="i">38</td>
        </tr>
        <tr>
            <td class="gum purple light">E-3</td>
            <td class="chara purple light">比叡＠{{App\Character::find(280)->lwork}}</td>
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
            <td class="chara blue">{{App\Character::find(178)->lname}}＠{{App\Character::find(178)->lwork}}</td>
            <td class="i blue">108</td>
            <td rowspan="2" class="id blue">{!! complink('2017-03-01', '3月1日') !!}<br>{{App\Character::find(178)->lname}}</td>
            <td rowspan="2" class="ni blue">130</td>
            <td rowspan="4" class="nid blue">{!! complink('2017-03-05', '3月5日') !!}<br>{{App\Character::find(178)->lname}}</td>
        </tr>
        <tr>
            <td class="gum">F-2</td>
            <td class="chara">摩耶＠{{App\Character::find(280)->lwork}}</td>
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
            <td class="chara blue light">爱宕＠{{App\Character::find(280)->lwork}}</td>
            <td class="i blue light">89</td>
        </tr>

        <tr class="cyan">
            <th colspan="2" class="gumi">G 组</th>
            <th colspan="2" class="ikai">一回战</th>
            <th colspan="2" class="nikai">二回战</th>
        </tr>
        <tr>
            <td class="gum cyan light">G-1</td>
            <td class="chara cyan light">敷波＠{{App\Character::find(280)->lwork}}</td>
            <td class="i cyan light">83</td>
            <td rowspan="2" class="id cyan light">{!! complink('2017-03-01', '3月1日') !!}<br>敷波</td>
            <td rowspan="2" class="ni cyan light">34</td>
            <td rowspan="4" class="nid cyan">{!! complink('2017-03-05', '3月5日') !!}<br>{{App\Character::find(221)->lname}}</td>
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
            <td rowspan="2" class="id cyan">{!! complink('2017-03-03', '3月3日') !!}<br>{{App\Character::find(221)->lname}}</td>
            <td rowspan="2" class="ni cyan">157</td>
        </tr>
        <tr>
            <td class="gum cyan">G-4</td>
            <td class="chara cyan">{{App\Character::find(221)->lname}}＠{{App\Character::find(280)->lwork}}</td>
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
            <td rowspan="2" class="id red">{!! complink('2017-03-01', '3月1日') !!}<br>{{App\Character::find(314)->lname}}</td>
            <td rowspan="2" class="ni red">84</td>
            <td rowspan="4" class="nid red">{!! complink('2017-03-05', '3月5日') !!}<br>{{App\Character::find(314)->lname}}</td>
        </tr>
        <tr>
            <td class="gum red">H-2</td>
            <td class="chara red">{{App\Character::find(314)->lname}}＠{{App\Character::find(314)->lwork}}</td>
            <td class="i red">74</td>
        </tr>
        <tr>
            <td class="gum">H-3</td>
            <td class="chara">克劳蒂雅·恩菲尔德@学战都市Asterisk</td>
            <td class="i">48</td>
            <td rowspan="2" class="id red light">{!! complink('2017-03-03', '3月3日') !!}<br>{{App\Character::find(278)->lname}}</td>
            <td rowspan="2" class="ni light">77</td>
        </tr>
        <tr>
            <td class="gum red light">H-4</td>
            <td class="chara red light">{{App\Character::find(278)->lname}}＠{{App\Character::find(278)->lwork}}</td>
            <td class="i red light">53</td>
        </tr>
    </table>
@endsection
