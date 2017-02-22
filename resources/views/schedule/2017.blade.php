@extends('layouts.app')

@section('title', ($id and $competition) ? $competition->title :__('schedule.title'))

@section('content')
    <div class="ui doubling stackable grid">
        <div class="six wide column">
            <a href="{{route('schedule')}}">
                <h2 class="ui pink top attached header">
                    <i class="calendar icon"></i>
                    <div class="content">
                        @lang('schedule.calendar')
                        <div class="sub header">
                            2017.2 - 2017.3
                        </div>
                    </div>
                </h2>
            </a>
            <div class="ui attached segment">
                <table class="calendar ui celled seven unstackable column table" style="margin: -8px;">
                    <thead>
                    <tr class="center aligned">
                        <th><span style="color: red;">日</span></th>
                        <th><span style="color: black;">月</span></th>
                        <th><span style="color: black;">火</span></th>
                        <th><span style="color: black;">水</span></th>
                        <th><span style="color: black;">木</span></th>
                        <th><span style="color: black;">金</span></th>
                        <th><span style="color: green;">土</span></th>
                    </tr>
                    </thead>
                    <tbody class="center aligned">
                    <tr>
                        <td>{!! cal(2017, 2, 19, $id) !!}</td>
                        <td>{!! cal(2017, 2, 20, $id) !!}</td>
                        <td>{!! cal(2017, 2, 21, $id) !!}</td>
                        <td>{!! cal(2017, 2, 22, $id) !!}</td>
                        <td>{!! cal(2017, 2, 23, $id) !!}</td>
                        <td>{!! cal(2017, 2, 24, $id) !!}</td>
                        <td>{!! cal(2017, 2, 25, $id) !!}</td>
                    </tr>
                    <tr>
                        <td>{!! cal(2017, 2, 26, $id) !!}</td>
                        <td>{!! cal(2017, 2, 27, $id) !!}</td>
                        <td>{!! cal(2017, 2, 28, $id) !!}</td>
                        <td>{!! cal(2017, 3, 1, $id) !!}</td>
                        <td>{!! cal(2017, 3, 2, $id) !!}</td>
                        <td>{!! cal(2017, 3, 3, $id) !!}</td>
                        <td>{!! cal(2017, 3, 4, $id) !!}</td>
                    </tr>
                    <tr>
                        <td>{!! cal(2017, 3, 5, $id) !!}</td>
                        <td>{!! cal(2017, 3, 6, $id) !!}</td>
                        <td>{!! cal(2017, 3, 7, $id) !!}</td>
                        <td>{!! cal(2017, 3, 8, $id) !!}</td>
                        <td>{!! cal(2017, 3, 9, $id) !!}</td>
                        <td>{!! cal(2017, 3, 10, $id) !!}</td>
                        <td>{!! cal(2017, 3, 11, $id) !!}</td>
                    </tr>
                    <tr>
                        <td>{!! cal(2017, 3, 12, $id) !!}</td>
                        <td>{!! cal(2017, 3, 13, $id) !!}</td>
                        <td>{!! cal(2017, 3, 14, $id) !!}</td>
                        <td>{!! cal(2017, 3, 15, $id) !!}</td>
                        <td>{!! cal(2017, 3, 16, $id) !!}</td>
                        <td>{!! cal(2017, 3, 17, $id) !!}</td>
                        <td>{!! cal(2017, 3, 18, $id) !!}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            @if ($id and $competition)
                <div class="ui attached {{$competition->style()}} segment">
                    <h2 class="ui header competition" data-id="{{ $competition->id }}">
                        <i class="{{ $competition->icon() }} icon"></i>
                        <div class="content">
                            {{ $competition->title }}
                            <div class="sub header" style="color: white;">
                                {{ $competition->infos()['type'] ?? '预选赛' }}
                            </div>
                        </div>
                    </h2>
                </div>
                <div class="ui attached segment">
                     {!! $competition->description !!}
                </div>
            @endif
            @if ($id and $log)
                <div class="ui attached segment">
                    @foreach($competition->groups as $group)
                        <div class="ui list">
                            <div class="ui pink ribbon label">
                                {{ $group->title }}
                            </div>
                            @foreach($group->options as $option)
                                <div class="item {{ $log->voted($option->id) ? '' : 'hidden' }}"
                                     data-id="{{ $option->id }}">
                                    <img class="ui avatar image"
                                         src="{{ config('admin.upload.host') . $option->avatar }}">
                                    <div class="content">{{ $option->title }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="ui attached segment">
                    <div class="ui feed">
                        <div class="event">
                            <div class="content">
                                <div class="date" data-data="{{$log->created_at}}">
                                    {{$log->created_at}}
                                </div>
                                <div class="summary">
                                    {{$log->comment}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="ui attached segment">
                    <h3 class="ui pink header">
                        测试赛 | 热身赛 | 表演赛
                    </h3>
                    <table class="ui very basic collapsing celled table">
                        <thead>
                        <tr>
                            <th>日期</th>
                            <th>萌战内容</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2月19日（日）</td>
                            <td>{!! complink('2017-02-19', '中川花音专辑赛') !!}</td>
                        </tr>
                        <tr>
                            <td>2月20日（月）</td>
                            <td>{!! complink('2017-02-20', '闹群最萌') !!}</td>
                        </tr>
                        <tr>
                            <td>2月22日（水）</td>
                            <td>{!! complink('2017-02-22', '闹曲歌赏') !!}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            @endif
        </div>
        <div class="ten wide column">
            @if ($id and $competition)
                <div class="ui {{count($competition->groups) > 1 ? 'two' : ''}} column doubling grid">
                    @foreach($competition->groups as $group)
                        <div class="column">
                            <div class="ui segment">
                                <div class="ui pink ribbon label">
                                    {{ $group->title }}
                                </div>
                                <span class="sub header">{{ $group->win }} / {{ count($group->options) }}</span>
                                @if ($competition->inTime())
                                    <p class="text-muted">@lang('schedule.lastupdate') <span class="date"
                                                                                             data-data="{{$group->updated_at}}">{{$group->updated_at}}</span>
                                    </p>
                                @endif
                                <ul class="ui ordered list did">
                                    @foreach($group->rank as $index => $option)
                                        <div class="item">
                                            <div class="right floated compact">
                                                <div class="ui huge circular {{
                                                    ($index == 0) ? 'yellow' : (
                                                    ($index == 1) ? 'pink': (
                                                    ($index == 2) ? 'orange' : (
                                                    ($option->winner) ? 'teal' : '')))
                                                }} label">
                                                    {{$option->valid}}
                                                </div>
                                            </div>
                                            <h3 class="ui header option" data-id="{{ $option->id }}" data-allow="{{ $group->allow }}"
                                                data-group="{{ $group->id }}" data-music="{{ $option->music() }}">
                                                <img src="{{ config('admin.upload.host') . $option->avatar }}">
                                                <div class="content">
                                                    {{$option->character->lname}}
                                                    <div class="sub header">
                                                        {{$option->character->lwork}}
                                                    </div>
                                                </div>
                                            </h3>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="ui piled segment">

                    <table class="ui very basic collapsing celled table">
                        <thead>
                        <tr>
                            <th>日期</th>
                            <th>时间</th>
                            <th>萌战内容</th>
                            <th>备注</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>2月23日（木）</td>
                            <td>00:00~23:00</td>
                            <td>{!! complink('2017-02-23', '预选赛1、2组') !!}</td>
                            <td>20进4选8。每组前4晋级为32强</td>
                        </tr>
                        <tr>
                            <td>2月24日（金）</td>
                            <td>00:00~23:00</td>
                            <td>{!! complink('2017-02-24', '预选赛3、4组') !!}</td>
                            <td>20进4选8。每组前4晋级为32强</td>
                        </tr>
                        <tr>
                            <td>2月25日（土）</td>
                            <td>00:00~23:00</td>
                            <td>{!! complink('2017-02-25', '预选赛5、6组') !!}</td>
                            <td>20进4选8。每组前4晋级为32强</td>
                        </tr>
                        <tr>
                            <td>2月26日（日）</td>
                            <td>00:00~23:00</td>
                            <td>{!! complink('2017-02-26', '预选赛7、8组') !!}</td>
                            <td>20进4选8。每组前4晋级为32强</td>
                        </tr>
                        <tr>
                            <td>2月27日（月）</td>
                            <td>00:00~23:00</td>
                            <td>表演赛I</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>本战32强分组</td>
                            <td>随机分配成8组，每组4人</td>
                        </tr>
                        <tr>
                            <td>2月28日（火）</td>
                            <td>00:00~23:00</td>
                            <td>本战1回战AB组</td>
                            <td>4进2选2。A、B组前2晋级</td>
                        </tr>
                        <tr>
                            <td>3月1日（水）</td>
                            <td>00:00~23:00</td>
                            <td>本战1回战CD组</td>
                            <td>4进2选2。C、D组前2晋级</td>
                        </tr>
                        <tr>
                            <td>3月2日（木）</td>
                            <td>00:00~23:00</td>
                            <td>本战1回战EF组</td>
                            <td>4进2选2。E、F组前2晋级</td>
                        </tr>
                        <tr>
                            <td>3月3日（金）</td>
                            <td>00:00~23:00</td>
                            <td>本战1回战GH组</td>
                            <td>4进2选2。G、H组前2晋级</td>
                        </tr>
                        <tr>
                            <td>3月4日（土）</td>
                            <td>00:00~23:00</td>
                            <td>本战2回战上半区</td>
                            <td>2进1选1。A、B、C、D各组第一晋级为八强</td>
                        </tr>
                        <tr>
                            <td>3月5日（日）</td>
                            <td>00:00~23:00</td>
                            <td>本战2回战下半区</td>
                            <td>2进1选1。E、F、G、H各组第一晋级为八强</td>
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

                    {!! $page->content !!}
                </div>
            @endif
        </div>
    </div>
@endsection