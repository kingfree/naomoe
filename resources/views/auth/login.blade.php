@extends('layouts.app')

@section('title', '登录')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">登录</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">用户名</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"
                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> 记住我
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="ui pink button">
                                        登录
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                        忘记密码？
                                    </a>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <a class="ui twitter button" href="{{ url('/auth/twitter') }}">
                                        <i class="twitter icon"></i>
                                        推特
                                    </a>
                                    <a class="ui google plus button" href="{{ url('/auth/weibo') }}">
                                        <i class="weibo icon"></i>
                                        微博
                                    </a>
                                    <a class="ui blue button" href="{{ url('/auth/baidu') }}">
                                        <i class="paw  icon"></i>
                                        贴吧
                                    </a>
                                    <a class="ui orange button" href="{{ url('/auth/qq') }}">
                                        <i class="qq icon"></i>
                                        QQ
                                    </a>
                                    <a class="ui green button" href="{{ url('/auth/weixin') }}">
                                        <i class="weixin icon"></i>
                                        微信
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
