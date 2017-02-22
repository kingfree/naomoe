@extends('layouts.app')

@section('title', $competition->title .' - '. __('welcome.discuss'))

@section('content')
    <div class="ui stackable two column grid">
        <div class="ui column">
            <div class="ui piled segment items">
                <h2 class="ui header competition" data-id="{{ $competition->id }}">
                    {{ $competition->title }}
                    <div class="sub header">
                        {{ $competition->infos()['type'] ?? '预选赛' }}
                    </div>
                </h2>
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
            @if ($competition->status == \App\Competition::DID)
                @foreach($competition->groups as $group)
                    <div class="ui attached segment">
                        <div class="ui pink ribbon label">
                            {{ $group->title }}
                        </div>
                        <div class="ui ordered horizontal list">
                            @foreach($group->rankLimit as $index => $option)
                                <div class="item">
                                    <div class="ui avatar circular {{
                                                    ($index == 0) ? 'yellow' : (
                                                    ($index == 1) ? 'pink': (
                                                    ($index == 2) ? 'orange' : (
                                                    ($option->winner) ? 'teal' : '')))
                                                }} label">
                                        {{$option->valid}}
                                    </div>
                                    <div class="content">
                                        <div class="header">
                                            {{$option->character->lname}}
                                        </div>
                                        <div class="description">{{$option->character->lwork}}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="ui segment">
                <div class="ds-thread" data-thread-key="{{$competition->id}}" data-title="{{$competition->title}}"
                     data-url="{{route('votelog', ['id'=>$competition->id])}}"></div>
            </div>
        </div>
        <script type="text/javascript">
            var duoshuoQuery = {short_name: "naomoe"};
            (function () {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';
                ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
        </script>
        <div class="column">
            <div class="ui feed segments">
                @foreach($competition->votelogsDesc as $log)
                    <div class="event ui segment">
                        <div class="label">
                            <i class="pink {{$log->valid ? 'heart icon' : 'empty heart icon'}}"></i>
                        </div>
                        <div class="content">
                            <div class="summary">
                                <div class="user">
                                    {{$log->user->hiddenName()}}
                                </div>
                                <div class="date" data-data="{{$log->created_at}}">{{$log->created_at}}</div>
                            </div>
                            <div class="meta">
                                <div class="ui mini horizontal list">
                                    <div class="item">@lang('vote.votedto')</div>
                                    @foreach($log->options() as $option)
                                        <div class="item">{{$option->title}}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="extra text">
                                {{ $log->comment }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
