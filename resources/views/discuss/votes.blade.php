@extends('layouts.app')

@section('title', $competition->title .' - '. __('welcome.discuss'))

@section('content')
    <div class="ui feed">
        @foreach($competition->votelogsDesc as $log)
            <div class="event">
                <div class="label">
                    <i class="pink {{$log->valid ? 'heart icon' : 'empty heart icon'}}"></i>
                </div>
                <div class="content">
                    <div class="summary">
                        <div class="user">
                            {{$log->user->hiddenName()}}
                        </div>
                        <div class="date" data-data="{{$log->created_at}}"></div>
                    </div>
                    <div class="summary">
                        {{ $log->comment }}
                    </div>
                    <div class="extra text">
                        <div class="ui segment">
                            <div class="ui horizontal list">
                                @foreach($log->options() as $option)
                                    <div class="item">{{$option->title}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
