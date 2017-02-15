@extends('layouts.app')

@section('title', '投票')

@section('content')
    <div class="ui piled segment">
        <h2 class="ui header">
            <i class="{{ $competition->info['icon'] ?? 'upload' }} icon"></i>
            <div class="content">
                {{ $competition->title }}
                <div class="sub header">{{ $competition->info['type'] ?? '预选赛' }}</div>
            </div>
        </h2>
        <div class="ui segments">
            @foreach($competition->groups as $group)
                <div class="ui segment group" data-id="{{ $group->id }}">
                    <div class="ui huge header">
                        {{ $group->title }}
                        <div class="sub header">0 / {{ $group->allow }}</div>
                    </div>
                    <div class="ui stackable {{ $group->info['columns'] ?? 'seven' }} column grid link doing cards">
                        @foreach($group->options as $option)
                            <div class="card option" data-id="{{ $option->id }}" data-allow="{{ $group->allow }}" data-group="{{ $group->id }}">
                                <div class="image">
                                    <img src="{{ config('admin.upload.host') . $option->avatar }}">
                                </div>
                                <div class="content">
                                    <div class="header">{{ $option->character->name }}</div>
                                    <div class="meta">{{ $option->character->work }}</div>
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
    <footer></footer>
    <div class="voting ui material tall stacked clearing stackable segment grid">
        <div class="fourteen wide column">
            @foreach($competition->groups as $group)
                <div class="ui horizontal list">
                    <div class="item">{{ $group->title }}</div>
                    @foreach($group->options as $option)
                        <div class="item hidden" data-id="{{ $option->id }}">
                            <img class="ui avatar image" src="{{ config('admin.upload.host') . $option->avatar }}">
                            <div class="content">
                                <div class="header">{{ $option->character->name }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="two wide column">
            <button class="ui right floated pink submit button">投票</button>
        </div>
    </div>
@endsection