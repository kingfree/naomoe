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
                                        <i class="sign in icon"></i>
                                        登录
                                    </button>
                                </div>
                                </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">其他登录方式</label>
                            <div class="col-md-8">
                                    <a href="http://naomoe.duoshuo.com/login/baidu/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
                                       class="ui facebook button">
                                        <i class="paw icon"></i>
                                        贴吧
                                    </a>
                                    <a href="http://naomoe.duoshuo.com/login/weibo/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
                                       class="ui red button">
                                        <i class="weibo icon"></i>
                                        微博
                                    </a>
                                    <a href="http://naomoe.duoshuo.com/login/qq/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
                                       class="ui black button">
                                        <i class="qq icon"></i>
                                        QQ
                                    </a>
                                    <a href="http://naomoe.duoshuo.com/login/weixin/?sso=1&amp;redirect_uri={{route('duoshuoin')}}"
                                       class="ui green button">
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
    <script>
        var duoshuoQuery = {
            short_name: "naomoe",
            sso: {
                login: "{{route('duoshuoin')}}",
                logout: "{{route('duoshuout')}}"
            }
        };
        (function () {
            var ds = document.createElement('script');
            ds.type = 'text/javascript';
            ds.async = true;
            ds.src = 'http://static.duoshuo.com/embed.js';
            ds.charset = 'UTF-8';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);
        })();
    </script>
@endsection
