@extends('layouts.app')

@section('title', $competition->title .' - '. __('welcome.votes'))

@section('content')
    <div class="ui do segment">
        <h2 class="ui header competition" data-id="{{ $competition->id }}">
            <i class="{{ $competition->icon() }} icon"></i>
            <div class="content">
                {{ $competition->title }}
                <div class="sub header">
                    {{ $competition->infos()['type'] ?? '预选赛' }}
                </div>
            </div>
        </h2>
        <div class="ui items">
            <div class="ui item">
                <div class="content">
                    <div class="extra">
                        <span class="dates">{{ $competition->start_at }}</span>~<span class="dates">{{ $competition->end_at }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui segments">
            @if ($competition->isMusic())
                <style>
                    .cover, .cover img {
                        border-bottom-left-radius: 1px;
                        border-top-left-radius: 1px;
                    }

                    .cover {
                        float: left;
                        width: 90px;
                        height: 90px;
                    }

                    .cover img {
                        width: 100%;
                        height: 100%;
                        border-top-left-radius: 2px;
                    }

                    h2 {
                        position: relative;
                        left: 0;
                        top: 0;
                        height: 36px;
                        margin-bottom: 10px;
                        line-height: 36px;
                        padding-left: 2px;
                        font-size: 14px;
                        font-weight: normal;
                        zoom: 1;
                    }

                    h2 .logo {
                        position: absolute;
                        left: 0;
                        top: 10px;
                    }

                    h2 .title {
                        padding-top: 10px;
                        line-height: 18px;
                    }

                    h2 .title .sub {
                        font-size: 12px;
                        color: #666;
                    }

                    .ctrlBox {
                        float: right;
                        width: 200px;
                        padding: 10px 10px 0 0;
                        position: relative;
                    }
                </style>
                @foreach($competition->groups as $group)
                    <div class="ui segment group" data-id="{{ $group->id }}">
                        <div class="ui pink ribbon label">
                            {{ $group->title }}
                        </div>
                        <span class="sub header">0 / {{ $group->allow }}</span>
                        <div class="text-muted">@lang('vote.allow', ['allow'=>$group->allow])</div>
                        <div class="ui doubling three column grid link doing cards">
                            @foreach($group->options as $option)
                                <div class="card option {{ $log->voted($option->id) ? 'selected' : '' }}"
                                     data-id="{{ $option->id }}" data-allow="{{ $group->allow }}"
                                     data-group="{{ $group->id }}" data-music="{{ $option->music() }}">
                                    <div class="f-cb">
                                        <div class="cover">
                                            <img id="cover" src="{{ config('admin.upload.host') . $option->avatar }}">
                                        </div>
                                        <div class="ctrlBox">
                                            <h2 class="f-pr" style="max-width: 150px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
                                                <div class="title">{{$option->character->name}}
                                                </div>
                                            </h2>
                                            <div style="color: #e03997;max-width: 150px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
                                                {{$option->character->description}}
                                            </div>
                                            <div class="bar" style="font-size: 12px;max-width: 150px; overflow:hidden; white-space:nowrap; text-overflow:ellipsis;">
                                                <span>{{$option->character->work}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                @foreach($competition->groups as $group)
                    <div class="ui segment group" data-id="{{ $group->id }}">
                        <div class="ui pink ribbon label">
                            {{ $group->title }}
                        </div>
                        <span class="sub header">0 / {{ $group->allow }}</span>
                        <div class="text-muted">@lang('vote.allow', ['allow'=>$group->allow])</div>
                        <div class="ui doubling {{ $group->infos()['columns'] ?? 'six' }} column grid link doing cards">
                            @foreach($group->options as $option)
                                <div class="card option {{ $log->voted($option->id) ? 'selected' : '' }}"
                                     data-id="{{ $option->id }}" data-allow="{{ $group->allow }}"
                                     data-group="{{ $group->id }}">
                                    <div class="image">
                                        <img src="{{ config('admin.upload.host') . $option->avatar }}">
                                    </div>
                                    <div class="content">
                                        <div class="header">{{ $option->character->lname }}</div>
                                        <div class="meta">{{ $option->character->lwork }}</div>
                                        <div class="description">
                                            {{ $option->character->description }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@if($competition->inTime())
@section('footer')
    <script>
        var messages = {
            title: "{{__('vote.confirm_title')}}",
            confirmButtonText: "{{__('vote.confirm')}}",
            cancelButtonText: "{{__('vote.cancel')}}",
            inputPlaceholder: "{{__('vote.input_moeb')}}",
            select_one: "{{__('vote.select_one')}}"
        };
    </script>

    <div class="footer"></div>
    <div class="voting ui material">
        <div class="ui doubling segments">
            @foreach($competition->groups as $group)
                <div class="ui segment">
                    <div class="ui horizontal doubling list">
                        <div class="item">
                            <div class="header">{{ $group->title }}</div>
                        </div>
                        @foreach($group->options as $option)
                            <div class="item {{ $log->voted($option->id) ? '' : 'hidden' }}"
                                 data-id="{{ $option->id }}">
                                <img class="ui avatar image" src="{{ config('admin.upload.host') . $option->avatar }}">
                                <div class="content">{{ $option->character->lname }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="ui pink segment">
                <button class="ui pink submit button {{ $log->id ? 'disabled' : '' }}">@lang('vote.vote')</button>
                @if ($log->comment)
                    <span id="comment">{{$log->comment}}</span>
                @else
                    <span id="comment"></span>
                    @lang('vote.noneed')
                @endif
                @if (Route::has('simple'))
                    <a class="ui right floated" href="{{route('simple', ['id' => $competition->id])}}">尝试简单版</a>
                @endif
            </div>
        </div>
    </div>
@endsection
@endif