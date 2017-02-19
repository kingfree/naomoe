@extends('layouts.app')

@section('title', __('welcome.votes'))

@section('content')
    <div class="alert alert-danger hidden"></div>
    <form id="voting">
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
                        <div class="sub header">@lang('vote.allow', ['allow'=>$group->allow])</div>
                    </div>
                    <div class="list">
                        @foreach($group->options as $option)
                            <div class="item ui checkbox">
                                <input type="checkbox" class="option hidden"
                                       value="{{$option->id}}" {{ $log->voted($option->id) ? 'selected' : '' }}>
                                <label>
                                    {{ $option->character->lname }}
                                    @
                                    {{ $option->character->lwork }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="ui pink segment">
                <button type="submit" class="ui simple pink submit button {{ $log->id ? 'disabled' : '' }}">@lang('vote.vote')</button>
                @lang('vote.noneed')
            </div>
        </div>
    </div>
    </form>

    <script>
        var messages = {
            title: "{{__('vote.confirm_title')}}",
            confirmButtonText: "{{__('vote.confirm')}}",
            cancelButtonText: "{{__('vote.cancel')}}",
            select_one: "{{__('vote.select_one')}}"
        };
    </script>
@endsection
