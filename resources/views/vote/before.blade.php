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
                            <div class="card option"
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
