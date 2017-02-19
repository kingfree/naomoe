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

                    {{ $competition->start_at }}
                    ~
                    {{ $competition->end_at }}
                </div>
            </div>
        </h2>
        <div class="ui segments">
            @foreach($competition->groups as $group)
                <div class="ui segment group" data-id="{{ $group->id }}">
                    <div class="ui pink ribbon label">
                        {{ $group->title }}
                    </div>
                    <span class="sub header">0 / {{ $group->allow }}</span>
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
                                    <div class="description">{{ $option->character->description }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

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

    <div class="ui small modal">
        <i class="close icon"></i>
        <div class="header">@lang('vote.confirm')</div>
        <div class="actions">
            <div class="ui black deny button">
                @lang('vote.cancel')
            </div>
            <div class="ui positive right labeled icon button">
                @lang('vote.ok')
                <i class="checkmark icon"></i>
            </div>
        </div>
    </div>

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
                            <div class="item {{ $log->voted($option->id) ? '' : 'hidden' }}" data-id="{{ $option->id }}">
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
                <a class="ui right floated" href="{{route('simple', ['id' => $competition->id])}}">无法点击？尝试简单版</a>
                @endif
            </div>
        </div>
    </div>
@endsection