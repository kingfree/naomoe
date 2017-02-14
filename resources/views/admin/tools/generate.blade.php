@extends('admin::index')

@section('content')
    <section class="content-header">
        <h1>
            分组
            <small>从角色池中生成分组和选项</small>
        </h1>

    </section>

    <section class="content">

        @include('admin::partials.error')
        @include('admin::partials.success')
        @include('admin::partials.exception')

        <div class="panel panel-default">
            <div class="panel-body">
                {{ count($pool->characters) }}
                <ul>
                    @foreach($pool->characters as $chara)
                        <li>{{ $chara->text }}</li>
                    @endforeach
                </ul>
                <form class="form-horizontal" method="POST" action="{{ route('doGenerate') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" value="{{ $pool->id }}">

                    <div class="form-group">
                        <label for="title">分组名</label>
                        <input type="text" class="form-control" name="title" value="{{$pool->title}}">
                    </div>
                    <div class="form-group">
                        <label for="title">分成几组</label>
                        <input type="number" class="form-control" name="number" value="1">
                    </div>
                    <div class="form-group">
                        <label for="title">每组可投</label>
                        <input type="number" class="form-control" name="allow" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">开始分组</button>
                </form>
            </div>
        </div>
    </section>
@endsection