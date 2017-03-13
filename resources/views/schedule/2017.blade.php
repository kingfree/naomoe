@extends('layouts.app')

@section('title', ($id and $competition) ? $competition->title :__('schedule.title'))

@section('content')
    <div class="ui doubling stackable grid">
        <div class="six wide column">
            <h2 class="ui pink top attached header">
                <i class="calendar icon"></i>
                <div class="content">
                    <a href="{{route('schedule')}}">@lang('schedule.calendar')</a>
                    <a href="{{route('hon')}}">分组</a>
                    <div class="sub header">
                        2017年2月 - 2017年3月
                    </div>
                </div>
            </h2>
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
                    <h2 class="ui header {{$competition->color()}} competition" data-id="{{ $competition->id }}">
                        <i class="{{ $competition->icon() }} icon"></i>
                        <div class="content">
                            {{ $competition->title }}
                            <div class="sub header" style="color: white;">
                                {{ $competition->infos()['type'] ?? '预选赛' }}
                            </div>
                        </div>
                    </h2>
                </div>
                <div class="ui attached segment items">
                    <div class="ui item">
                        <div class="content">
                            <div class="meta">
                                <span class="voted">参赛人数: {{ $competition->voted }}人</span>
                                <span class="valid">合计投出: {{ $competition->valid  }}票</span>
                            </div>
                            <div class="extra">
                                <span class="dates">{{ $competition->start_at }}</span>~<span
                                        class="dates">{{ $competition->end_at }}</span>
                            </div>
                            <div class="description">
                                {!! $competition->description !!}
                            </div>
                        </div>
                    </div>
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
                        2017 @lang('schedule.winner')
                        {{App\Character::find(179)->lname}}
                    </h3>
                    <a href="http://www.pixiv.net/member_illust.php?id=197076" title="ぴょん吉">
                        <img class="ui fluid image" src="/images/2017yui.jpg">
                    </a>
                </div>
                <div class="ui attached segment">
                    <a href="http://www.pixiv.net/member_illust.php?mode=medium&illust_id=61616191" title="深蓝杰克">
                        <img class="ui fluid image" src="/images/naos.jpg">
                    </a>
                </div>
            @endif
        </div>
        <div class="ten wide column">
            @if ($id and $competition)
                <div class="ui {{count($competition->groups) > 1 ? 'two' : 'one'}} column doubling grid">
                    @foreach($competition->groups as $group)
                        <div class="column">
                            <div class="ui segment">
                                <div class="ui pink ribbon label">
                                    {{ $group->title }}
                                </div>
                                <span class="sub header">{{ $group->win }} / {{ count($group->options) }}</span>
                                @if ($competition->inTime())
                                    <p class="text-muted">@lang('schedule.lastupdate')
                                        <span class="date"
                                              data-data="{{$competition->updated_at}}">{{$competition->updated_at}}</span>
                                    </p>
                                @endif
                                <ul class="ui ordered list did">
                                    {{($first=$group->first())?'':''}}
                                    {{($second=$group->second())?'':''}}
                                    {{($third=$group->third())?'':''}}
                                    @foreach($group->rank as $index => $option)
                                        <div class="item">
                                            <div class="right floated compact">
                                                <div class="ui huge circular {{
                                                    ($option->valid === 0) ? '' : (
                                                    ($index == 0 or $option->valid == $first->valid) ? 'yellow' : (
                                                    ($index == 1 or $option->valid == $second->valid) ? 'pink': (
                                                    ($index == 2 or $option->valid == $third->valid) ? 'orange' : (
                                                    ($option->winner) ? 'teal' : ''))))
                                                }} label">
                                                    {{$option->valid}}
                                                </div>
                                            </div>
                                            <h3 class="ui header option" data-id="{{ $option->id }}"
                                                data-allow="{{ $group->allow }}"
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
            @elseif ($page)
                @include('schedule.'.$page)
                @yield('schedule')
            @endif
        </div>
    </div>
@endsection