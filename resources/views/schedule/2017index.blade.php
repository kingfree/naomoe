@section('schedule')
    <div class="ui piled segment">

        <table class="ui very basic collapsing celled table">
            <thead>
            <tr>
                <th class="three wide">日期</th>
                <th class="two wide">时间</th>
                <th class="four wide">萌战内容</th>
                <th class="seven wide">备注</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>2月23日（木）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-02-23', '预选赛1、2组') !!}</td>
                <td>20进4选8。每组前4晋级本战</td>
            </tr>
            <tr>
                <td>2月24日（金）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-02-24', '预选赛3、4组') !!}</td>
                <td>20进4选8。每组前4晋级本战</td>
            </tr>
            <tr>
                <td>2月25日（土）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-02-25', '预选赛5、6组') !!}</td>
                <td>20进4选8。每组前4晋级本战</td>
            </tr>
            <tr>
                <td>2月26日（日）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-02-26', '预选赛7、8组') !!}</td>
                <td>20进4选8。每组前4晋级本战</td>
            </tr>
            <tr>
                <td>2月27日（月）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-02-27', '表演赛I') !!}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><a href="/hon">本战分组</a></td>
                <td>随机分配成8组，每组4人，分上下两区</td>
            </tr>
            <tr>
                <td>2月28日（火）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-02-28', '本战1回战ABCD上') !!}</td>
                <td>A、B、C、D组上半区，2选1进1</td>
            </tr>
            <tr>
                <td>3月1日（水）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-03-01', '本战1回战EFGH上') !!}</td>
                <td>E、F、G、H组上半区，2选1进1</td>
            </tr>
            <tr>
                <td>3月2日（木）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-03-02', '本战1回战ABCD下') !!}</td>
                <td>A、B、C、D组下半区，2选1进1</td>
            </tr>
            <tr>
                <td>3月3日（金）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-03-03', '本战1回战EFGH下') !!}</td>
                <td>E、F、G、H组下半区，2选1进1</td>
            </tr>
            <tr>
                <td>3月4日（土）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-03-04', '本战2回战上半区') !!}</td>
                <td>2进1选1。A、B、C、D各半区胜者参与</td>
            </tr>
            <tr>
                <td>3月5日（日）</td>
                <td>00:00~23:00</td>
                <td>{!! complink('2017-03-05', '本战2回战下半区') !!}</td>
                <td>2进1选1。E、F、G、H各半区胜者参与</td>
            </tr>
            <tr>
                <td>3月6日（月）</td>
                <td>00:00~23:00</td>
                <td>表演赛II</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>决赛圈分组</td>
                <td>8人随机分为东南西北4组</td>
            </tr>
            <tr>
                <td>3月7日（火）</td>
                <td>00:00~23:00</td>
                <td>八进四东南组</td>
                <td>2进1选1。东、南2组同时进行</td>
            </tr>
            <tr>
                <td>3月8日（水）</td>
                <td>00:00~23:00</td>
                <td>八进四西北组</td>
                <td>2进1选1。西、北2组同时进行</td>
            </tr>
            <tr>
                <td>3月9日（木）</td>
                <td>00:00~23:00</td>
                <td>半决赛</td>
                <td>2进1选1。东西、南北2组同时进行</td>
            </tr>
            <tr>
                <td>3月10日（金）</td>
                <td>00:00~23:00</td>
                <td>三位战</td>
                <td>决出第三名和第四名</td>
            </tr>
            <tr>
                <td>3月11日（土）</td>
                <td>00:00~23:00</td>
                <td>萌王战</td>
                <td>决出萌王和准萌</td>
            </tr>
            <tr>
                <td>3月12日（日）</td>
                <td></td>
                <td>休战</td>
                <td></td>
            </tr>
            <tr>
                <td>3月13日（月）</td>
                <td>00:00~23:00</td>
                <td>表演赛III</td>
                <td></td>
            </tr>
            <tr>
                <td>3月14日（火）</td>
                <td>00:00~23:00</td>
                <td>表演赛IV</td>
                <td></td>
            </tr>
            <tr>
                <td>3月15日（水）</td>
                <td></td>
                <td>2017届闹萌</td>
                <td>结束</td>
            </tr>

            </tbody>
        </table>
    </div>
@endsection
