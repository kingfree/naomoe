@extends('layouts.app')

@section('title', $competition->title .' - '. __('welcome.discuss'))

@section('content')
    <div class="ui stackable two column grid">
        <div class="column">
            <div class="ds-thread" data-thread-key="{{$competition->id}}" data-title="{{$competition->title}}"
                 data-url="{{route('votelog', ['id'=>$competition->id])}}"></div>
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
            <div class="ui feed segments ">
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
