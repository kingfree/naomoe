@extends('layouts.app')

@section('title', __('schedule.title'))

@section('content')
    <div class="ui doubling stackable grid">
        <div class="five wide column">
            <h2 class="ui pink top attached header">
                <i class="calendar icon"></i>
                <div class="content">
                    @lang('schedule.calendar')
                    <div class="sub header">
                        2017.2 - 2017.3
                    </div>
                </div>
            </h2>
            <div class="ui attached segment">
                <table class="calendar ui celled unstackable table">
                    <thead>
                    <tr class="center aligned">
                        <th><span class="ui red header">日</span></th>
                        <th><span class="ui black header">月</span></th>
                        <th><span class="ui black header">火</span></th>
                        <th><span class="ui black header">水</span></th>
                        <th><span class="ui black header">木</span></th>
                        <th><span class="ui black header">金</span></th>
                        <th><span class="ui green header">土</span></th>
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
                                <div class="date">
                                    {{$log->created_at}}
                                </div>
                                <div class="summary">
                                    {{$log->comment}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="eleven wide column">
            @if ($id and $competition)
                <div class="ui two column doubling grid">
                    @foreach($competition->groups as $group)
                        <div class="column">
                            <div class="ui segment">
                                <div class="ui pink ribbon label">
                                    {{ $group->title }}
                                </div>
                                <span class="sub header">{{ $group->allow }} / {{ count($group->options) }}</span>
                                <ul class="ui list">
                                    @foreach($group->rank as $option)
                                        <div class="item">
                                            <div class="right floated compact ui statistic {{($option->winner > 1) ? 'red' : (($option->winner > 0) ? 'yellow':'')}}">
                                                <div class="value">
                                                    {{$option->valid}}
                                                </div>
                                                <div class="label">
                                                    @if ($competition->state() == \App\Competition::DID))
                                                        @lang('schedule.winner'.$option->winner)
                                                    @endif
                                                </div>
                                            </div>
                                            <h3 class="ui header">
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
                    {!! $page->content !!}
                </div>
            @endif
        </div>
    </div>
@endsection