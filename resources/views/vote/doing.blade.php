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
        <div class="ui one column grid">
            @foreach($competition->groups as $group)
                @foreach($group->options as $option)
                    <div class="column ui link cards">
                        <div class="ui fluid card">
                            <div class="image">
                                <img src="{{ config('admin.upload.host') . '/' . $option->avatar }}">
                            </div>
                            <div class="content">
                                <span class="header">{{ $option->title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
