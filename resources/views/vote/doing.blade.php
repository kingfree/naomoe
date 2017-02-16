@extends('layouts.app')

@section('title', __('welcome.votes'))

@section('content')
    <div class="ui piled segment">
        <h2 class="ui header competition" data-id="{{ $competition->id }}">
            <i class="{{ $competition->icon() }} icon"></i>
            <div class="content">
                {{ $competition->title }}
                <div class="sub header">{{ $competition->infos()['type'] ?? '预选赛' }}</div>
            </div>
        </h2>
        <div class="ui segments">
            @foreach($competition->groups as $group)
                <div class="ui segment group" data-id="{{ $group->id }}">
                    <div class="ui huge header">
                        {{ $group->title }}
                        <div class="sub header">0 / {{ $group->allow }}</div>
                    </div>
                    <div class="ui stackable {{ $group->infos()['columns'] ?? 'seven' }} column grid link doing cards">
                        @foreach($group->options as $option)
                            <div class="card option" data-id="{{ $option->id }}" data-allow="{{ $group->allow }}"
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
        <div class="ui stackable segments">
            @foreach($competition->groups as $group)
                <div class="ui segment">
                    <div class="ui horizontal stackable list">
                        <div class="item">
                            <div class="header">{{ $group->title }}</div>
                        </div>
                        @foreach($group->options as $option)
                            <div class="item hidden" data-id="{{ $option->id }}">
                                <img class="ui avatar image" src="{{ config('admin.upload.host') . $option->avatar }}">
                                <div class="content">{{ $option->character->lname }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="ui pink segment">
                <button class="ui pink submit button">@lang('vote.vote')</button>
                @lang('vote.noneed')
            </div>
        </div>
    </div>
@endsection